<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
class Supply extends Model{

	protected $table = 'supply';
	protected $fillable = ['stocknumber','entityname','supplytype','unit','reorderpoint'];
	protected $primaryKey = 'stocknumber';
	public $incrementing = false;
	public $timestamps = true;
	public static $rules = array(
	'Stock Number' => 'required|unique:supply,stocknumber',
	'Entity Name' => 'required',
	'Supply Type' => 'required|unique:supply,supplytype',
	'Unit' => 'required',
	'Reorder Point' => 'required|integer'
	);

	public static $updateRules = array(
	'Stock Number' => '',
	'Entity Name' => '',
	'Supply Type' => '',
	'Unit' => '',
	'Reorder Point' => 'integer'
	);

	protected $appends = [
		'balance'
	];

	public function getBalanceAttribute()
	{
		$stocknumber = '';
		if(isset($this->stocknumber))
		{
			$stocknumber = $this->stocknumber;
		}

		$balance = SupplyTransaction::where('stocknumber','=',$stocknumber)
						->orderBy('created_at','desc')
						->pluck('balancequantity')
						->first();

		if(empty($balance) || $balance == null || $balance == '')
		{
			$balance = 0;
		}

		return $balance	;
	}

	public function scopeStockNumber($query,$value)
	{
		return $query->where('stocknumber','=',$value);
	}

	public function supplytransaction()
	{
		return $this->hasMany('App\SupplyTransaction','stocknumber','stocknumber');
	}

	public function ledgerview()
	{
		return $this->hasMany('App\LedgerView','stocknumber','stocknumber');
	}

	public function getUnitPriceAttribute($value)
	{
		return number_format($value,2,'.',',');
	}

	public function purchaseorder()
	{
		return $this->belongsToMany('App\PurchaseOrder','purchaseorder_supply','supplyitem','purchaseorderno');
	}

	public static function getSupplyStockNumber($id)
	{
		$supply = Supply::find($id);
		return $supply->stocknumber;
	}

}
