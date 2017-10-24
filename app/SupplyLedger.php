<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
use Auth;
use DB;
class SupplyLedger extends Model{

	protected $table = 'supplyledger';

	public $timestamps = true;
	protected $fillable = ['user_id','date','stocknumber','reference','receiptquantity','receiptunitprice','issuequantity','issueunitprice','daystoconsume','user_id'];

	protected $primaryKey = 'id';

	public static $receiptRules = array(
	'Date' => 'required',
	'Stock Number' => 'required',
	'Purchase Order' => 'required|exists:purchaseorder,purchaseorderno',
	'Receipt Quantity' => 'required',
	'Receipt Unit Price' => 'required',
	'Days To Consume' => 'max:100'
	);

	public static $issueRules = array(
	'Date' => 'required',
	'Stock Number' => 'required',
	'Requisition and Issue Slip' => 'required',
	'Issue Quantity' => 'required',
	'Issue Unit Price' => 'required',
	'Days To Consume' => 'max:100'
	);

	public function getDateAttribute($value)
	{
		return Carbon\Carbon::parse($value)->format('jS \\of F Y');
	}

	/*
	*
	*	Call this function when receiving an item
	*
	*/
	public static function receipt($date,$stocknumber,$reference,$receiptquantity,$receiptunitprice,$daystoconsume)
	{

		$username = Auth::user()->firstname . " " . Auth::user()->middlename . " " . Auth::user()->lastname;
		$date = Carbon\Carbon::parse($date);
		DB::statement("
			call ledger_update(
				'$username',
				'$date',
				'$stocknumber',
				'$reference',
				'$receiptquantity',
				'$receiptunitprice',
				'0',
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
	public static function issue($date,$stocknumber,$reference,$issuequantity,$issueunitprice,$daystoconsume)
	{
		$username = Auth::user()->firstname . " " . Auth::user()->middlename . " " . Auth::user()->lastname;
		$date = Carbon\Carbon::parse($date);
		DB::statement("
			call ledger_update(
				'$username',
				'$date',
				'$stocknumber',
				'$reference',
				'0',
				'0',
				'$issuequantity',
				'$issueunitprice',
				'$daystoconsume'
			)
		");
	}

	public function scopeQuantity($query,$quantity)
	{
		return $query->where('issuequantity','=',$quantity);
	}

	public function scopeReference($query,$reference)
	{
		return $query->where('reference','=',$reference);
	}

	public function scopeStockNumber($query,$stocknumber)
	{
		return $query->where('stocknumber','=',$stocknumber);
	}

	public function scopeMonth($query,$month)
	{
		$month = Carbon\Carbon::parse($month);
		return $query->whereBetween('date',array(
				$month->startOfMonth()->toDateString(),
				$month->endOfMonth()->toDateString()
			));
	}

	/*
	*
	*  Check if row already existed in the table
	*
	*/
	public static function isExistingRecord($reference,$stocknumber,$quantity,$month)
	{
		try{
			$supplyledger = SupplyLedger::quantity($quantity)
								->reference($reference)
								->stockNumber($stocknumber)
								->month($month)
								->get();

			if($supplyledger->isNotEmpty()) return 'duplicate';
			return 'success';
		} catch (Exception $e) {
			return 'error';
		}
	}

	public static function getRemainingBalance($id)
	{
		$supply = Supply::find($id);
		$balance = SupplyLedger::stockNumber($supply->stocknumber);
		$balance = $balance->sum('receiptquantity')-$balance->sum('issuequantity');
		return $balance;
	}

	public static function createReceiptRecord($date,$reference,$stocknumber,$issuequantity,$daystoconsume)
	{
		try{

			$validator = Validator::make([
				'Date' => $date,
				'Stock Number' => $stocknumber,
				'Requisition and Issue Slip' => $reference,
				'Issue Quantity' => $issuequantity,
				'Days To Consume' => $daystoconsume
			],SupplyLedger::$issueRules);

			if($validator->fails()) return 'error';
			SupplyLedger::issue($date,$stocknumber,$reference,$issuequantity,$daystoconsume);

			return 'success';
		} catch (Exception $e) {
			return 'error';
		}
	}

}
