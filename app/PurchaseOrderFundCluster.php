<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supply;
class PurchaseOrderFundCluster extends Model
{
    protected $table = 'purchaseorders_fundclusters';
	protected $fillable = ['purchaseorder_id','fundcluster_id'];
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = true;

	// public static $rules = array(
	// 'Reference' => 'required',
	// 'Stock Number' => 'required',
	// );

	// public static $updateRules = array(
	// 'Reference' => '',
	// 'Stock Number' => ''
	// );

	public function scopeFindByPurchaseOrderNumber($query,$value)
	{
		$query->whereIn('purchaseorder_id',$value);
	}

	public function fundcluster()
	{
		return $this->belongsTo('App\FundCluster','fundcluster_id','id');
	}
}
