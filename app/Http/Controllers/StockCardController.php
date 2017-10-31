<?php
namespace App\Http\Controllers;

use App\Supply;
use Validator;
use Carbon;
use DB;
use Auth;
use PDF;
use Session;
use App\SupplyTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
class StockCardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($stocknumber)
	{
		if(Request::ajax())
		{
			return json_encode([
				'data' => SupplyTransaction::where('stocknumber','=',$stocknumber)
											->orderBy('date','asc')
											->get()
			]);
		}

		$supply = Supply::find($stocknumber);
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
		$supply = Supply::find($id);
		return View('stockcard.create')
				->with('supply',$supply)
				->with('title','Stock Card');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$purchaseorder = $this->sanitizeString(Input::get('purchaseorder'));
		$deliveryreceipt = $this->sanitizeString(Input::get('dr'));
		$date = $this->sanitizeString(Input::get('date'));
		$office = 'N/A';
		$daystoconsume = $this->sanitizeString(Input::get("daystoconsume"));
		$stocknumber = Input::get("stocknumber");
		$receiptquantity = Input::get("quantity");

		$validator = Validator::make([
			'Stock Number' => $stocknumber,
			'Purchase Order' => $purchaseorder,
			'Delivery Receipt' => $deliveryreceipt,
			'Date' => $date,
			'Receipt Quantity' => $receiptquantity,
			'Office' => $office,
			'Days To Consume' => $daystoconsume
		],SupplyTransaction::$receiptRules);

		if($validator->fails())
		{
			return redirect("inventory/supply/$stocknumber/stockcard/create")
					->withInput()
					->withErrors($validator);
		}

		$transaction = new SupplyTransaction;
		$transaction->date = $date;
		$transaction->stocknumber = $stocknumber;
		$transaction->purchaseorderno = $purchaseorder;
		$transaction->reference = $purchaseorder . ", " . $deliveryreceipt;
		$transaction->office = $office;
		$transaction->quantity  = $receiptquantity;
		$transaction->daystoconsume = $daystoconsume;
		$transaction->receipt();

		Session::flash('success-message','Operation Successful');
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
			$transaction = SupplyTransaction::with('supply')->where('stocknumber','=',$this->sanitizeString($id))->get();
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
		Session::flash('success-message','Operation Successful');
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
		$supply = Supply::find($id);
		$balance = Supply::where('stocknumber','=',$supply->stocknumber)->first()->balance;
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
	public function destroy($supplyId,$id)
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
			'Issue Quantity' => $issuequantity,
			'Office' => $office,
			'Days To Consume' => $daystoconsume
		],SupplyTransaction::$issueRules);

		if($validator->fails())
		{
			return redirect("inventory/supply/$stocknumber/stockcard/release")
					->withInput()
					->withErrors($validator);
		}

		$balance = Supply::where('stocknumber','=',$stocknumber)->first()->balance;
		if($issuequantity > $balance)
		{
			return redirect("inventory/supply/$stocknumber/stockcard/release")
					->withInput()
					->withErrors([ "You cannot release quantity of $stocknumber which is greater than the remaining balance ($balance)" ]);

		}

		$transaction = new SupplyTransaction;
		$transaction->date = $date;
		$transaction->stocknumber = $stocknumber;
		$transaction->purchaseorderno = $purchaseorder;
		$transaction->reference = $reference;
		$transaction->office = $office;
		$transaction->quantity  = $issuequantity;
		$transaction->daystoconsume = $daystoconsume;
		$transaction->issue();

		Session::flash('success-message','Operation Successful');
		return redirect("inventory/supply/$stocknumber/stockcard");
	}

	public function batchAcceptForm()
	{
		return view('stockcard.batch.accept')
		->with('title','Batch Accept');
	}

	public function batchAccept()
	{
		$purchaseorder = $this->sanitizeString(Input::get('purchaseorder'));
		$deliveryreceipt = $this->sanitizeString(Input::get('dr'));
		$date = $this->sanitizeString(Input::get('date'));
		$office = $this->sanitizeString(Input::get('office'));
		$daystoconsume = $this->sanitizeString(Input::get("daystoconsume"));
		$stocknumber = Input::get("stocknumber");
		$receiptquantity = Input::get("quantity");

		$username = Auth::user()->firstname . " " . Auth::user()->middlename . " " . Auth::user()->lastname;
		$date = Carbon\Carbon::parse($date);

		DB::beginTransaction();

		foreach($stocknumber as $_stocknumber)
		{
			$validator = Validator::make([
				'Stock Number' => $_stocknumber,
				'Purchase Order' => $purchaseorder,
				'Date' => $date,
				'Receipt Quantity' => $receiptquantity["$_stocknumber"],
				'Office' => $office,
				'Days To Consume' => $daystoconsume
			],SupplyTransaction::$receiptRules);

			if($validator->fails())
			{
				DB::rollback();
				return redirect("inventory/supply/stockcard/batch/form/accept")
						->with('total',count($stocknumber))
						->with('stocknumber',$stocknumber)
						->with('quantity',$receiptquantity)
						->with('daystoconsume',$daystoconsume)
						->withInput()
						->withErrors($validator);
			}

			$transaction = new SupplyTransaction;
			$transaction->date = $date;
			$transaction->stocknumber = $_stocknumber;
			$transaction->purchaseorderno = $purchaseorder;
			$transaction->reference = $purchaseorder . ", " . $deliveryreceipt;
			$transaction->office = 'N/A';
			$transaction->quantity  = $receiptquantity["$_stocknumber"];
			$transaction->daystoconsume = $daystoconsume;
			$transaction->receipt();
		}

		DB::commit();

		Session::flash('success-message','Supplies Accepted');
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
		$issuequantity = Input::get("quantity");

		DB::beginTransaction();
		foreach($stocknumber as $_stocknumber)
		{
			$validator = Validator::make([
				'Stock Number' => $stocknumber,
				'Requisition and Issue Slip' => $reference,
				'Date' => $date,
				'Issue Quantity' => $issuequantity["$_stocknumber"],
				'Office' => $office,
				'Days To Consume' => $daystoconsume
			],SupplyTransaction::$issueRules);

			$balance = Supply::where('stocknumber','=',$_stocknumber)->first()->balance;
			if($validator->fails() || $issuequantity["$_stocknumber"] > $balance)
			{

				DB::rollback();

				if($issuequantity["$_stocknumber"] > $balance)
				{
					$validator = [ "You cannot release quantity of $_stocknumber which is greater than the remaining balance ($balance)" ];
				}

				return redirect("inventory/supply/batch/form/release")
						->with('total',count($stocknumber))
						->with('stocknumber',$stocknumber)
						->with('quantity',$issuequantity)
						->with('daystoconsume',$daystoconsume)
						->withInput()
						->withErrors($validator);
			}

			$transaction = new SupplyTransaction;
			$transaction->date = $date;
			$transaction->stocknumber = $_stocknumber;
			$transaction->purchaseorderno = $purchaseorder;
			$transaction->reference = $reference;
			$transaction->office = $office;
			$transaction->quantity  = $issuequantity["$_stocknumber"];
			$transaction->daystoconsume = $daystoconsume;
			$transaction->issue();
		}

		DB::commit();

		Session::flash('success-message','Supplies Released');
		return redirect('inventory/supply');
	}

	/*
	*
	* returns all stocknumber from supply
	*
	*/
	public function getAllStockNumber()
	{
		if(Request::ajax())
		{
			return json_encode(Supply::pluck('stocknumber')->toArray());
		}
	}

	/*
	* retuns supply stocknumber list based on input
	* used in autocomplete
	*/
	public function getSupplyStockNumber()
	{
		if(Request::ajax())
		{
			$stocknumber = $this->sanitizeString(Input::get('term'));
			return json_encode(Supply::where('stocknumber','like','%'.$stocknumber.'%')->pluck('stocknumber')->toArray());
		}
	}

	public function printStockCard($stocknumber)
	{
		$supply = Supply::find($stocknumber);

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
		$supplies = Supply::all();
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
