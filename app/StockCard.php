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
		'Purchase Order' => 'nullable',
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

	/**
	 * custom attributes
	 * used by processes under stockcard
	 */
	public $stocknumber = null;
	public $supplier_id = null;

	protected $appends = [
		'parsed_date'
	];

	public function getParsedDateAttribute()
	{
		return Carbon\Carbon::parse($this->date)->toFormattedDateString();
	}

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

	/**
	 * transaction is a custom view
	 * consists of combination of ledger card and stock card
	 * this is for querying values not in transaction
	 * checking if the record from stockcard is sync with ledger card
	 */
	public function transaction()
	{
		return $this->belongsTo('App\Transaction','id','id');
	}

	/*
	*
	*	Referencing to Supply Table
	*	One-to-many attribute
	*
	*/
	public function supply()
	{
		return $this->belongsTo('App\Supply','supply_id','id');
	}

	/**
	 * [scopeFilterByMonth description]
	 * @param  [type] $query [description]
	 * @param  [type] $date  [description]
	 * @return [type]        [description]
	 * query per month. receives a date
	 * check if the date is between the start and end of month
	 * in the database
	 */
	public function scopeFilterByMonth($query, $date)
	{

		return $query->whereBetween('date',[
					$date->startOfMonth()->toDateString(),
					$date->endOfMonth()->toDateString()
				]);
	}

	/**
	 * [scopeFilterByIssued description]
	 * @param  [type] $query [description]
	 * @return [type]        [description]
	 */
	public function scopeFilterByIssued($query)
	{
		return $query->where('issued_quantity','>',0);
	}

	/**
	 * [scopeFilterByReceived description]
	 * @param  [type] $query [description]
	 * @return [type]        [description]
	 */
	public function scopeFilterByReceived($query)
	{
		return $query->where('received_quantity','>',0);
	}

	/**
	 * [scopeFindBySupplyId description]
	 * @param  [type] $query [description]
	 * @param  [type] $value [description]
	 * @return [type]        [description]
	 */
	public function scopeFindBySupplyId($query, $value)
	{
		return $query->where('supply_id', '=', $value);
	}

	/**
	 * [scopeFindByStockNumber description]
	 * @param  [type] $query [description]
	 * @param  [type] $value [description]
	 * @return [type]        [description]
	 */
	public function scopeFindByStockNumber($query, $value)
	{
		return $query->whereHas('supply', function($query) use ($value){
			$query->where('stocknumber', '=', $value);
		});
	}

	/**
	 * [setBalance description]
	 * set the balance column by
	 * difference of previous plus
	 * sum of difference of received and issued
	 * (pb) + (cr - ci)
	 * pb - previous balance
	 * cr - current received
	 * ci - current issued
	 */
	public function setBalance()
	{
		$received_quantity = isset($this->received_quantity) ? $this->received_quantity : 0;
		$issued_quantity = isset($this->issued_quantity) ? $this->issued_quantity : 0;
		$this->balance_quantity = 0;

		$stockcard = StockCard::findByStockNumber($this->stocknumber)
								->orderBy('date','desc')
								->orderBy('created_at','desc')
								->orderBy('id','desc')
								->first();

		$this->balance_quantity = (isset($stockcard->balance_quantity) ? $stockcard->balance_quantity : 0) + ( $received_quantity - $issued_quantity ) ;
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

		$supply = Supply::findByStockNumber($this->stocknumber);

		/**
		 * if organization column exists
		 * find the supplier from the database
		 * return the information
		 * else
		 * create new supplier
		 */
		if(isset($this->organization))
		{
			$supplier = Supplier::firstOrCreate([ 'name' => $this->organization ]);
		}

		/**
		 * finds the receipt in the database
		 * create new if not found
		 */
		if(isset($this->receipt) && $this->receipt != null)
		{

			$receipt = Receipt::firstOrCreate([
				'number' => $this->receipt
			], [
				'purchaseorder_id' => isset($this->purchaseorder_id) ? $this->purchaseorder_id : null,
				'date_delivered' => Carbon\Carbon::parse($this->date),
				'received_by' => $fullname,
				'supplier_id' => isset($supplier->id) ? $supplier->id : null
			]);

			$receipt->supplies()->attach([ $supply->id => [
				'remaining_quantity' =>  (isset($supply->remaining_quantity) ? $supply->remaining_quantity : 0) + $this->received_quantity,
				'quantity' => (isset($supply->quantity) ? $supply->quantity : 0) + $this->received_quantity,
			] ]);
		}

		/**
		 * finds the purchase order in the database
		 * create new if not found
		 */
		if(isset($this->reference) && $this->reference != null)
		{
			$purchaseorder = PurchaseOrder::firstOrCreate([
				'number' => $this->reference
			], [
				'date_received' => Carbon\Carbon::parse($this->date),
				'supplier_id' => $supplier->id
			]);

			/**
			 * if fund cluster field exists
			 * assign fund cluster to purchase order
			 * else 
			 * create new fund cluster record
			 */
			if(isset($this->fundcluster) &&  count(explode(",",$this->fundcluster)) > 0)
			{
				$purchaseorder->fundclusters()->detach();
				foreach(explode(",",$this->fundcluster) as $fundcluster)
				{
					$fundcluster = FundCluster::firstOrCreate( [ 'code' => $fundcluster ] );
					$fundcluster->purchaseorders()->attach($purchaseorder->id);
				}
			}

			$purchaseorder->supplies()->sync([
				$supply->id => [
					'ordered_quantity' => ( isset($this->orderedquantity) ? $this->orderedquantity : 0 ) + $this->received_quantity,
					'remaining_quantity' => ( isset($this->remainingquantity) ? $this->remainingquantity : 0 ) + $this->received_quantity,
					'received_quantity' => ( isset($this->receivedquantity) ? $this->receivedquantity : 0 ) + $this->received_quantity,
				]
			]);

		}

		$this->setBalance();
		$this->supply_id = $supply->id;
		$this->save();
	}


	/*
	*
	*	Call this function when releasing
	*	links to purchase order
	*
	*/
	public function issue()
	{
		$firstname = Auth::user()->firstname;
		$middlename =  Auth::user()->middlename;
		$lastname = Auth::user()->lastname;
		$username =  $firstname . " " . $middlename . " " . $lastname;

		$supply = Supply::findByStockNumber($this->stocknumber);

		$supplies = $supply->purchaseorders->each(function($item, $key) use($supply) {
			if($item->pivot->remaining_quantity <= 0) $supply->purchaseorders->forget($key);
		});

		$this->supply_id = $supply->id;

		if(count($supplies) <= 0)
		{
			$this->setBalance();
			$this->save();
		}
		else
		{

			/**
			 *	loops through each record
			 *	reduce the quantity of purchase order for each record
			 *	
			 */
			$supply->purchaseorders->each(function($item, $value) use ($supply) {
				if($this->issued_quantity > 0)
				{

					if($item->pivot->remaining_quantity >= $this->issued_quantity)
					{
						$item->pivot->remaining_quantity = $item->pivot->remaining_quantity - $this->issued_quantity;
						$this->setBalance();
						$this->save();
						$this->issued_quantity = 0;
					}
					else
					{
						$this->issued_quantity = $this->issued_quantity - $item->pivot->remaining_quantity;
						$item->pivot->remaining_quantity = 0;
						$this->setBalance();
						$this->save();
					}

					$item->pivot->save();
				}
			});
		}

	}
}
