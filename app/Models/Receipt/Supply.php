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

    /**
     * Filter the query where the quantity is greater
     * than zero
     *
     * @return object
     */
    public function scopeHasQuantity()
    {
        return $query->where('remaining_quantity', '>', 0);
    }

    /**
     * Filter the query where the unit cost is set
     *
     * @return object
     */
    public function scopeUnitCostHasValue()
    {
        return $query->whereNotNull('unitcost');
    }

    /**
     * Returns the average of unit cost with
     * quantity and the unit cost value is set
     *
     * @return void
     */
    public function scopeAverageOfUnitCost()
    {
        return $query->hasQuantity()
                ->unitCostHasValue()
                ->select('unitcost')
                ->avg('unitcost');
    }
}
