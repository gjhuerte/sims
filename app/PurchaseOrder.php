<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
  	protected $table = 'purchaseorders';
	protected $fillable = ['number','date_received','details'];
	protected $primaryKey = 'id';
	public $timestamps = true;

	public static $rules = array(
		'Number' => 'required|unique:purchaseorders,number',
		'Date' => 'required',
		'Fund Cluster' => '',
		'Details' => ''
	);

	public static $updateRules = array(
		'Number' => '',
		'Date' => '',
		'Fund Cluster' => '',
		'Details' => ''
	);

	public function supply()
	{
		return $this->belongsToMany('App\Supply','purchaseorders_supplies','stocknumber','purchaseorder_number');
	}

	public function supplier()
	{
		return $this->belongsTo('App\Supplier','supplier_id','id');
	}

	public function fundcluster()
	{
		return $this->belongsToMany('App\FundCluster','purchaseorders_fundclusters','purchaseorder_number','fundcluster_code');
	}

  public function scopeFindByNumber($query, $number)
  {
    return $query->where('number','=',$number);
  }
}
