<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
use DB;

class Supply extends Model{

	protected $table = 'supplies';
	protected $fillable = ['stocknumber','entityname','details','unit','reorderpoint'];
	protected $primaryKey = 'stocknumber';
	public $incrementing = false;
	public $timestamps = true;
	public static $rules = array(
		'Stock Number' => 'required|unique:supplies,stocknumber',
		'Entity Name' => 'required',
		'Details' => 'required|unique:supplies,supplytype',
		'Unit' => 'required',
		'Reorder Point' => 'required|integer'
	);

	public static $updateRules = array(
		'Stock Number' => 'required',
		'Entity Name' => 'required',
		'Details' => 'required',
		'Unit' => 'required',
		'Reorder Point' => 'integer'
	);

	protected $appends = [
		'balance',
		'ledger_balance'
	];

	public function getBalanceAttribute($value)
	{
		$stocknumber = '';
		if(isset($this->stocknumber))
		{
			$stocknumber = $this->stocknumber;
		}

		$balance = StockCard::where('stocknumber','=',$stocknumber)
						->orderBy('created_at','desc')
						->pluck('balance')
						->first();

		if(empty($balance) || $balance == null || $balance == '')
		{
			$balance = 0;
		}
		
		return $balance	;
	}

	public function getLedgerBalanceAttribute($value)
	{
		$stocknumber = '';
		if(isset($this->stocknumber))
		{
			$stocknumber = $this->stocknumber;
		}

		$balance = LedgerCard::where('stocknumber','=',$stocknumber)
						->orderBy('created_at','desc')
						->pluck('balancequantity')
						->first();

		if(empty($balance) || $balance == null || $balance == '')
		{
			$balance = 0;
		}
		
		return $balance	;
	}

	public function scopeIssued($query)
	{
		return $query->where('issuedquantity','>',0);
	}

	public function scopeFindByStockNumber($query,$value)
	{
		return $query->where('stocknumber','=',$value)->first();
	}

	public function scopeStockNumber($query,$value)
	{
		return $query->where('stocknumber','=',$value);
	}

	public function stockcards()
	{
		return $this->hasMany('App\StockCards','stocknumber','stocknumber');
	}

	public function ledgercards()
	{
		return $this->hasMany('App\LedgerCards','stocknumber','stocknumber');
	}

	public function getUnitPriceAttribute($value)
	{
		return number_format($value,2,'.',',');
	}

	public function purchaseorder()
	{
		return $this->belongsToMany('App\PurchaseOrder','purchaseorders_supplies','stocknumber','id');
	}

}
