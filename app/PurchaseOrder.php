<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;

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

  protected $appends = [
		'date_received_parsed',
  ];

	public function getDateReceivedParsedAttribute()
	{
		return Carbon\Carbon::parse($this->date_received)->toFormattedDateString();
	}

	public function supplies()
	{
		return $this->belongsToMany('App\Supply','purchaseorders_supplies','purchaseorder_id','supply_id')
          ->withPivot('unitcost', 'received_quantity', 'reference', 'date', 'ordered_quantity', 'remaining_quantity')
          ->withTimestamps();
	}

	public function fundclusters()
	{
		return $this->belongsToMany('App\FundCluster','purchaseorders_fundclusters','purchaseorder_id','fundcluster_id')
          ->withTimestamps();
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
}
