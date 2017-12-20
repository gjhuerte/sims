<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
  	protected $table = 'purchaseorders';
	protected $fillable = [ 'number','date_received','details', 'supplier_id' ];
	protected $primaryKey = 'id';
	public $timestamps = true;

	public static $messages = [
    'Quantity.integer' => 'Quantity must not be 0',
	];

	public static $rules = array(
		'Purchase Order' => 'required|unique:purchaseorders,number',
		'Date' => 'required',
		'Fund Cluster' => '',
		'Details' => '',
		'Quantity' => 'integer|min:0'
	);

	
	public static $updateRules = array(
		'Purchase Order' => '',
		'Date' => '',
		'Fund Cluster' => '',
		'Details' => '',
		'Quantity' => ''
	);

	public function supply()
	{
		return $this->belongsToMany('App\Supply','purchaseorders_supplies','stocknumber','purchaseorder_number');
	}

	public function fundcluster()
	{
		return $this->belongsToMany('App\FundCluster','purchaseorders_fundclusters','purchaseorder_number','fundcluster_code');
	}

	public function supplier()
	{
		return $this->belongsTo('App\Supplier','supplier_id','id');
	}

	public function scopeFindByNumber($query, $number)
	{
		return $query->where('number','=',$number);
	}

	public function scopeFindByID($query, $id)
	{
		return $query->where('id','=',$id);
	}

	public function updateFundCluster()
	{
		if(isset($this->fundcluster) &&  count(explode(",",$this->fundcluster)) > 0)
		{
			foreach(explode(",", $this->fundcluster) as $fundcluster)
			{
				$fundcluster = FundCluster::firstOrCreate( [ 'code' => $fundcluster ] );
				PurchaseOrderFundCluster::firstOrCreate([ 'purchaseorder_number' => $this->number, 'fundcluster_code' => $fundcluster->code ]);
			}
		}
	}
}
