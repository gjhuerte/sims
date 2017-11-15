<?php
namespace App\Http\Controllers;

use App;
use Auth;
use Carbon;
use Session;
use Validator;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class LedgerCardController extends Controller {

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
				'data' => App\LedgerCard::findByStockNumber($stocknumber)
								->get()
								->groupBy(function($item) {
						            return Carbon\Carbon::parse($item->date)->format('F Y');
						        })
			]);
		}

		$supply = App\Supply::find($stocknumber);

		return view('ledgercard.index')
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
		return view('ledgercard.create')
				->with('supply',$supply)
				->with('supplier',$supplier)
				->with('title','Supply Ledger Card');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$stocknumber = $this->sanitizeString(Input::get('stocknumber'));
		$reference = $this->sanitizeString(Input::get('reference'));
		$date = $this->sanitizeString(Input::get('date'));
		$receiptquantity = $this->sanitizeString(Input::get('quantity'));
		$receiptunitprice = $this->sanitizeString(Input::get('unitprice'));
		$daystoconsume = $this->sanitizeString(Input::get('daystoconsume'));

		$validator = Validator::make([
			'Date' => $date,
			'Stock Number' => $stocknumber,
			'Purchase Order' => $reference,
			'Receipt Quantity' => $receiptquantity,
			'Receipt Unit Price' => $receiptunitprice,
			'Days To Consume' => $daystoconsume
		],App\LedgerCard::$receiptRules);

		if($validator->fails())
		{
			return redirect("inventory/supply/$stocknumber/ledgercard/create")
					->withInput()
					->withErrors($validator);
		}

		$transaction = new App\LedgerCard;
		$transaction->date = Carbon\Carbon::parse($date);
		$transaction->stocknumber = $stocknumber;
		$transaction->reference = $reference;
		$transaction->receivedquantity = $receiptquantity;
		$transaction->receivedunitprice = $receivedunitprice;
		$transaction->daystoconsume = $daystoconsume;
		$transaction->created_by = Auth::user()->id;
		$transaction->receipt();

		App\LedgerCard::receipt($date,$stocknumber,$reference,$receiptquantity,$receiptunitprice,$daystoconsume);

		\Alert::success('Supplies Added')->flash();
		return redirect("inventory/supply/$stocknumber/ledgercard");
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request, $id,$month)
	{
		if($request->ajax())
		{
			$transaction = StockCard::with('supply')->findByStockNumber($id)->get();
			return json_encode([ 'data' => $transaction ]);
		}

		$supply = App\Supply::find($id);

		$ledgercard = App\LedgerCard::filterByMonth($month)->findByStockNumber($id)->get();
		return view('ledgercard.show')
				->with('ledgercard',$ledgercard)
				->with('month',Carbon\Carbon::parse($month)->format('F Y'))
				->with('supply',$supply)
				->with('title',$supply->stocknumber);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return redirect("inventory/supply/$id/ledgercard");
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return redirect("inventory/supply/$id/ledgercard");
	}

	/**
	 * Show the form for releasing
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function releaseForm($id)
	{
		$id = $this->sanitizeString($id);
		return view('ledgercard.show')
				->with('supply',App\Supply::find($id))
				->with('balance',App\LedgerCard::getRemainingBalance($id));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		$stocknumber = $this->sanitizeString(Input::get('stocknumber'));
		$reference = $this->sanitizeString(Input::get('reference'));
		$date = $this->sanitizeString(Input::get('date'));
		$issuequantity = $this->sanitizeString(Input::get('quantity'));
		$issueunitprice = $this->sanitizeString(Input::get('unitprice'));
		$daystoconsume = $this->sanitizeString(Input::get('daystoconsume'));

		$validator = Validator::make([
			'Date' => $date,
			'Stock Number' => $stocknumber,
			'Requisition and Issue Slip' => $reference,
			'Issue Quantity' => $issuequantity,
			'Issue Unit Price' => $issueunitprice,
			'Days To Consume' => $daystoconsume
		],App\LedgerCard::$issueRules);

		if($validator->fails())
		{
			return redirect("inventory/supply/$stocknumber/ledgercard/release")
					->withInput()
					->withErrors($validator);
		}

		App\LedgerCard::issue($date,$stocknumber,$reference,$issuequantity,$issueunitprice,$daystoconsume);
		Session::flash('success-message','Operation Successful');
		return redirect("inventory/supply/$stocknumber/ledgercard");
	}

	public function batchAcceptForm()
	{
		$supplier = App\Supplier::pluck('name','name');
		return view('ledgercard.batch.accept')
				->with('supplier',$supplier)
				->with('title','Supply Ledger Card');
	}

	public function batchAccept()
	{
		$purchaseorder = $this->sanitizeString(Input::get('purchaseorder'));
		$deliveryreceipt = $this->sanitizeString(Input::get('dr'));
		$date = $this->sanitizeString(Input::get('date'));
		$daystoconsume = $this->sanitizeString(Input::get("daystoconsume"));
		$stocknumbers = Input::get("stocknumber");
		$receiptquantity = Input::get("quantity");
		$receiptunitprice = Input::get("unitprice");
		$invoice = $this->sanitizeString(Input::get('invoice'));

		DB::beginTransaction();

		foreach($stocknumbers as $stocknumber)
		{
			$validator = Validator::make([
				'Stock Number' => $stocknumber,
				'Purchase Order' => $purchaseorder,
				'Date' => $date,
				'Receipt Quantity' => $receiptquantity["$stocknumber"],
				'Receipt Unit Price' => $receiptunitprice["$stocknumber"],
				'Days To Consume' => $daystoconsume
			], App\LedgerCard::$receiptRules);

			if($validator->fails())
			{
				DB::rollback();

				return redirect("inventory/supply/ledgercard/batch/form/accept")
						->with('total',count($stocknumbers))
						->with('stocknumber',$stocknumbers)
						->with('quantity',$receiptquantity)
						->with('unitprice',$receiptunitprice)
						->with('daystoconsume',$daystoconsume)
						->withInput()
						->withErrors($validator);
			}


			$transaction = new App\LedgerCard;
			$transaction->date = Carbon\Carbon::parse($date);
			$transaction->stocknumber = $stocknumber;
			$transaction->reference = $purchaseorder;
			$transaction->receipt = $deliveryreceipt;
			$transaction->invoice = $invoice;
			$transaction->receivedquantity = $receiptquantity["$stocknumber"];
			$transaction->receivedunitprice = $receiptunitprice["$stocknumber"];
			$transaction->issuedunitprice = $receiptunitprice["$stocknumber"];
			$transaction->daystoconsume = $daystoconsume;
			$transaction->created_by = Auth::user()->id;
			$transaction->receipt();
		}

		DB::commit();

		\Alert::success('Supplies Added')->flash();
		return redirect('inventory/supply');
	}

	public function batchReleaseForm()
	{
		return View('ledgercard.batch.release')
				->with('title','Supply Ledger Card');
	}

	public function batchRelease()
	{
		$reference = $this->sanitizeString(Input::get('reference'));
		$date = $this->sanitizeString(Input::get('date'));
		$daystoconsume = $this->sanitizeString(Input::get("daystoconsume"));
		$stocknumber = Input::get("stocknumber");
		$issuequantity = Input::get("quantity");
		$issueunitprice = Input::get("unitprice");

		foreach($stocknumber as $_stocknumber)
		{
			$validator = Validator::make([
				'Stock Number' => $stocknumber,
				'Requisition and Issue Slip' => $reference,
				'Date' => $date,
				'Issue Quantity' => $issuequantity["$_stocknumber"],
				'Issue Unit Price' => $issueunitprice["$_stocknumber"],
				'Days To Consume' => $daystoconsume
			],App\LedgerCard::$issueRules);

			if($validator->fails())
			{
				return redirect("inventory/supply/ledgercard/batch/form/release")
						->with('total',count($stocknumber))
						->with('stocknumber',$stocknumber)
						->with('quantity',$issuequantity)
						->with('unitprice',$issueunitprice)
						->with('daystoconsume',$daystoconsume)
						->withInput()
						->withErrors($validator);
			}
		}

		foreach($stocknumber as $_stocknumber)
		{
			App\LedgerCard::issue($date,$_stocknumber,$reference,$issuequantity["$_stocknumber"],$issueunitprice["$_stocknumber"],$daystoconsume);
		}

		\Alert::success('Supplies Released')->flash();
		return redirect('inventory/supply');
	}

	public function checkIfLedgerCardExists()
	{
		if($request->ajax())
		{
			$quantity = $this->sanitizeString(Input::get('quantity'));
			$reference = $this->sanitizeString(Input::get('reference'));
			$stocknumber = $this->sanitizeString(Input::get('stocknumber'));
			$month = $this->sanitizeString(Input::get('date'));
			return json_encode(App\LedgerCard::isExistingRecord($reference,$stocknumber,$quantity,$month));
		}
	}

	public function printAllLedgerCard()
	{
		$supplies = App\Supply::all();
		$data = [
			'supplies' => $supplies
		];

		$filename = "App\LedgerCard-".Carbon\Carbon::now()->format('mdYHm').".pdf";
		$view = "ledgercard.print_all_index";

		return $this->printPreview($view,$data,$filename);

	}

	public function printLedgerCard($stocknumber)
	{

		$ledgercard = App\LedgerCard::findByStockNumber($stocknumber)->get();
		$supply = App\Supply::find($stocknumber);

		$data = ['supply' => $supply, 'ledgercard' => $ledgercard ];

		$filename = "App\LedgerCardCard-".Carbon\Carbon::now()->format('mdYHm')."-$stocknumber.pdf";
		$view = "ledgercard.print_index";

		return $this->printPreview($view,$data,$filename);

	}

}
