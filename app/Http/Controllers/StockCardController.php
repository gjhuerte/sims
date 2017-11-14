<?php
namespace App\Http\Controllers;

use App;
use Validator;
use Carbon;
use DB;
use Auth;
use PDF;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class StockCardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request, $stocknumber)
	{
		if($request->ajax())
		{
			return json_encode([
				'data' => App\StockCard::where('stocknumber','=',$stocknumber)
											->orderBy('date','asc')
											->get()
			]);
		}

		$supply = App\Supply::find($stocknumber);
		return View('stockcard.index')
				->with('supply',$supply)
				->with('title',$supply->stocknumber);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$supply = App\Supply::find($id);
		$supplier = App\Supplier::pluck('name','name');
		return View('stockcard.create')
				->with('supply',$supply)
				->with('supplier',$supplier)
				->with('title','Stock Card');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$purchaseorder = $this->sanitizeString(Input::get('purchaseorder'));
		$deliveryreceipt = $this->sanitizeString(Input::get('dr'));
		$date = $this->sanitizeString(Input::get('date'));
		$daystoconsume = $this->sanitizeString(Input::get("daystoconsume"));
		$stocknumber = Input::get("stocknumber");
		$supplier = $this->sanitizeString(Input::get("supplier"));
		$quantity = Input::get("quantity");

		$validator = Validator::make([
			'Stock Number' => $stocknumber,
			'Purchase Order' => $purchaseorder,
			'Delivery Receipt' => $deliveryreceipt,
			'Date' => $date,
			'Receipt Quantity' => $quantity,
			'Office' => $supplier,
			'Days To Consume' => $daystoconsume
		],App\StockCard::$receiptRules);

		if($validator->fails())
		{
			return redirect("inventory/supply/$stocknumber/stockcard/create")
					->withInput()
					->withErrors($validator);
		}

		DB::beginTransaction();

		$transaction = new App\StockCard;
		$transaction->date = Carbon\Carbon::parse($date);
		$transaction->stocknumber = $stocknumber;
		$transaction->reference = $purchaseorder;
		$transaction->receipt = $deliveryreceipt;
		$transaction->organization = $supplier;
		$transaction->received = $quantity;
		$transaction->daystoconsume = $daystoconsume;
		$transaction->user_id = Auth::user()->id;
		$transaction->receipt();

		DB::commit();

		\Alert::success('Supplies Received')->flash();
		return redirect("inventory/supply/$stocknumber/stockcard");
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(Request::ajax())
		{
			$transaction = App\StockCard::with('supply')->where('stocknumber','=',$this->sanitizeString($id))->get();
			return json_encode([ 'data' => $transaction ]);
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($stocknumber,$id)
	{
		return redirect("inventory/supply/$stocknumber/stockcard/$id/edit");
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($stocknumber,$id)
	{
		\Alert::success('Supply Updated')->flash();
		return redirect("inventory/supply/$stocknumber/stockcard");
	}


	/**
	 * Show the form for releasing
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function releaseForm($id)
	{
		$supply = App\Supply::find($id);
		$balance = App\Supply::findByStockNumber($supply->stocknumber)->balance;
		return View('stockcard.release')
				->with('supply',$supply)
				->with('balance',$balance)
				->with('title','Stock Card');
	}


	/**
	 * Release the supply.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$stocknumber = $this->sanitizeString(Input::get('stocknumber'));
		$reference = $this->sanitizeString(Input::get('requisitionissueslip'));
		$date = $this->sanitizeString(Input::get('date'));
		$issuequantity = $this->sanitizeString(Input::get('quantity'));
		$office = $this->sanitizeString(Input::get('office'));
		$daystoconsume = $this->sanitizeString(Input::get('daystoconsume'));

		$validator = Validator::make([
			'Stock Number' => $stocknumber,
			'Requisition and Issue Slip' => $reference,
			'Date' => $date,
			'Issued Quantity' => $issuequantity,
			'Office' => $office,
			'Days To Consume' => $daystoconsume
		],App\StockCard::$issueRules);

		if($validator->fails())
		{
			return redirect("inventory/supply/$stocknumber/stockcard/release")
					->withInput()
					->withErrors($validator);
		}

		$balance = App\Supply::findByStockNumber($stocknumber)->balance;
		if($issuequantity > $balance)
		{
			return redirect("inventory/supply/$stocknumber/stockcard/release")
					->withInput()
					->withErrors([ "You cannot release quantity of $stocknumber which is greater than the remaining balance ($balance)" ]);

		}

		$transaction = new App\StockCard;
		$transaction->date = Carbon\Carbon::parse($date);
		$transaction->stocknumber = $stocknumber;
		$transaction->reference = $reference;
		$transaction->organization = $office;
		$transaction->issued  = $issuequantity;
		$transaction->daystoconsume = $daystoconsume;
		$transaction->user_id = Auth::user()->id;
		$transaction->issue();

		\Alert::success('Supplies Released')->flash();
		return redirect("inventory/supply/$stocknumber/stockcard");
	}

	public function batchAcceptForm()
	{
		$supplier = App\Supplier::pluck('name','name');
		return view('stockcard.batch.accept')
			->with('title','Batch Accept')
			->with('supplier',$supplier);
	}

	public function batchAccept()
	{
		$purchaseorder = $this->sanitizeString(Input::get('purchaseorder'));
		$deliveryreceipt = $this->sanitizeString(Input::get('dr'));
		$date = $this->sanitizeString(Input::get('date'));
		$office = $this->sanitizeString(Input::get('office'));
		$supplier = $this->sanitizeString(Input::get("supplier"));
		$daystoconsume = $this->sanitizeString(Input::get("daystoconsume"));
		$stocknumber = Input::get("stocknumber");
		$quantity = Input::get("quantity");

		$username = Auth::user()->firstname . " " . Auth::user()->middlename . " " . Auth::user()->lastname;

		$date = Carbon\Carbon::parse($date);

		DB::beginTransaction();

		foreach($stocknumber as $_stocknumber)
		{
			$validator = Validator::make([
				'Stock Number' => $_stocknumber,
				'Purchase Order' => $purchaseorder,
				'Date' => $date,
				'Receipt Quantity' => $quantity["$_stocknumber"],
				'Office' => $office,
				'Days To Consume' => $daystoconsume
			],App\StockCard::$receiptRules);

			if($validator->fails())
			{
				DB::rollback();
				return redirect("inventory/supply/stockcard/batch/form/accept")
						->with('total',count($stocknumber))
						->with('stocknumber',$stocknumber)
						->with('quantity',$quantity)
						->with('daystoconsume',$daystoconsume)
						->withInput()
						->withErrors($validator);
			}

			$transaction = new App\StockCard;
			$transaction->date = Carbon\Carbon::parse($date);
			$transaction->stocknumber = $_stocknumber;
			$transaction->reference = $purchaseorder;
			$transaction->receipt = $deliveryreceipt;
			$transaction->organization = $supplier;
			$transaction->received = $quantity["$_stocknumber"];
			$transaction->daystoconsume = $daystoconsume;
			$transaction->user_id = Auth::user()->id;
			$transaction->receipt();
		}

		DB::commit();

		\Alert::success('Supplies Received')->flash();
		return redirect('inventory/supply');
	}

	public function batchReleaseForm()
	{
		return view('stockcard.batch.release')
			->with('title','Batch Release');
	}

	public function batchRelease()
	{
		$purchaseorder = $this->sanitizeString(Input::get('purchaseorder'));
		$reference = $this->sanitizeString(Input::get('reference'));
		$date = $this->sanitizeString(Input::get('date'));
		$office = $this->sanitizeString(Input::get('office'));
		$daystoconsume = $this->sanitizeString(Input::get("daystoconsume"));
		$stocknumber = Input::get("stocknumber");
		$quantity = Input::get("quantity");

		DB::beginTransaction();
		foreach($stocknumber as $_stocknumber)
		{
			$validator = Validator::make([
				'Stock Number' => $stocknumber,
				'Requisition and Issue Slip' => $reference,
				'Date' => $date,
				'Issued Quantity' => $quantity["$_stocknumber"],
				'Office' => $office,
				'Days To Consume' => $daystoconsume
			],App\StockCard::$issueRules);

			$balance = App\Supply::findByStockNumber($_stocknumber)->balance;
			if($validator->fails() || $quantity["$_stocknumber"] > $balance)
			{

				DB::rollback();

				if($quantity["$_stocknumber"] > $balance)
				{
					$validator = [ "You cannot release quantity of $_stocknumber which is greater than the remaining balance ($balance)" ];
				}

				return redirect("inventory/supply/stockcard/batch/form/release")
						->with('total',count($stocknumber))
						->with('stocknumber',$stocknumber)
						->with('quantity',$quantity)
						->with('daystoconsume',$daystoconsume)
						->withInput()
						->withErrors($validator);
			}

			$transaction = new App\StockCard;
			$transaction->date = Carbon\Carbon::parse($date);
			$transaction->stocknumber = $_stocknumber;
			$transaction->reference = $reference;
			$transaction->organization = $office;
			$transaction->issued  = $quantity["$_stocknumber"];
			$transaction->daystoconsume = $daystoconsume;
			$transaction->user_id = Auth::user()->id;
			$transaction->issue();
		}

		DB::commit();

		\Alert::success('Supplies Released')->flash();
		return redirect('inventory/supply');
	}

	public function printStockCard($stocknumber)
	{
		$supply = App\Supply::find($stocknumber);

		$data = [
			'supply' => $supply
		];

		$filename = "StockCard-".Carbon\Carbon::now()->format('mdYHm')."-$stocknumber".".pdf";
		$view = "stockcard.print_index";

		return $this->printPreview($view,$data,$filename);

		// return view($view);
	}

	public function printAllStockCard()
	{
		$supplies = App\Supply::all();
		// $supplies = Supply::take(2)->get();
		$data = [
			'supplies' => $supplies
		];

		$filename = "StockCard-".Carbon\Carbon::now()->format('mdYHm').".pdf";
		$view = "stockcard.print_all_index";

		return $this->printPreview($view,$data,$filename);

		// return view($view)
		// 				->with('supplies',$supplies);
	}



}
