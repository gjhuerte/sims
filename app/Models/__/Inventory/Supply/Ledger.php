<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
use Auth;
use DB;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\UserResolver;

class LedgerCard extends Model implements Auditable, UserResolver
{
    use \OwenIt\Auditing\Auditable;

	protected $auditInclude = [
		'date',
		'stocknumber',
		'reference',
		'receipt_quantity',
		'receipt_unitcost',
		'issue_quantity',
		'issue_unitcost',
		'daystoconsume',
	];

	/**
     * {@inheritdoc}
     */
    public static function resolveId()
    {
        return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    }

	protected $table = 'ledgercards';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = [
		'user_id',
		'date',
		'stocknumber',
		'reference',
		'receipt_quantity',
		'receipt_unitcost',
		'issue_quantity',
		'issue_unitcost',
		'daystoconsume',
	];


	public static $receiptRules = array(
		'Date' => 'required',
		'Stock Number' => 'required',
		'Receipt Quantity' => 'required',
		'Receipt Unit Cost' => 'required',
		'Days To Consume' => 'max:100'
	);

	public static $issueRules = array(
		'Date' => 'required',
		'Stock Number' => 'required',
		'Requisition and Issue Slip' => 'required',
		'Issue Quantity' => 'required',
		'Issue Unit Cost' => 'required',
		'Days To Consume' => 'max:100'
	);

	/**
	 * custom columns
	 * columns used by processes
	 * do not touch!
	 * may destroy system
	 * @var null
	 */
	public $fundcluster = null;
	public $stocknumber = null;
	public $organization = null;
	public $invoice = "";

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

	/**
	 * [setBalance description]
	 * update the current records balance
	 */
	public function setBalance()
	{
		$ledgercard = LedgerCard::findByStockNumber($this->stocknumber)
								->orderBy('date','desc')
								->orderBy('created_at','desc')
								->orderBy('id','desc')
								->first();

		$balance = isset($ledgercard->balance_quantity) ? $ledgercard->balance_quantity : 0;
		$issued = isset($this->issued_quantity) ? $this->issued_quantity  : 0 ;
		$received = isset($this->received_quantity) ? $this->received_quantity : 0;

		$this->balance_quantity = 0;
		$this->balance_quantity = $balance + ($received - $issued);
	}

	public function scopeReference($query, $reference)
	{
		return $query->where('reference','=',$reference);
	}

	public function scopeFindByStockNumber($query, $stocknumber)
	{
		return $query->whereHas('supply', function($query) use($stocknumber) {
			$query->where('stocknumber', '=', $stocknumber);
		});
	}

	public function supply()
	{
		return $this->belongsTo('App\Supply', 'supply_id', 'id');
	}

	public function scopeFindBySupplyId($query,$stocknumber)
	{
		return $query->where('supply_id','=',$stocknumber);
	}

	public function scopeFilterByMonth($query,$month)
	{
		$month = Carbon\Carbon::parse($month);
		return $query->whereBetween('date',[
				$month->startOfMonth()->toDateString(),
				$month->endOfMonth()->toDateString()
			]);
	}

	public function scopeFilterByIssued($query)
	{
		return $query->where('issued_quantity','>',0);
	}

	/**
	 * is this safe to destroy??
	 * warn me in the future
	 * i think i didnt use it
	 * @param  [type] $query    [description]
	 * @param  [type] $quantity [description]
	 * @return [type]           [description]
	 */
	public function scopeQuantity($query, $quantity)
	{
		return $query->where('issued_quantity','=',$quantity);
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
		$purchaseorder = null;
		$supplier = null;

		$supply = Supply::findByStockNumber($this->stocknumber);
		$this->supply_id = $supply->id;

		if(isset($this->organization))
		{
			$supplier = Supplier::firstOrCreate([ 'name' => $this->organization ]);
		}

		if(isset($this->reference) && $this->reference != null && strpos($this->reference,'justment') != true)
		{
			$purchaseorder = PurchaseOrder::firstOrCreate([
				'number' => $this->reference
			], [
				'date_received' => Carbon\Carbon::parse($this->date),
				'supplier_id' => isset($supplier->id) ? $supplier->id : null
			]);


			/**
			 * uncomment this part
			 * if the ledger card can increment the supply content
			 */
			$supply_info = $purchaseorder->supplies()->find($supply->id);

			if(count($supply_info) > 0)
			{

				// $supply_info->pivot->ordered_quantity = (isset($supply_info->pivot->ordered_quantity) ? $supply_info->pivot->ordered_quantity : 0 ) + $this->received_quantity;

				// $supply_info->pivot->remaining_quantity = (isset($supply_info->pivot->remaining_quantity) ? $supply_info->pivot->remaining_quantity : 0 ) + $this->received_quantity;

				// $supply_info->pivot->received_quantity = (isset($supply_info->pivot->received_quantity) ? $supply_info->pivot->received_quantity : 0 ) + $this->received_quantity;

				$supply_info->pivot->unitcost = $this->received_unitcost;

				$supply_info->pivot->save();

			} else {

				// $purchaseorder->supplies()->attach([
				// 	$supply->id => [
				// 		'ordered_quantity' =>  $this->received_quantity,
				// 		'remaining_quantity' => $this->received_quantity,
				// 		'received_quantity' =>  $this->received_quantity,
				// 	]
				// ]);

			}

			if(isset($this->fundcluster) &&  count(explode(",",$this->fundcluster)) > 0)
			{
				$purchaseorder->fundclusters()->detach();
				foreach(explode(",",$this->fundcluster) as $fundcluster)
				{
					$fundcluster = FundCluster::firstOrCreate( [ 'code' => $fundcluster ] );
					$fundcluster->purchaseorders()->attach($purchaseorder->id);

				}
			}

		}

		unset($supply_info);

		if(isset($this->receipt) && $this->receipt != null)
		{

			$receipt = Receipt::firstOrCreate([
				'number' => $this->receipt
			],[
				'purchaseorder_id' => (count($purchaseorder) > 0 && isset($purchaseorder->id)) ? $purchaseorder->id : null,
				'date_delivered' => Carbon\Carbon::parse($this->date),
				'received_by' => $fullname,
				'supplier_id' => isset($supplier->id) ? $supplier->id : null 

			]);

			$receipt->invoice = isset($this->invoice) ? $this->invoice : null;

			$receipt->save();

			$supply_info = $receipt->supplies()->find($supply->id);

			if(isset($supply_info) && count($supply_info) > 0)
			{

				// $supply_info->pivot->received_quantity = (isset($supply_info->pivot->received_quantity) ? $supply_info->pivot->received_quantity : 0 ) + $this->received_quantity;

				// $supply_info->pivot->remaining_quantity = (isset($supply_info->pivot->remaining_quantity) ? $supply_info->pivot->remaining_quantity : 0 ) + $this->received_quantity;

				// $supply_info->pivot->unitcost = (isset($supply_info->pivot->unitcost) ? $supply_info->pivot->unitcost : 0 ) + $this->unitcost;

				$supply_info->pivot->unitcost = $this->received_unitcost;

				$supply_info->pivot->save();

			} else {

				// $supply_info->supplies()->attach([
				// 	$supply->id => [
				// 		'quantity' =>  $this->received_quantity,
				// 		'remaining_quantity' => $this->received_quantity,
				// 		'unitcost' => $this->received_unitcost
				// 	]
				// ]);

			}
		}


		$this->created_by = $fullname;
		$this->setBalance();
		$this->save();
	}

	/*
	*
	*	Call this function when receiving an item
	*
	*/
	public function issue()
	{
		$firstname = Auth::user()->firstname;
		$middlename =  Auth::user()->middlename;
		$lastname = Auth::user()->lastname;
		$fullname =  $firstname . " " . $middlename . " " . $lastname;

		/**
		 * [$issued description]
		 * backup of the issued quantity
		 * @var [type]
		 */
		$issued = $this->issued_quantity;

		$supply = Supply::findByStockNumber($this->stocknumber);
		$this->supply_id = $supply->id;

		$supplies = $supply->receipts->each(function($item, $key) use($supply) {
			if($item->pivot->remaining_quantity <= 0) $supply->receipts->forget($key);
		});

		if(count($supplies) > 0)
		{

			/**
			 *	loops through each record
			 *	reduce the issued for each record
			 *	
			 */
			$supplies->each(function($item, $value) use ($supply) 
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
		}


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
