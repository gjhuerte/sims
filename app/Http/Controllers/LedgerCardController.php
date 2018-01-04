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
		$deliveryreceipt = $this->sanitizeString($request->get('dr'));
		$date = $this->sanitizeString($request->get('date'));
		$daystoconsume = $request->get("daystoconsume");
		$stocknumbers = $request->get("stocknumber");
		$receiptquantity = $request->get("quantity");
		$receiptunitcost = $request->get("unitcost");
		$invoice = $this->sanitizeString($request->get('invoice'));

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
			$transaction->receipt = $deliveryreceipt;
			$transaction->invoice = $invoice;
			$transaction->issued_quantity = null;
			$transaction->received_quantity = $receiptquantity["$stocknumber"];
			$transaction->received_unitcost = $receiptunitcost["$stocknumber"];
			$transaction->issued_unitcost = $receiptunitcost["$stocknumber"];
			$transaction->daystoconsume = $daystoconsume["$stocknumber"];
			$transaction->created_by = Auth::user()->id;
			$transaction->receipt();
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
		$transaction->received_quantity = null;
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

	public function printSummaryLedgerCard($stocknumber)
	{
		$ledgercard = App\MonthlyLedgerCardView::findByStockNumber($stocknumber)
								->get();

		$supply = App\Supply::find($stocknumber);

		$data = ['supply' => $supply, 'ledgercard' => $ledgercard ];

		$filename = "App\LedgerCardSummary-".Carbon\Carbon::now()->format('mdYHm')."-$stocknumber.pdf";
		$view = "ledgercard.print_index";

		return $this->printPreview($view,$data,$filename);

	}

	public function printLedgerCard($stocknumber)
	{

		$ledgercard = App\LedgerCard::findByStockNumber($stocknumber)->get();
		$supply = App\Supply::find($stocknumber);

		$data = ['supply' => $supply, 'ledgercard' => $ledgercard ];

		$filename = "App\LedgerCard-".Carbon\Carbon::now()->format('mdYHm')."-$stocknumber.pdf";
		$view = "ledgercard.print_show";

		return $this->printPreview($view,$data,$filename);

	}

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
			 * first in first out
			 * returns the first cost it found
			 * Note: quantity is not applied
			 */
			if($type == 'fifo')
			{

				$supply = App\Supply::findByStockNumber($stocknumber)->receipts()->each(function($item, $key) use($supply) {
					if($item->pivot->remaining_quantity <= 0) $supply->receipts->forget($key);
				})->orderBy('date_delivered','desc');
									
				$supply->pluck('cost');

				if(count($supply) > 0)
				{
					return json_encode($supply);	
				}

			}
			else
			{

				$supply = App\ReceiptSupply::findByStockNumber($stocknumber)
										->where('remaining_quantity','>',0)
										->select('cost')
										->pluck('cost');

				if(count($supply) > 0)
				{
					$total = $supply->sum();
					$count = count($supply);

					return json_encode($total/$count);
				}
			}

			return json_encode(0);
		}
	}

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

	public function copy(Request $request)
	{
		$unitcost = $request->get('unitcost');
		$fundcluster = $request->get('fundcluster');
		$record = $request->get('record');
		$issued = $record['issued'];
		$organization = $record['organization'];
		$received = $record['received'];
		$stocknumber = $record['stocknumber'];
		$reference = $record['reference'];
		$receipt = $record['receipt'];
		$date = $record['date'];
		$daystoconsume = "";

		$transaction = App\LedgerCard::where('date','=', $date)
						->where('reference','=', $reference)
						->where('receipt','=', $receipt)
						->where('received_unitcost','=', $unitcost)
						->where('issued_unitcost','=', $unitcost)
						->findByStockNumber($stocknumber)
						->get();

		if(count($transaction) > 0) return json_encode('duplicate');

		DB::beginTransaction();

		$transaction = new App\LedgerCard;
		$transaction->date = Carbon\Carbon::parse($date);
		$transaction->stocknumber = $stocknumber;
		$transaction->reference = $reference;
		$transaction->receipt = $receipt;
		$transaction->fundcluster = $fundcluster;
		$transaction->received_unitcost = $unitcost;
		$transaction->issued_unitcost = $unitcost;
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

				return json_encode('error');
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

				return json_encode('error');
			}

			$transaction->received_quantity = $received;
			$transaction->receipt();
		endif;

		DB::commit();

		return json_encode('success');
	}

}
