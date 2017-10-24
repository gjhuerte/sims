<?php

namespace App;

use App\Supply;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
  	protected $table = 'purchaseorder';
	protected $fillable = ['purchaseorderno','date','fundcluster','details'];
	protected $primaryKey = 'purchaseorderno';
	public $incrementing = false;
	public $timestamps = true;

	public static $rules = array(
	'Purchase Order' => 'required|unique:purchaseorder,purchaseorderno',
	'Date' => 'required',
	'Fund Cluster' => '',
	'Details' => ''
	);

	public static $updateRules = array(
	'Purchase Order No' => '',
	'Date' => '',
	'Fund Cluster' => '',
	'Details' => ''
	);

	public function supply()
	{
		return $this->belongsToMany('App\Supply','purchaseorder_supply','supplyitem','purchaseorderno');
	}
}
