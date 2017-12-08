<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundCluster extends Model
{
    protected $table = 'fundclusters';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [ 'code' ];

    public function scopeFindByCode($query,$value)
    {
    	return $query->where('code','=',$value)->first();
    }
}
