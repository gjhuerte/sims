<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundCluster extends Model
{
    protected $table = 'fundclusters';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [ 'code','description' ];

    public static $rules = array(
        'Code' => 'required|unique:fundclusters,code',
        'Description' => 'required'
    );

    public function updateRules()
    {
        $code = $this->code;
        return array(
                'Code' => 'required|unique:fundclusters,code,' . $code . ',code',
                'Description' => 'required'
        );
    }

    public function scopeFindByCode($query,$value)
    {
    	return $query->where('code','=',$value)->first();
    }

	public function purchaseorders()
	{
		return $this->belongsToMany('App\FundCluster','purchaseorders_fundclusters','fundcluster_id','purchaseorder_id')
          ->withTimestamps();
	}
}
