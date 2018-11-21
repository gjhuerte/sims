<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseOrder\PurchaseOrder;

class FundCluster extends Model
{
    protected $table = 'fund_clusters';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * List of columns in the database that
     * can be filled using the create method
     * of the model
     *
     * @var array
     */
    protected $fillable = [ 
        'code', 'description' 
    ];

    /**
     * Filters the query by the fund cluster code
     *
     * @param Builder $query
     * @param string $value
     * @return object
     */
    public function scopeCode($query,$value)
    {
    	return $query->where('code','=',$value)->first();
    }

    /**
     * Link to the purchase order of the fund cluster
     *
     * @return void
     */
	public function purchaseorders()
	{
		return $this->belongsToMany(
            PurchaseOrder::class, 'purchaseorders_fundclusters', 'fundcluster_id', 'purchaseorder_id'
        )->withTimestamps();
	}
}
