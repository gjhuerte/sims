<?php

namespace App\Models\PurchaseOrder;

use Carbon\Carbon;
use App\Models\Inventory\Supplier;
use App\Models\Inventory\Supply\Supply;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
	protected $table = 'purchaseorders';
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
		'number','date_received','details', 'supplier_id' 
	];

    /**
     * Additional columns when fetching records
     * These columns are automatically added when
     * the model is initialized
     *
     * @var array
     */
	protected $appends = [
		'date_received_parsed', 'supplier_name'
	];

	/**
	 * Parse the date for the date received
	 *
	 * @return object
	 */
	public function getDateReceivedParsedAttribute()
	{
		return Carbon::parse($this->date_received)->toFormattedDateString();
	}

	/**
	 * Fetch the supplier name of this purchase order
	 *
	 * @return void
	 */
    public function getSupplierNameAttribute()
    {
        return isset($this->supplier) ? $this->supplier->name : config('app.data_not_set');
    }

	/**
	 * Filters the query by purchase order number
	 *
	 * @param Builder $query
	 * @param string $number
	 * @return object
	 */
	public function scopeNumber($query, $number)
	{
		return $query->whereNumber('number', $number);
	}

	/**
	 * Links to the purchase order supplies
	 *
	 * @return object
	 */
	public function supplies()
	{
		return $this->belongsToMany(Supply::class,'purchaseorders_supplies', 'purchaseorder_id', 'supply_id')
          ->withPivot('unitcost', 'received_quantity', 'ordered_quantity', 'remaining_quantity')
          ->withTimestamps();
	}

	/**
	 * Fetch the list of fund cluster for this purchase order
	 *
	 * @return void
	 */
	public function fundclusters()
	{
		return $this->belongsToMany(FundCluster::class,'purchaseorders_fundclusters','purchaseorder_id','fundcluster_id')
          ->withTimestamps();
	}

	/**
	 * Fetch the suppliers information
	 *
	 * @return void
	 */
	public function supplier()
	{
		return $this->belongsTo(Supplier::class,'supplier_id','id');
	}

	/**
	 * Link to the receipt table
	 *
	 * @return object
	 */
    public function receipt()
    {
        return $this->hasMany(Receipt::class, 'purchaseorder_id', 'id');
    }

}
