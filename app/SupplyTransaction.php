<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
use Auth;
use DB;
class SupplyTransaction extends Model{

	protected $table = 'supplytransaction';

	public $timestamps = true;
	protected $fillable = ['user_id','date','stocknumber','purchaseorderno','reference','receiptquantity','issuequantity','office','daystoconsume'];
	protected $primaryKey = 'id';

	// set of rules when receiving an item
	public static $receiptRules = array(
		'Date' => 'required',
		'Stock Number' => 'required',
		'Purchase Order' => 'exists:purchaseorder,purchaseorderno',
		'Delivery Receipt' => '',
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
		'Issue Quantity' => 'required|integer',
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

	var $date;
	var $stocknumber = "";
	var $purchaseorderno = null;
	var $reference = null;
	var $office = "N/A";
	var $quantity = 0;
	var $daystoconsume = "";

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
		$username =  $firstname . " " . $middlename . " " . $lastname;
		$date = Carbon\Carbon::parse($this->date);

		DB::statement("
			call bal_update(
				'$username',
				'$date',
				'$this->stocknumber',
				'$this->purchaseorderno',
				'$this->reference',
				'$this->office',
				'$this->quantity',
				'0',
				'$this->daystoconsume'
			)
		");


		$purchaseorder = PurchaseOrderSupply::where('purchaseorderno','=',$this->purchaseorderno)
													->where('supplyitem','=',$this->stocknumber)
													->first();


		// $purchaseorder->remainingquantity = $purchaseorder->remainingquantity + $this->quantity;
		// $purchaseorder->save();
	}


	/*
	*
	*	Call this function when releasing
	*
	*/

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
		$username =  $firstname . " " . $middlename . " " . $lastname;

		$date = Carbon\Carbon::parse($this->date);

		$purchaseordersupply = PurchaseOrderSupply::where('supplyitem','=',$this->stocknumber)
										->orderBy('created_at','asc')
										->where('remainingquantity','>','0')
										->get();

		foreach($purchaseordersupply as $po)
		{
			if($this->quantity > 0)
			{
				DB::statement("
					call bal_update(
						'$username',
						'$date',
						'$this->stocknumber',
						'$po->purchaseorderno',
						'$this->reference',
						'$this->office',
						'0',
						'$this->quantity',
						'$this->daystoconsume'
					)
				");

				if($this->quantity >= $po->remainingquantity)
				{
					$remaining_quantity = $this->quantity - $po->remainingquantity;
					$this->quantity = $remaining_quantity;
					$po->issuedquantity = $remaining_quantity;
					$po->remainingquantity = 0;
					$po->save();
				}
				else
				{
					$remaining_quantity = $po->remainingquantity - $this->quantity;
					$this->quantity = 0;
					$po->remainingquantity = $remaining_quantity;
					$po->issuedquantity = $po->issuedquantity + $remaining_quantity;
					$po->save();
				}
			}
		}
	}

}
