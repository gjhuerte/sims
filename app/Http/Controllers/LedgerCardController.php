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
				'data' => App\MonthlyLedgerCardView::findByStockNumber($stocknumber)
								->get()
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
	public function create(Request $request)
	{
		$supplier = App\Supplier::pluck('name','name');
		return view('ledgercard.accept')
				->with('supplier',$supplier)
				->with('type', 'ledger')
				->with('title','Accept');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

		$purchaseorder = $this->sanitizeString($request->get('purchaseorder'));
		$organization = $this->sanitizeString($request->get('supplier'));
		$receipt = $this->sanitizeString($request->get('receipt'));
		$date = $this->sanitizeString($request->get('date'));
		$daystoconsume = $request->get("daystoconsume");
		$stocknumbers = $request->get("stocknumber");
		$receiptquantity = $request->get("quantity");
		$receiptunitcost = $request->get("unitcost");
		$invoice = $this->sanitizeString($request->get('invoice'));
		$fundcluster = $this->sanitizeString($request->get('fundcluster'));

		DB::beginTransaction();

		foreach($stocknumbers as $stocknumber)
		{
			$validator = Validator::make([
				'Stock Number' => $stocknumber,
				'Purchase Order' => $purchaseorder,
				'Date' => $date,
				'Receipt Quantity' => $receiptquantity["$stocknumber"],
				'Receipt Unit Cost' => $receiptunitcost["$stocknumber"],
				'Days To Consume' => $daystoconsume["$stocknumber"]
			], App\LedgerCard::$receiptRules);

			if($validator->fails())
			{
				DB::rollback();

				return redirect("inventory/supply/ledgercard/accept")
						->with('total',count($stocknumbers))
						->with('stocknumber',$stocknumbers)
						->with('quantity',$receiptquantity)
						->with('unitcost',$receiptunitcost)
						->with('daystoconsume',$daystoconsume)
						->withInput()
						->withErrors($validator);
			}


			$transaction = new App\LedgerCard;
			$transaction->date = Carbon\Carbon::parse($date);
			$transaction->stocknumber = $stocknumber;
			$transaction->reference = $purchaseorder;
			$transaction->organization = $organization;
			$transaction->fundcluster = $fundcluster;
			$transaction->receipt = $receipt;
			$transaction->invoice = $invoice;
			$transaction->issued_quantity = 0;
			$transaction->received_quantity = $receiptquantity["$stocknumber"];
			$transaction->received_unitcost = $receiptunitcost["$stocknumber"];
			$transaction->issued_unitcost = $receiptunitcost["$stocknumber"];
			$transaction->daystoconsume = $daystoconsume["$stocknumber"];
			$transaction->created_by = Auth::user()->id;
			$transaction->receive();
		}

		DB::commit();

		\Alert::success('Supplies Added')->flash();
		return redirect('inventory/supply');
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

		if( count($supply) <= 0 ) return view('errors.404');

		$ledgercard = App\LedgerCard::filterByMonth($month)->findByStockNumber($supply->stocknumber)->get();
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
	public function releaseForm(Request $request)
	{
		return View('ledgercard.release')
				->with('type', 'ledger')
				->with('title','Release');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function release(Request $request)
	{
		$reference = $this->sanitizeString($request->get('reference'));
		$date = $this->sanitizeString($request->get('date'));
		$daystoconsume = $request->get("daystoconsume");
		$stocknumbers = $request->get("stocknumber");
		$issuequantity = $request->get("quantity");
		$issueunitcost = $request->get("unitcost");

		DB::beginTransaction();

		foreach($stocknumbers as $stocknumber)
		{
			$validator = Validator::make([
				'Stock Number' => $stocknumber,
				'Requisition and Issue Slip' => $reference,
				'Date' => $date,
				'Issue Quantity' => $issuequantity["$stocknumber"],
				'Issue Unit Cost' => $issueunitcost["$stocknumber"],
				'Days To Consume' => $daystoconsume["$stocknumber"]
			],App\LedgerCard::$issueRules);

			if($validator->fails())
			{
				DB::rollback();

				return redirect("inventory/supply/ledgercard/release")
						->with('total',count($stocknumbers))
						->with('stocknumber',$stocknumbers)
						->with('quantity',$issuequantity)
						->with('unitcost',$issueunitcost)
						->with('daystoconsume',$daystoconsume)
						->withInput()
						->withErrors($validator);
			}
		}

		$transaction = new App\LedgerCard;
		$transaction->date = Carbon\Carbon::parse($date);
		$transaction->stocknumber = $stocknumber;
		$transaction->reference = $reference;
		$transaction->received_quantity = 0;
		$transaction->issued_quantity = $issuequantity["$stocknumber"];
		$transaction->received_unitcost = $issueunitcost["$stocknumber"];
		$transaction->issued_unitcost = $issueunitcost["$stocknumber"];
		$transaction->daystoconsume = $daystoconsume["$stocknumber"];
		$transaction->created_by = Auth::user()->id;
		$transaction->issue();

		DB::commit();

		\Alert::success('Supplies Released')->flash();
		return redirect('inventory/supply');
	}

	/**
	 * [checkIfLedgerCardExists description]
	 * check if the record already existed
	 * @return [type] [description]
	 */
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

	/**
	 * [printAllLedgerCard description]
	 * create a printable format of all ledgercard from the said stock
	 * @return [type] [description]
	 */
	public function printAllLedgerCard()
	{
		$orientation = 'Portrait'
		$supplies = App\Supply::all();
		$data = [
			'supplies' => $supplies
		]; 

		$filename = "App\LedgerCard-".Carbon\Carbon::now()->format('mdYHm').".pdf";
		$view = "ledgercard.print_all_index";

		return $this->printPreview($view,$data,$filename,$orientation);

	}

	/**
	 * [printSummaryLedgerCard description]
	 * returns summary of ledgercard
	 * @param  [type] $stocknumber [description]
	 * @return [type]              [description]
	 */
	public function printSummaryLedgerCard($stocknumber)
	{
		$orientation = 'Portrait'
		$ledgercards = App\MonthlyLedgerCardView::findByStockNumber($stocknumber)
								->get();
		$supply = App\Supply::findByStockNumber($stocknumber);
		$data = ['supply' => $supply, 'ledgercards' => $ledgercards ];

		$filename = "App\LedgerCardSummary-".Carbon\Carbon::now()->format('mdYHm')."-$stocknumber.pdf";
		$view = "ledgercard.print_index";

		return $this->printPreview($view,$data,$filename,$orientation);

	}

	/**
	 * [printLedgerCard description]
	 * creates a printable format of ledger card
	 * @param  [type] $stocknumber [description]
	 * @return [type]              [description]
	 */
	public function printLedgerCard($stocknumber)
	{
		$orientation = 'Portrait'
		$supply = App\Supply::find($stocknumber);
		$ledgercards = App\LedgerCard::findBySupplyId($supply->id)->get();

		$data = ['supply' => $supply, 'ledgercards' => $ledgercards ];

		$filename = "App\LedgerCard-".Carbon\Carbon::now()->format('mdYHm')."-$stocknumber.pdf";
		$view = "ledgercard.print_show";

		return $this->printPreview($view,$data,$filename,$orientation);

	}

	/**
	 * [computeCost description]
	 * returns the computed cost
	 * types
	 * fifo - first come first serve
	 * average - average cost of item
	 * @param  Request $request [description]
	 * @param  [type]  $type    [description]
	 * @return [type]           [description]
	 */
	public function computeCost(Request $request, $type)
	{
		if($request->ajax())
		{
			/**
			 * receive quantity attribute
			 * @var [type]
			 */
			$stocknumber = $this->sanitizeString(Input::get('stocknumber'));
			$quantity = $this->sanitizeString(Input::get('quantity'));

			/**
			 * [$supplies description]
			 * fetch the supplies from database that matches the stocknumber
			 * @var [type]
			 */
			$supply = App\Supply::findByStockNumber($stocknumber);

			/**
			 * first in first out
			 * returns the first cost it found
			 * Note: quantity is not applied
			 */
			if($type == 'fifo')
			{

				$unitcost = App\ReceiptSupply::where('supply_id', '=', $supply->id)
								->where('remaining_quantity', '>' ,0)
								->where('unitcost', '>', 0)
								->whereNotNull('unitcost')
								->leftJoin('receipts', 'receipts.id', '=', 'receipts_supplies.receipt_id')
								->orderBy('receipts.date_delivered', 'asc')
								->pluck('unitcost')
								->first();

				if(count($supply) > 0)
				{

					return json_encode(isset($unitcost) ? $unitcost : 0);	
				}

			}

			/**
			 * averages the receipts with remaining quantity
			 * returns the average of receipts
			 */
			else
			{

				$receipt = App\ReceiptSupply::where('supply_id', '=', $supply->id)
								->where('remaining_quantity', '>' ,0)
								->where('unitcost', '>', 0)
								->whereNotNull('unitcost')
								->get();

				if(count($supply) > 0)
				{
					$total = $receipt->sum('unitcost');

					$count = count($receipt);

					return json_encode($total/$count);
				}
			}

			return json_encode(0);
		}
	}

	/**
	 * [showUncopiedRecords description]
	 * returns list of records from stockcard 
	 * not on ledgercard
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function showUncopiedRecords(Request $request)
	{
		if($request->ajax())
		{
			$count = App\StockCard::count();
			$stockcards =  App\StockCard::whereDoesntHave('transaction')
					->with('supply')
					->take($count);
			return datatables($stockcards)->toJson();
		}

		return view('record.uncopied');
	}

	/**
	 * [copy description]
	 * sync records from stockcard to ledger card
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function copy(Request $request)
	{
		$unitcost = $this->sanitizeString( $request->get('unitcost') );
		$fundcluster = $this->sanitizeString( $request->get('fundcluster') );
		$id = $this->sanitizeString( $request->get('id') );

		$stockcard = App\StockCard::find($id);

		/**
		 * check if the record exists in database
		 */
		if(count($stockcard) <= 0) return json_encode('not found');

		/**
		 * [$reference description]
		 * if the field is found assign to variables
		 * @var [type]
		 */
		$reference = $stockcard->reference;
		$date = $stockcard->date;
		$receipt = $stockcard->receipt;
		$stocknumber = $stockcard->supply->stocknumber;
		$daystoconsume = $stockcard->daystoconsume;
		$issued = $stockcard->issued_quantity;
		$received = $stockcard->received_quantity;

		/**
		 * [$transaction description]
		 * check if the record exists in database
		 * if the record exists the transaction will have an
		 * object assigned
		 * @var [type]
		 */
		$transaction = App\LedgerCard::where('date','=', $date)
						->where('reference','=', $reference)
						->where('receipt','=', $receipt)
						->where('received_unitcost','=', $unitcost)
						->where('issued_unitcost','=', $unitcost)
						->findByStockNumber($stocknumber)
						->get();

		/**
		 * if transaction exists
		 * the record will return an error
		 * saying the record has already been saved
		 */
		if(count($transaction) > 0) return json_encode('duplicate');

		DB::beginTransaction();

		if($receipt == 'N/A') $receipt = null;

		$transaction = new App\LedgerCard;
		$transaction->date = Carbon\Carbon::parse($date);
		$transaction->stocknumber = $stocknumber;
		$transaction->reference = $reference;
		$transaction->receipt = $receipt;
		$transaction->fundcluster = $fundcluster;
		$transaction->received_unitcost = $transaction->issued_unitcost = $unitcost;
		$transaction->daystoconsume = $daystoconsume;
		$transaction->created_by = Auth::user()->id;

		if($issued > 0 && $issued != null):

			$validator = Validator::make([
				'Stock Number' => $stocknumber,
				'Requisition and Issue Slip' => $reference,
				'Date' => $date,
				'Issue Quantity' => $issued,
				'Issue Unit Cost' => $unitcost,
				'Days To Consume' => $daystoconsume
			],App\LedgerCard::$issueRules);

			if($validator->fails())
			{
				DB::rollback();
				return json_encode([ 'error', $validator ]);
			}

			$transaction->issued_quantity = $issued;
			$transaction->issue();
		endif;

		if($received > 0 && $received != null):

			$validator = Validator::make([
				'Stock Number' => $stocknumber,
				'Purchase Order' => $reference,
				'Date' => $date,
				'Receipt Quantity' => $received,
				'Receipt Unit Cost' => $unitcost,
				'Days To Consume' => $daystoconsume
			], App\LedgerCard::$receiptRules);

			if($validator->fails())
			{
				DB::rollback();
				return json_encode([ 'error', $validator ]);
			}

			$transaction->received_quantity = $received;
			$transaction->receive();
		endif;

		DB::commit();

		return json_encode('success');
	}

}
