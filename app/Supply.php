<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
use DB;

class Supply extends Model{

	protected $table = 'supplies';
	protected $primaryKey = 'id';
	protected $fillable = ['stocknumber','details','unit','reorderpoint'];
	public $incrementing = false;
	public $timestamps = true;

	public static $rules = array(
		'Stock Number' => 'required|unique:supplies,stocknumber',
		'Details' => 'required|unique:supplies,details',
		'Unit' => 'required',
		'Reorder Point' => 'required|integer'
	);

	public function legitimateStockNumber(){
		return [
			'Stock Number' => 'required|exists:supplies,stocknumber'
		];
	}

	public function updateRules()
	{
		$stocknumber = $this->stocknumber;
		return array(
				'Stock Number' => 'required|unique:supplies,stocknumber,'.$stocknumber.',stocknumber',
				'Details' => 'required',
				'Unit' => 'required',
				'Reorder Point' => 'integer'
		);
	}

	protected $appends = [
		'temp_balance',
		'stock_balance',
		'ledger_balance',
		'unitcost',
		'unit_name'
	];

	public function getUnitNameAttribute($value)
	{
		return (isset($this->unit) && count($this->unit) > 0) ?  $this->unit->name : null;
	}

	public function getUnitCostAttribute($value)
	{
		$cost = ReceiptSupply::findByStockNumber($this->stocknumber)
								->where('remaining_quantity','>',0)
								->whereNotNull('unitcost')
								->select('unitcost')
								->avg('unitcost');
		if(count($cost) > 0)
			return $cost;
		else
			return 0;
	}

	public function getTempBalanceAttribute($value)
	{

		$balance = StockCard::findBySupplyId($this->id)
						->orderBy('date','desc')
						->orderBy('created_at','desc')
						->orderBy('id','desc')
						->pluck('balance_quantity')
						->first();

		if(empty($balance) || $balance == null || $balance == '')
		{
			$balance = 0;
		}

		$temp_issued = 0 ;

		$temp_issued = DB::table('requests_supplies')
						->where('supply_id', '=', $this->id)
						->whereIn('request_id', Request::where('status', '=', 'approved')->pluck('id'))
						->sum('quantity_issued');

		$balance = $balance - $temp_issued;

		return $balance	;
	}

	public function getStockBalanceAttribute($value)
	{

		$balance = StockCard::findBySupplyId($this->id)
						->orderBy('date','desc')
						->orderBy('created_at','desc')
						->orderBy('id','desc')
						->pluck('balance_quantity')
						->first();

		if(empty($balance) || $balance == null || $balance == '')
		{
			$balance = 0;
		}

		return $balance	;
	}

	public function getLedgerBalanceAttribute($value)
	{
		$balance = LedgerCard::findBySupplyId($this->id)
						->orderBy('date','desc')
						->orderBy('created_at','desc')
						->orderBy('id','desc')
						->pluck('balance_quantity')
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

	public function scopeFindByCategoryName($query, $value)
	{
		return $query->whereHas('category', function($query) use ($value){
			$query->where('name', '=', $value);
		} );
	}

	public function scopeFindByCategoryId($query, $value)
	{
		return $query->where('category_id', '=', $value);
	}

	public function scopeStockNumber($query,$value)
	{
		return $query->where('stocknumber','=',$value);
	}

	public function stockcards()
	{
		return $this->hasMany('App\StockCard','supply_id');
	}

	public function ledgercards()
	{
		return $this->hasMany('App\LedgerCard','supply_id');
	}

	public function getUnitPriceAttribute($value)
	{
		return number_format($value,2,'.',',');
	}

	public function purchaseorders()
	{
		return $this->belongsToMany('App\PurchaseOrder','purchaseorders_supplies', 'supply_id','purchaseorder_id')
          ->withPivot('unitcost', 'received_quantity', 'ordered_quantity', 'remaining_quantity')
          ->withTimestamps();
	}

	public function receipts()
	{
		return $this->belongsToMany('App\Receipt','receipts_supplies','supply_id','receipt_id')
          ->withPivot('unitcost', 'quantity', 'remaining_quantity')
          ->withTimestamps();
	}

	public function requests()
	{
		return $this->belongsToMany('App\Request','requests_supplies','supply_id','request_id')
            ->withPivot('quantity_requested', 'quantity_issued', 'quantity_released', 'comments')
            ->withTimestamps();
	}

	public function category()
	{
		return $this->belongsTo('App\Category', 'category_id', 'id');
	}

	public function unit()
	{
		return $this->belongsTo('App\Unit', 'unit_id', 'id');
	}

}
