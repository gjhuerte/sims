<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundCluster extends Model
{
    protected $table = 'fundclusters';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [ 'code' ];

    public static $rules = array(
        'Code' => 'required|unique:fundclusters,code',
        'Description' => 'required'
    );

    public function scopeFindByCode($query,$value)
    {
    	return $query->where('code','=',$value)->first();
    }

	public function purchaseorder()
	{
		return $this->belongsToMany('App\PurchaseOrder','purchaseorders_fundclusters','purchaseorder_number','fundcluster_code');
	}
}
