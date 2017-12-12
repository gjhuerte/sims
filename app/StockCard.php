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
								->orderBy('date','desc')
								->orderBy('created_at','desc')
								->orderBy('id','desc')
								->first();

		if(!isset($this->received))
		{
			$this->received = 0;
		}

		if(!isset($this->issued))
		{
			$this->issued = 0;
		}

		$this->balance = (isset($stockcard->balance) ? $stockcard->balance : 0) + ( $this->received - $this->issued ) ;
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
		$supplier = null;

		if(isset($this->organization))
		{
			$supplier = Supplier::firstOrCreate([ 'name' => $this->organization ]);
		}

		if(isset($this->receipt) && $this->receipt != null)
		{

			$receipt = Receipt::firstOrCreate([ 
				'number' => $this->receipt 
			], [
				'reference' => isset($this->reference) ? $this->reference : null,
				'date_delivered' => Carbon\Carbon::parse($this->date),
				'received_by' => $fullname,
				'supplier_name' => $this->organization
			]);

			$supply = ReceiptSupply::firstOrNew([
				'receipt_number' => $receipt->number,
				'stocknumber' => $this->stocknumber
			]);


			$supply->remaining_quantity = (isset($supply->remaining_quantity) ? $supply->remaining_quantity : 0) + $this->received;
			$supply->quantity = (isset($supply->quantity) ? $supply->quantity : 0) + $this->received;
			$supply->stocknumber = $this->stocknumber;
			$supply->save();
			
		}

		if(isset($this->reference) && $this->reference != null)
		{
			$purchaseorder = PurchaseOrder::firstOrCreate([
				'number' => $this->reference 
			], [
				'date_received' => Carbon\Carbon::parse($this->date),
				'supplier_id' => $supplier->id
			]);

			if(isset($this->fundcluster) &&  count(explode(",",$this->fundcluster)) > 0)
			{
				foreach(explode(",",$this->fundcluster) as $fundcluster)
				{
					$fundcluster = FundCluster::firstOrCreate( [ 'code' => $fundcluster ] );
					PurchaseOrderFundCluster::firstOrCreate([ 'purchaseorder_number' => $purchaseorder->number, 'fundcluster_code' => $fundcluster->code ]);
				}
			}

			$supply = PurchaseOrderSupply::firstOrNew([
				'purchaseorder_number' => $purchaseorder->number,
				'stocknumber' => $this->stocknumber
			]);

			$supply->orderedquantity = ( isset($supply->orderedquantity) ? $supply->orderedquantity : 0 ) + $this->received;
			$supply->remainingquantity = ( isset($supply->remainingquantity) ? $supply->remainingquantity : 0 ) + $this->received;
			$supply->receivedquantity = ( isset($supply->receivedquantity) ? $supply->receivedquantity : 0 ) + $this->received ;
			$supply->save();

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

		if(count($purchaseorder) == 0)
		{
			$this->setBalance();
			$this->save();
		}
		else
		{

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
}