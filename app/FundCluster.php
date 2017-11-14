<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundCluster extends Model
{
    protected $table = 'fundclusters';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function purchaseorder()
    {
    	return $this->belongsToMany('App\PurchaseOrder','fundcluster_code','purchaseorder_number');
    }
}
