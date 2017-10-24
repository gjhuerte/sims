<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supply;
class PurchaseOrderSupply extends Model
{
    protected $table = 'purchaseorder_supply';
	protected $fillable = ['user_id','purchaseorderno','reference','date','supplyitem','orderedquantity','receivedquantity','unitprice'];
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = true;

	public static $rules = array(
	'User Id' => '',
	'Purchase Order No' => 'required',
	'Supply Item' => 'required',
	'Ordered Quantity' => 'required',
	'Received Quantity' => '',
	'Unit Price' => ''
	);

	public static $updateRules = array(
	'User Id' => '',
	'Purchase Order No' => '',
	'Supply Item' => '',
	'Ordered Quantity' => '',
	'Received Quantity' => '',
	'Unit Price' => ''
	);

	public function supply()
	{
		return $this->belongsTo('App\Supply','supplyitem','stocknumber');
	}
}
