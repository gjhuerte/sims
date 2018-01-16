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
    	'Quantity.integer' => 'Quantity must not be less than or equal to zero(0)',
	];

	public static $rules = array(
		'Number' => 'required|unique:purchaseorders,number',
		'Date' => 'required',
		'Quantity' => 'integer|min:0'
	);


	public function updateRules(){
		$number = $this->number;
		return array(
			'Number' => 'required|unique:purchaseorders,number,' . $number . ',',
			'Date' => 'required',
			'Quantity' => 'integer|min:0'
		);
	}

	public static $stockRules = [
      'Stock Number' => 'required|exists:supplies,stocknumber',
      'Quantity' => 'required|min:0',
      'Unit Price' => 'required',
    ];

	protected $appends = [
		'date_received_parsed', 'supplier_name'
	];

	public function getDateReceivedParsedAttribute()
	{
		return Carbon\Carbon::parse($this->date_received)->toFormattedDateString();
	}

	public function supplies()
	{
		return $this->belongsToMany('App\Supply','purchaseorders_supplies','purchaseorder_id','supply_id')
          ->withPivot('unitcost', 'received_quantity', 'ordered_quantity', 'remaining_quantity')
          ->withTimestamps();
	}

    public function getSupplierNameAttribute()
    {
        if(isset($this->supplier) && count($this->supplier) > 0):
            if($this->supplier->name)
                return $this->supplier->name;
        endif;

        return 'Not Set';
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

    public function receipt()
    {
        return $this->hasMany('App\Receipt', 'purchaseorder_id', 'id');
    }

}
