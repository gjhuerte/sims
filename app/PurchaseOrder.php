<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
  	protected $table = 'purchaseorders';
	protected $fillable = ['number','date_received','details'];
	protected $primaryKey = 'id';
	public $timestamps = true;

	public static $messages = [
    'Quantity.integer' => 'Quantity must not be 0',
	];
	public static $rules = array(
		'Number' => 'required|unique:purchaseorders,number',
		'Date' => 'required',
		'Fund Cluster' => '',
		'Details' => '',
		'Quantity' => 'integer|min:0'
	);

	
	public static $updateRules = array(
		'Number' => '',
		'Date' => '',
		'Fund Cluster' => '',
		'Details' => '',
		'Quantity' => ''
	);

	public function supply()
	{
		return $this->belongsToMany('App\Supply','purchaseorders_supplies','stocknumber','purchaseorder_number');
	}

	public function supplier()
	{
		return $this->belongsTo('App\Supplier','supplier_id','id');
	}

	public function scopeFindByNumber($query, $number)
	{
		return $query->where('number','=',$number);
	}
}
