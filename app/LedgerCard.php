<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
use Auth;
use DB;
class LedgerCard extends Model{

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

		if(!isset($this->received_quantity))
		{
			$this->received_quantity = 0;
		}

		if(!isset($this->issued_quantity))
		{
			$this->issued_quantity = 0;
		}

		$this->balance_quantity = 0;
		$this->balance_quantity = ( isset($ledgercard->balance_quantity) ? $ledgercard->balance_quantity : 0 ) + $this->received_quantity - $this->issued_quantity;
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
	public function receipt()
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

		if(isset($this->reference) && $this->reference != null)
		{
			$purchaseorder = PurchaseOrder::firstOrCreate([
				'number' => $this->reference
			], [
				'date_received' => Carbon\Carbon::parse($this->date),
				'supplier_id' => isset($supplier->id) ? $supplier->id : null
			]);

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

		$receipt = Receipt::firstOrCreate([
			'number' => $this->receipt
		],[
			'purchaseorder_id' => isset($purchaseorder->id) ? $purchaseorder->id : null,
			'date_delivered' => Carbon\Carbon::parse($this->date),
			'received_by' => $fullname,
			'supplier_id' => isset($supplier->id) ? $supplier->id : null,
			'invoice' => isset($this->invoice) ? $this->invoice : null
		]);

		$receipt->supplies()->attach([
			$supply->id => [
				'quantity' => $this->received_quantity,
				'remaining_quantity' => $this->received_quantity,
				'unitcost' => $this->received_unitcost
			]
		]);


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
		$issued = $this->issuedquantity;

		$supply = Supply::findByStockNumber($this->stocknumber);
		$this->supply_id = $supply->id;

		$supplies = $supply->receipts->each(function($item, $key) use($supply) {
			if($item->pivot->remaining_quantity <= 0) $supply->receipts->forget($key);
		});

		if(count($supplies) <= 0)
		{
			$this->setBalance();
			$this->save();
		}
		else
		{

			/**
			 *	loops through each record
			 *	reduce the quantity of receipt for each record
			 *	
			 */
			$supply->receipts->each(function($item, $value) use ($supply) {
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

		$this->save();
	}

}
