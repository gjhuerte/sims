<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
use Auth;
use DB;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\UserResolver;
use Event;

class StockCard extends Model implements Auditable, UserResolver
{
    use \OwenIt\Auditing\Auditable;
    
	protected $auditInclude = [ 'date','stocknumber','reference','receipt', 'received','issued','organization','daystoconsume']; 
	
	/**
     * {@inheritdoc}
     */
    public static function resolveId()
    {
        return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    }

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
	public $invoice_date = null;
	public $invoice = null;
	public $dr_date = null;

	protected $appends = [
		'parsed_date', 'reference_information', 'month', 'parsed_month', 'supply_name', 'stocknumber'
	];

	public function getSupplyNameAttribute($value)
	{
		return count($this->supply) > 0 ? $this->supply->details : 'N/A';
	}

	public function getStocknumberAttribute($value)
	{
		return count($this->supply) > 0 ? $this->supply->stocknumber : 'N/A';
	}

	public function getMonthAttribute($value)
	{
		$date = Carbon\Carbon::parse($this->date);
		return $date->month . ' ' . $date->year;
	}

	public function getParsedMonthAttribute($value)
	{
		$date = Carbon\Carbon::parse($this->date);
		return $date->format('M Y');
	}

	public function setDaystoconsumeAttribute($value)
	{
		$daystoconsume = isset($this->attributes['daystoconsume']) ? $this->attributes['daystoconsume'] : null;

		if($daystoconsume == '' || $daystoconsume == null):

			if(isset($this->attributes['received_quantity']) && $this->attributes['received_quantity'] > 0):
				$daystoconsume = 'Not Applicable';
			else:
				$daystoconsume = 90;
			endif;

		endif;

		$this->attributes['daystoconsume'] = $daystoconsume;
	}

	public function getReferenceInformationAttribute()
	{
		$details = '';

		/**
		 * check if the reference has content
		 * adds the reference to the details
		 */
		if($this->reference != '' && $this->reference != null) $details = $details . $this->reference;

		/**
		 * check if the receipt equals the reference
		 * check if the receipt has value
		 * add the receipt to details
		 */
		if($this->receipt != '' && $this->receipt != null && $this->receipt != $this->reference) $details = $details . ' - ' . $this->receipt;

		return $details;
	}

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
	 * [stockcards description]
	 * @return [type] [description]
	 */
    public function rsmi()
    {
        return $this->belongsToMany('App\RSMI', 'rsmi_stockcard', 'stockcard_id', 'rsmi_id')
                ->withPivot('ledgercard_id', 'unitcost', 'uacs_code')
                ->withTimestamps();
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
	public function setBalance($balance = null)
	{
		$received_quantity = isset($this->received_quantity) ? $this->received_quantity : 0;
		$issued_quantity = isset($this->issued_quantity) ? $this->issued_quantity : 0;
		$this->balance_quantity = 0;

		$stockcard = StockCard::findByStockNumber($this->stocknumber)
								->orderBy('id','desc')
								->orderBy('created_at','desc')
								->orderBy('date','desc')
								->first();

		$this->balance_quantity = (isset($stockcard->balance_quantity) ? $stockcard->balance_quantity : 0) + ( $received_quantity - $issued_quantity ) ;

		if($balance != null)
		{
			$this->balance_quantity = $balance;
		}
	}

	/*
	*
	*	Call this function when receiving an item
	*
	*/
	public function receive()
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
		 * finds the purchase order in the database
		 * create new if not found
		 */
		if(isset($this->reference) && $this->reference != null)
		{
			$purchaseorder = PurchaseOrder::firstOrCreate([
				'number' => $this->reference
			], [
				'date_received' => Carbon\Carbon::parse($this->date),
				'supplier_id' => (count($supplier) > 0 && isset($supplier->id)) ? $supplier->id : null
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
					$fundcluster->purchaseorders()->syncWithoutDetaching($purchaseorder->id);
				}
			}

			$supply_info = $purchaseorder->supplies()->find($supply->id);

			if(count($supply_info) > 0)
			{

				$supply_info->pivot->ordered_quantity = (isset($supply_info->pivot->ordered_quantity) ? $supply_info->pivot->ordered_quantity : 0 ) + $this->received_quantity;
				$supply_info->pivot->remaining_quantity = (isset($supply_info->pivot->remaining_quantity) ? $supply_info->pivot->remaining_quantity : 0 ) + $this->received_quantity;
				$supply_info->pivot->received_quantity = (isset($supply_info->pivot->received_quantity) ? $supply_info->pivot->received_quantity : 0 ) + $this->received_quantity;

				$supply_info->pivot->save();

			} else {

				$purchaseorder->supplies()->attach([
					$supply->id => [
						'ordered_quantity' =>  $this->received_quantity,
						'remaining_quantity' => $this->received_quantity,
						'received_quantity' =>  $this->received_quantity,
					]
				]);

			}

		}

		unset($supply_info);

		/**
		 * finds the receipt in the database
		 * create new if not found
		 */
		if(isset($this->receipt) && $this->receipt != null)
		{

			$receipt = Receipt::firstOrCreate([
				'number' => $this->receipt
			], [
				'purchaseorder_id' => (count($purchaseorder) > 0 && isset($purchaseorder->id)) ? $purchaseorder->id : null,
				'date_delivered' => isset($this->dr_date) ? Carbon\Carbon::parse($this->dr_date) : Carbon\Carbon::parse($this->date),
				'received_by' => $fullname,
				'supplier_id' => (count($supplier) > 0 && isset($supplier->id)) ? $supplier->id : null,
				'invoice' => (isset($this->invoice)) ? $this->invoice : null,
				'invoice_date' => (isset($this->invoice_date)) ? $this->invoice_date : null
			]);

			$supply_info = $receipt->supplies()->find($supply->id);

			if(count($supply_info) > 0)
			{

				$supply_info->pivot->remaining_quantity = (isset($supply_info->pivot->remaining_quantity) ? $supply_info->pivot->remaining_quantity : 0 ) + $this->received_quantity;

				$supply_info->pivot->quantity = (isset($supply_info->pivot->quantity) ? $supply_info->pivot->quantity : 0 ) + $this->quantity;

				$supply_info->pivot->save();

			} else {

				$receipt->supplies()->attach([
					$supply->id => [
						'remaining_quantity' => $this->received_quantity,
						'quantity' =>  $this->received_quantity,
					]
				]);

			}

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
		$issued = $this->issued_quantity;

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
			$supply->purchaseorders->each(function($item, $value) use ($supply) 
			{

				/**
				 * if the supply has issued quantity
				 * perform the functions below
				 */
				if($this->issued_quantity > 0)
				{

					/**
					 * if the remaining quantity of an item is greater than the issued quantity
					 * reduce the remaining quantity and set the issued balance to zero(0)
					 */
					if($item->pivot->remaining_quantity >= $this->issued_quantity)
					{
						$item->pivot->remaining_quantity = $item->pivot->remaining_quantity - $this->issued_quantity;
						$this->issued_quantity = 0;
					}

					/**
					 * if the remaining quantity is less than the issued quantity
					 * set the remaining quantity as zero(0)
					 * set the issued balance to zero(0)
					 */
					else
					{
						$this->issued_quantity = $this->issued_quantity - $item->pivot->remaining_quantity;
						$item->pivot->remaining_quantity = 0;
					}

					$item->pivot->save();
				}
			});


			/**
			 * [$this->issued_quantity description]
			 * reassign the backup to issued quantity column
			 * @var [type]
			 */
			$this->issued_quantity = $issued;
			$this->setBalance();
			$this->save();
		}

	}

	public static function computeDaysToConsume($stocknumber)
	{

		/**
		 * [$range description]
		 * this will contain all the range 
		 * for each days to consume
		 * @var array
		 */
		$range = [];
		$prev = null;

		/**
		 * [$constant description]
		 * default value for days to consume
		 * if no days to consume found
		 * return this value
		 * @var integer
		 */
		$constant = 90;

		/**
		 * [$stockcard description]
		 * get the range of each date
		 * @var [type]
		 */
		$stockcard = StockCard::findByStockNumber($stocknumber)->filterByIssued()->orderBy('date', 'desc')->get();

		/**
		 * loops each record and returns the 
		 * range in each record
		 */
		foreach($stockcard as $stock):
			if($prev):
				array_push($range, Carbon\Carbon::parse($stock->date)->diffInDays($prev) );

			/**
			 * returns the parsed date 
			 * this applies to only one record
			 * the very  first record in the list
			 */
			else:
				$prev = Carbon\Carbon::parse($stock->date);
			endif;
		endforeach;

		/**
		 * using frequency and averaging
		 * @var [type]
		 */
		if(count($range) <= 1 ):
			/**
			 * return the constant value 
			 * if the record is less than or equal to one(1)
			 */
			return $constant;
		else:
			/**
			 * return the average of all the values
			 * if the record has more than one(1) content
			 */
			 return	intval(collect($range)->avg());
		endif;
	}

	/**
	 * use insert many command in mysql
	 * use db transaction
	 * @param  [type] $array [description]
	 * @return [type]        [description]
	 */
	public function receiveMany($array)
	{
		//not yet used
	}

	/**
	 * compute balance of each record based on the 
	 * stocknumber given by the user. call this function
	 * when you want to sychronize the balance of record
	 * of certain stock
	 * @param  [type] $stocknumber [description]
	 * @return [type]              [description]
	 */
	public function syncBalance($stocknumber)
	{
		/**
		 * fetch the stocks by the given stocknumber
		 */
		$stockcards = StockCard::findByStockNumber($stocknumber)
						->orderBy('id','asc')
						->orderBy('created_at','asc')
						->orderBy('date','asc')
						->get();

		/**
		 * loops through each record
		 * save each in the database
		 */
		$balance_quantity = 0;
		foreach($stockcards as $stockcard)
		{
			$received_quantity = $stockcard->received_quantity;
			$issued_quantity = $stockcard->issued_quantity;
			$stockcard->stocknumber = $stockcard->supply->stocknumber;
			$balance_quantity = $stockcard->balance_quantity = $balance_quantity + ( $received_quantity - $issued_quantity ) ;
			$stockcard->save();
		}
	}

	/**
	 * fetch each record of stocknumber
	 * assign to references the record fetched
	 * @param  [type] $stocknumber [description]
	 * @return [type]              [description]
	 */
	public function syncReference($stocknumber)
	{
		/**
		 * fetch the stocks by the given stocknumber
		 */
		$stockcards = StockCard::findByStockNumber($stocknumber)
						->orderBy('id','asc')
						->orderBy('created_at','asc')
						->orderBy('date','asc')
						->get();

		$supply = Supply::findByStockNumber($stocknumber);

		/**
		 * loops through each record
		 * save each in the database
		 */
		$purchaseorders = PurchaseOrder::whereIn('number', $stockcards->pluck('reference') )->get();

		/**
		 * loops through each record and initialize the values
		 */
		foreach($purchaseorders as $purchaseorder)
		{
			$purchaseorder->supplies()->updateExistingPivot( $supply->id, [
				'received_quantity' => 0,
				'remaining_quantity' => 0
			]);

		}

		/**
		 * itirate through each stockcards and add the values
		 */
		foreach($stockcards as $stockcard)
		{

			$purchaseorder = PurchaseOrder::findByNumber($stockcard->reference)->first()->first();
			http_response_code(500);
			// dd($purchaseorder);
			$supplies = $purchaseorder->supplies()->where('supply_id', '=', $supply->id)->first();
			$received = $supplies->pivot->received_quantity + $stockcard->received_quantity;	
			$remaining = $supplies->pivot->received_quantity + ($stockcard->received_quantity - $stockcard->issued_quantity);

			$purchaseorder->supplies()->updateExistingPivot( $supply->id, [
				'received_quantity' => $received,
				'remaining_quantity' => $remaining
			]);		
		}
	}
}
