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
		'Details' => 'required|unique:supplies,details',
		'Unit' => 'required',
		'Reorder Point' => 'required|integer'
	);

	public function updateRules()
	{
		$stocknumber = $this->stocknumber;
		return array(
				'Stock Number' => 'required|unique:supplies,stocknumber,'.$stocknumber.',stocknumber',
				'Entity Name' => 'required',
				'Details' => 'required',
				'Unit' => 'required',
				'Reorder Point' => 'integer'
		);
	} 

	protected $appends = [
		'balance',
		'ledger_balance',
		'fund_cluster'
	];

	public function getBalanceAttribute($value)
	{
		$stocknumber = '';
		if(isset($this->stocknumber))
		{
			$stocknumber = $this->stocknumber;
		}

		$balance = StockCard::where('stocknumber','=',$stocknumber)
						->orderBy('date','desc')
						->orderBy('created_at','desc')
						->orderBy('id','desc')
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
						->orderBy('date','desc')
						->orderBy('created_at','desc')
						->orderBy('id','desc')
						->pluck('balancequantity')
						->first();

		if(empty($balance) || $balance == null || $balance == '')
		{
			$balance = 0;
		}

		return $balance	;
	}

	public function getFundClusterAttribute($value)
	{
		$fundcluster = "";
		if(isset($this->purchaseorder))
		{
			$purchaseorder = $this->purchaseorder->pluck('number');
			$fundcluster = PurchaseOrderFundCluster::findByPurchaseOrderNumber($purchaseorder)
								->pluck('fundcluster_code');
		}
		return $fundcluster;
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
