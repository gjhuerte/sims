<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
use Auth;
use DB;
class StockCard extends Model{

	protected $table = 'stockcards';
	protected $primaryKey = 'id';
	public $fundcluster = null;
	public $timestamps = true;
	protected $fillable = [ 'date','stocknumber','reference','receipt', 'received','issued','organization','daystoconsume'];

	// set of rules when receiving an item
	public static $receiptRules = array(
		'Date' => 'required',
		'Stock Number' => 'required',
		'Purchase Order' => 'nullable|exists:purchaseorders,number',
		'Delivery Receipt' => 'nullable',
		'Office' => '',
		'Receipt Quantity' => 'required|integer',
		'Days To Consume' => 'max:100'
	);

	//set of rules when issuing the item
	public static $issueRules = array(
		'Date' => 'required',
		'Stock Number' => 'required',
		'Requisition and Issue Slip' => 'required',
		'Office' => '',
		'Issued Quantity' => 'required|integer',
		'Days To Consume' => 'max:100'
	);

	/*
	*	Formats the day to either Month XX XXXX format (a)
	*	or Month XX XXXX format using carbon
	*	a. Carbon\Carbon::parse($value)->format('F d Y');
	*	b. Carbon\Carbon::parse($value)->toFormattedDateString();
	*/
	public function getDateAttribute($value)
	{
		return Carbon\Carbon::parse($value)->toFormattedDateString();
	}

	public function scopeFilterByMonth($query, $date)
	{

		return $query->whereBetween('date',[
					$date->startOfMonth()->toDateString(),
					$date->endOfMonth()->toDateString()
				]);
	}

	public function scopeFilterByIssued($query)
	{
		return $query->where('issued','>',0);
	}

	/*
	*
	*	Referencing to Supply Table
	*	One-to-many attribute
	*
	*/
	public function supply()
	{
		return $this->belongsTo('App\Supply','stocknumber','stocknumber');
	}

	public function setBalance()
	{
		$stockcard = StockCard::where('stocknumber','=',$this->stocknumber)
								->orderBy('created_at','desc')
								->first();

		if(!isset($this->received))
		{
			$this->received = 0;
		}

		if(!isset($this->issued))
		{
			$this->issued = 0;
		}

		if( count($stockcard) > 0 )
		{
			$this->balance = $stockcard->balance + ( $this->received - $this->issued );
		}
		else
		{
			$this->balance = $this->received - $this->issued;
		}
	}

	/*
	*
	*	Call this function when receiving an item
	*
	*/
	public function receipt()
	{
		$firstname = Auth::user()->firstname;
		$middlename =  Auth::user()->middlename;
		$lastname = Auth::user()->lastname;
		$fullname =  $firstname . " " . $middlename . " " . $lastname;

		if(isset($this->receipt) && $this->receipt != null)
		{

			$receipt = Receipt::where('number','=',$this->receipt)->first();

			if( count($receipt) <= 0 )
			{

				$receipt = new Receipt;
				$receipt->reference = $this->reference;
				$receipt->number = $this->receipt;
				$receipt->date_delivered = Carbon\Carbon::parse($this->date);
				$receipt->received_by = $fullname;

				if($this->organization != null && isset($this->organization))
				{
					$supplier = Supplier::where('name','=',$this->organization)
											->get();

					if(count($supplier) <= 0 && $supplier != null)
					{
						$org = new Supplier;
						$org->name = $this->organization;
						$org->save();
					}
				}

				$receipt->supplier_name = $this->organization;
				$receipt->save();
			}

			$supply = ReceiptSupply::where('receipt_number','=',$receipt->number )
										->where('stocknumber','=',$this->stocknumber)
										->first();

			if( count($supply) > 0 )
			{

				$supply->quantity = $this->received + $supply->quantity;
				$supply->remaining_quantity = $supply->remaining_quantity + $this->received;
			}
			else
			{
				$supply = new ReceiptSupply;
				$supply->receipt_number = $this->receipt;
				$supply->stocknumber = $this->stocknumber;
				$supply->quantity = $supply->remaining_quantity = $this->received;
			}

			$supply->save();
			
		}

		if(isset($this->reference) && $this->reference != null)
		{

			$purchaseorder = PurchaseOrderSupply::where('purchaseorder_number','=',$this->reference)
														->where('stocknumber','=',$this->stocknumber)
														->first();

			if(count($purchaseorder) > 0)
			{
				$purchaseorder->remainingquantity = $purchaseorder->remainingquantity + $this->received;
				$purchaseorder->receivedquantity = $purchaseorder->receivedquantity + $this->received;
				$purchaseorder->save();
			}

		}

		if(isset($this->fundcluster) && $this->fundcluster != null && count(explode(",",$this->fundcluster)) > 0)
		{
			$purchaseorder = PurchaseOrder::where("number","=",$this->reference)->first();
			foreach(explode(",",$this->fundcluster) as $fundcluster)
			{
				$fundcluster = FundCluster::create( [ 'code' => $fundcluster ] );
				PurchaseOrderFundCluster::create([ 'purchaseorder_number' => $purchaseorder->number, 'fundcluster_code' => $fundcluster->code ]);
			}
		}

		$this->setBalance();
		$this->save();
	}


	/*
	*
	*	Call this function when releasing
	*
	*/
	public function issue()
	{
		$firstname = Auth::user()->firstname;
		$middlename =  Auth::user()->middlename;
		$lastname = Auth::user()->lastname;
		$username =  $firstname . " " . $middlename . " " . $lastname;

		$purchaseorder = PurchaseOrderSupply::where('stocknumber','=',$this->stocknumber)
												->where('remainingquantity','>',0)
												->get();

		foreach($purchaseorder as $purchaseorder)
		{
			if($this->issued > 0)
			{

				if($purchaseorder->remainingquantity >= $this->issued)
				{
					$purchaseorder->remainingquantity = $purchaseorder->remainingquantity - $this->issued;
					$this->setBalance();
					$this->save();
					$this->issued = 0;
				}
				else
				{
					$this->issued = $this->issued - $purchaseorder->remainingquantity;
					$purchaseorder->remainingquantity = 0;
					$this->setBalance();
					$this->save();
				}

				$purchaseorder->save();
			}
		}

	}
}