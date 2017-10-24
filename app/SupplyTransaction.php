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
		'Purchase Order' => 'required|exists:purchaseorder,purchaseorderno',
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

	/*
	*
	*	Call this function when receiving an item
	*
	*/
	public static function receipt($date,$stocknumber,$purchaseorderno,$reference,$office,$receiptquantity,$daystoconsume)
	{

		$username = Auth::user()->firstname . " " . Auth::user()->middlename . " " . Auth::user()->lastname;
		$date = Carbon\Carbon::parse($date);
		DB::statement("
			call bal_update(
				'$username',
				'$date',
				'$stocknumber',
				'$purchaseorderno',
				'$reference',
				'$office',
				'$receiptquantity',
				'0',
				'$daystoconsume'
			)
		");
	}


	/*
	*
	*	Call this function when releasing
	*
	*/
	public static function issue($date,$stocknumber,$purchaseorderno,$reference,$office,$issuequantity,$daystoconsume)
	{
		if($purchaseorderno == null || $purchaseorderno == '' || !isset($purchaseorderno))
			$purchaseorderno = 'null';
		else
			$purchaseorderno = "'".$purchaseorderno."'";
		$username = Auth::user()->firstname . " " . Auth::user()->middlename . " " . Auth::user()->lastname;
		$date = Carbon\Carbon::parse($date);
		DB::statement("
			call bal_update(
				'$username',
				'$date',
				'$stocknumber',
				$purchaseorderno,
				'$reference',
				'$office',
				'0',
				'$issuequantity',
				'$daystoconsume'
			)
		");
	}

}
