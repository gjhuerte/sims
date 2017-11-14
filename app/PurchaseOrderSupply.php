<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supply;
class PurchaseOrderSupply extends Model
{
    protected $table = 'purchaseorders_supplies';
	protected $fillable = ['user_id','purchaseorder_id','stocknumber','orderedquantity','receivedquantity','unitprice'];
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = true;

	public static $rules = array(
	'Reference' => 'required',
	'Stock Number' => 'required',
	);

	public static $updateRules = array(
	'Reference' => '',
	'Stock Number' => ''
	);

	public function supply()
	{
		return $this->belongsTo('App\Supply','stocknumber','stocknumber');
	}
}
