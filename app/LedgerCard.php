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
		'Purchase Order' => 'required|exists:purchaseorders,number',
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
								->orderBy('created_at','desc')
								->first();

		if(!isset($this->receivedquantity))
		{
			$this->receivedquantity = 0;
		}

		if(!isset($this->issuedquantity))
		{
			$this->issuedquantity = 0;
		}

		if( count($ledgercard) > 0 )
		{
			$this->balancequantity = $ledgercard->balancequantity + ( $this->receivedquantity - $this->issuedquantity );
		}
		else
		{
			$this->balancequantity = $this->receivedquantity - $this->issuedquantity;
		}
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

		$receipt = Receipt::where('number','=',$this->receipt)->first();

		if( count($receipt) <= 0 )
		{

			$receipt = new Receipt;
			$receipt->reference = $this->reference;
			$receipt->number = $this->receipt;
			$receipt->date_delivered = Carbon\Carbon::parse($this->date);
			$receipt->received_by = $fullname;
			$receipt->supplier_name = $this->organization;
		}

		if( isset($this->invoice) && $this->invoice != null )
		{
			$receipt->invoice = $this->invoice;
		}

		$receipt->save();

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
			$supply->quantity = $supply->remaining_quantity = $this->receivedquantity;
			$supply->cost = $this->receivedunitprice;
		}

		$supply->save();

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
		$this->setBalance();
		$this->save();
	}

}
