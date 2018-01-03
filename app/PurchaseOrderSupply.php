<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supply;

class PurchaseOrderSupply extends Model
{

    protected $table = 'purchaseorders_supplies';
	protected $fillable = ['user_id','purchaseorder_number','stocknumber','orderedquantity','receivedquantity', 'remainingquantity', 'unitprice'];
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = true;

	public static $rules = array(
	'Stock Number' => 'required|exists:supplies,stocknumber',
	'Quantity' => 'required|integer|min:1',
	'Unit Price' => 'required|min:0',
	);

	public static $updateRules = array(
	'Reference' => '',
	'Stock Number' => ''
	);

	protected $attributes = [
        'receivedquantity' => 0,
        'unitcost' => 0,
    ];

    protected $appends = [
    	'amount'
    ];

    public function getAmountAttribute()
    {
    	return $this->receivedquantity * $this->unitcost;
    }

	public function supply()
	{
		return $this->belongsTo('App\Supply','stocknumber','stocknumber');
	}

	public function purchaseorder()
	{
		return $this->belongsTo('App\PurchaseOrder','purchaseorder_number','number');
	}
}
