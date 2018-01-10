<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptSupply extends Model
{
    protected $table = 'receipts_supplies';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'receipt_number',
        'stocknumber',
        'quantity',
        'remaining_quantity',
        'cost'
    ];

	protected $appends = [
		'total_cost'
	];

    public function supply()
    {
    	return $this->belongsTo('App\Supply','supply_id','id');
    }

    public function scopeFindByStockNumber($query,$value)
    {
    	return $query->whereHas('supply', function($query) use ($value){
        $query->where('stocknumber', '=', $value);
      });
    }

    public function scopeFindBySupplyId($query,$value)
    {
    	return $query->where('supply_id','=',$value);
    }

  	public function getTotalCostAttribute($value)
  	{
  		return $this->cost * $this->remaining_quantity;
  	}
}
