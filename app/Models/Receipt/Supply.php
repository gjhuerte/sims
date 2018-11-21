<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory\Supply\Supply as InventorySupply;

class Supply extends Model
{
    protected $table = 'receipts_supplies';
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
        'receipt_number', 'stocknumber', 'quantity', 'remaining_quantity', 'cost'
    ];

    /**
     * Additional columns when fetching records
     * These columns are automatically added when
     * the model is initialized
     *
     * @var array
     */
    protected $appends = [
        'total_cost'
    ];

    /**
     * Fetch the total cost by multiplying to cost
     * to the remaining quantity in the receipt
     *
     * @param Builder $value
     * @return object
     */
    public function getTotalCostAttribute($value)
    {
        return $this->cost * $this->remaining_quantity;
    }

    /**
     * Links to the supply table in the inventory
     *
     * @return object
     */
    public function supply()
    {
        return $this->belongsTo(InventorySupply::class,'supply_id','id');
    }

    /**
     * Filters the query by stock number
     *
     * @param Builder $query
     * @param string $value
     * @return object
     */
    public function scopeStockNumber($query, $value)
    {
        return $query->whereHas('supply', function($query) use ($value) {
            $query->whereStocknumber($value);
        });
    }

    /**
     * Filters the query by supply id
     *
     * @param Builder $query
     * @param string $value
     * @return object
     */
    public function scopeSupplyId($query, $value)
    {
        return $query->where('supply_id', '=', $value);
    }
}
