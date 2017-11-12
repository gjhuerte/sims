<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
use Auth;
use DB;
class StockCard extends Model{

	protected $table = 'stockcards';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = [ 'date','stocknumber','reference','receipt', 'received','issued','organization','daystoconsume'];

	// set of rules when receiving an item
	public static $receiptRules = array(
		'Date' => 'required',
		'Stock Number' => 'required',
		'Purchase Order' => 'exists:purchaseorders,number',
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

	

    
        // DB::unprepared('

        //     CREATE TRIGGER `accept_supply_trg` AFTER 
        //     INSERT ON `supplytransaction`
        //     FOR EACH ROW 
        //         UPDATE purchaseorder_supply
        //         SET receivedquantity = receivedquantity + new.receiptquantity,reference = concat(reference,",",new.reference), date = concat(date,",",new.date),updated_at = now()
        //         WHERE supplyitem = new.stocknumber AND purchaseorderno = new.purchaseorderno AND new.issuequantity = 0 OR NULL;
        //     ');
        // DB::unprepared('

        //     CREATE DEFINER=`root`@`localhost` PROCEDURE `bal_update`
        //     (IN `_user_id` VARCHAR(100), IN `_date` DATE, IN `_stocknumber` VARCHAR(100), IN `_purchaseorderno` VARCHAR(100), IN `_reference` VARCHAR(100), IN `_office` VARCHAR(100), IN `_receipt` INT(11), IN `_issue` INT(11), IN `_daystoconsume` VARCHAR(100))
        //     NO SQL
        //         BEGIN

        //             SET @endbalance = (
        //                     SELECT balancequantity 
        //                     FROM supplytransaction 
        //                     WHERE date <= _date AND stocknumber = _stocknumber
        //                     ORDER BY date DESC , id DESC
        //                     LIMIT 1
        //                 );
                        
        //             IF @endbalance IS null THEN
        //                 SET @endbalance = 0; 
        //             END IF;
                        
        //             SET @balance = @endbalance +_receipt - _issue;

        //             INSERT INTO supplytransaction VALUES(null,_user_id,_date,_stocknumber,_purchaseorderno,_reference,_office,_receipt,_issue,@balance,_daystoconsume,NOW(),NOW());


        //             UPDATE supplytransaction
        //                 SET balancequantity = balancequantity + _receipt - _issue ,updated_at = now()
        //                 WHERE stocknumber = _stocknumber AND date > _date;

        //         END'
        //         );
        // DB::unprepared('
        //             CREATE DEFINER=`root`@`localhost` PROCEDURE `ledger_update`(
        //               IN `_user_id` VARCHAR(100), 
        //               IN `_date` DATE, 
        //               IN `_stocknumber` VARCHAR(100), 
        //               IN `_reference` VARCHAR(100), 
        //               IN `_receipt` INT(11), 
        //               IN `_receiptprice` DECIMAL, 
        //               IN `_issue` INT(11), 
        //               IN `_issueprice` DECIMAL, 
        //               IN `_daystoconsume` VARCHAR(100))
        //             NO SQL
        //             BEGIN

        //             SET @endbalance = (
        //                     SELECT balancequantity 
        //                     FROM supplyledger 
        //                     WHERE date <= _date AND stocknumber = _stocknumber
        //                     ORDER BY date DESC , id DESC
        //                     LIMIT 1
        //                 );
        //             /* last receiptprice inserted*/
        //             SET @endreceiptprice = (
        //                     SELECT receiptunitprice 
        //                     FROM supplyledger 
        //                     WHERE date <= _date AND stocknumber = _stocknumber
        //                     ORDER BY date DESC , id DESC
        //                     LIMIT 1
        //                 );
        //             /*for issue*/
        //             IF _receiptprice IS NULL OR _receiptprice = 0 THEN
        //             SET _receiptprice = _issueprice;
        //             END IF;

        //             /*for receipt*/
        //             IF _issueprice IS NULL OR _issueprice = 0 THEN
        //             SET _issueprice = _receiptprice;
        //             END IF;

        //             /* last issueprice inserted*/
        //             SET @endissueprice = (
        //                     SELECT issueunitprice 
        //                     FROM supplyledger 
        //                     WHERE date <= _date AND stocknumber = _stocknumber
        //                     ORDER BY date DESC , id DESC
        //                     LIMIT 1
        //                 );    
        //             IF @endbalance IS null THEN
        //                 SET @endbalance = 0; 
        //             END IF;
                  
        //             SET @balance = @endbalance +_receipt - _issue;

        //             INSERT INTO supplyledger VALUES(
        //                 null,
        //                 _user_id,
        //                 _date,
        //                 _stocknumber,
        //                 _reference,
        //                 _receipt,
        //                 _receiptprice,
        //                 _issue,
        //                 _issueprice,
        //                 @balance,
        //                 _daystoconsume,
        //                 NOW(),
        //                 NOW()
        //                                             );

        //             UPDATE supplytransaction
        //                 SET balancequantity = balancequantity + _receipt - _issue ,updated_at = now()
        //                 WHERE stocknumber = _stocknumber AND date > _date;

        //         END
        //                ');

}
