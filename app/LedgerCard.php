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
		'receiptquantity',
		'receiptunitprice',
		'issuequantity',
		'issueunitprice',
		'daystoconsume',
	];


	public static $receiptRules = array(
		'Date' => 'required',
		'Stock Number' => 'required',
		'Purchase Order' => 'nullable|exists:purchaseorders,number',
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

	// public function getDateAttribute($value)
	// {
	// 	return Carbon\Carbon::parse($value)->format('jS \\of F Y');
	// }

	public function setBalance()
	{
		$ledgercard = LedgerCard::where('stocknumber','=',$this->stocknumber)
								->orderBy('date','desc')
								->orderBy('created_at','desc')
								->orderBy('id','desc')
								->first();

		if(!isset($this->receivedquantity))
		{
			$this->receivedquantity = 0;
		}

		if(!isset($this->issuedquantity))
		{
			$this->issuedquantity = 0;
		}

		$this->balancequantity = ( isset($ledgercard->balance) ? $ledgercard->balance : 0 ) + $this->receivedquantity - $this->issuedquantity;
	}

	public function scopeQuantity($query,$quantity)
	{
		return $query->where('issuequantity','=',$quantity);
	}

	public function scopeReference($query,$reference)
	{
		return $query->where('reference','=',$reference);
	}

	public function scopeFindByStockNumber($query,$stocknumber)
	{
		return $query->where('stocknumber','=',$stocknumber);
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
		return $query->where('issuedquantity','>',0);
	}

	public $invoice = "";

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

		$receipt = Receipt::firstOrCreate([
			'number' => $this->receipt,
			'reference' => $this->reference
		],[
			'date_delivered' => Carbon\Carbon::parse($this->date),
			'received_by' => $fullname,
			'supplier_name' => $this->organization,
			'invoice' => isset($this->invoice) ? $this->invoice : null
		]);

		$supply = ReceiptSupply::updateOrCreate([
			'receipt_number' => $receipt->number,
			'stocknumber' => $this->stocknumber,
		],[
			'cost' => $this->receivedunitprice
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

		$receipt = ReceiptSupply::where('stocknumber','=',$this->stocknumber)
								->where('remaining_quantity','>',0)
								->get();


		foreach($receipt as $receipt)
		{
			if($this->issuedquantity > 0)
			{
				if($receipt->remaining_quantity >= $this->issuedquantity)
				{
					$receipt->remaining_quantity = $receipt->remaining_quantity - $this->issuedquantity;
					$this->issuedquantity = 0;
				}
				else
				{
					$this->issuedquantity = $this->issuedquantity - $receipt->remaining_quantity;
					$receipt->remaining_quantity = 0;
				}

				$receipt->save();
			}
			else
			{
				break;
			}
		}

		$this->issuedquantity = $issued;
		$this->created_by = $fullname;
		$this->setBalance();
		$this->save();
	}

}
