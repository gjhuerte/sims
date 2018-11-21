<?php
namespace App\Models\Inventory\Supply;

use App\Models\Inventory\Unit;
use App\Models\Request\Request;
use App\Models\Inventory\Category;
use App\Models\Inventory\Supply\Stock;
use App\Models\Inventory\Supply\Ledger;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseOrder\PurchaseOrder;
use App\Models\Receipt\Supply as ReceiptSupply;

class Supply extends Model
{

	protected $table = 'supplies';
	protected $primaryKey = 'id';
	public $incrementing = false;
	public $timestamps = true;
	
    /**
     * List of columns in the database that
     * can be filled using the create method
     * of the model
     *
     * @var array
     */
	protected $fillable = [
		'stocknumber', 'details', 'unit', 'reorderpoint'
	];

    /**
     * Additional columns when fetching records
     * These columns are automatically added when
     * the model is initialized
     *
     * @var array
     */
	protected $appends = [
		'temporary_balance', 'stock_balance', 'ledger_balance', 'unitcost', 'unit_name'
	];

	/**
	 * Returns the unit name for the given supply
	 *
	 * @return void
	 */
	public function getUnitNameAttribute()
	{
		return isset($this->unit) ?  $this->unit->name : config('app.data_not_set');
	}

	/**
	 * Returns the average supply for the given unit
	 *
	 * @return void
	 */
	public function getUnitCostAttribute()
	{
		$cost = ReceiptSupply::findByStockNumber($this->stocknumber)
								->averageOfUnitCost();

		return (count($cost) > 0) ? $cost : 0;
	}

	/**
	 * Fetch the temporary balance of the supply which can be collected 
	 * from the remaining balance of the supply subtracted by the issued
	 * supply in the request
	 *
	 * @return string
	 */
	public function getTemporaryBalanceAttribute()
	{

		$remainingBalance = 0;
		$issuedQuantity = 0;

		// check if the supply has stock
		// if the supply has stock, fetch the first value
		if($this->stocks->sortByDesc('id')->first() !== null) {
			$remainingBalance = $this->stocks->sortByDesc('id')->pluck('balance_quantity')->first();
		}

		// checks if the issued quantity is equals to zero
		// if the issued quantity is not zero, sum the issued quantity
		if($this->requests->where('status', '=', 'approved')->pivot !== null) {
			$issuedQuantity = $this->requests->where('status', '=', 'approved')->pivot->sum('quantity_issued');
		}
		return 	$remainingBalance - $issuedQuantity;
	}

	/**
	 * Fetch the balance from the stock card
	 *
	 * @return void
	 */
	public function getStockBalanceAttribute()
	{
		$remainingBalance = $this->stocks->sortBy('id','desc')->pluck('balance_quantity')->first();
		return isset($remainingBalance) ? $remainingBalance : 0;
	}

	/**
	 * Fetch the balance of the ledger 
	 *
	 * @return void
	 */
	public function getLedgerBalanceAttribute()
	{
		$remainingBalance = $this->ledgers->sortBy('id','desc')->pluck('balance_quantity')->first();
		return isset($remainingBalance) ? $remainingBalance : 0;
	}

	/**
	 * Filter the record by issued quantity
	 *
	 * @param Builder $query
	 * @return void
	 */
	public function scopeIssued($query)
	{
		return $query->where('issued_quantity', '>', 0);
	}

	/**
	 * Filter by category name
	 *
	 * @param Builder $query
	 * @param string $value
	 * @return object
	 */
	public function scopeNameOfCategory($query, $value)
	{
		return $query->whereHas('category', function($query) use ($value) {
			$query->where('name', '=', $value);
		} );
	}

	/**
	 * Filter record by stock number
	 *
	 * @param Builder $query
	 * @param string $value
	 * @return object
	 */
	public function scopeStockNumber($query, $value)
	{
		return $query->where('stocknumber', '=', $value);
	}

	/**
	 * Link to the list of stocks
	 *
	 * @return object
	 */
	public function stocks()
	{
		return $this->hasMany(Stock::class,'supply_id');
	}

	/**
	 * Link to the list of ledger
	 *
	 * @return object
	 */
	public function ledgers()
	{
		return $this->hasMany(Ledger::class,'supply_id');
	}

	/**
	 * Parsed unit cost for the supply
	 *
	 * @param  $value
	 * @return string
	 */
	public function getUnitPriceAttribute($value)
	{
		return number_format($value, 2, '.', ',');
	}

	/**
	 * Link to the purchase order model
	 *
	 * @return object
	 */
	public function purchaseorders()
	{
		return $this->belongsToMany(
			'App\PurchaseOrder','purchaseorders_supplies', 'supply_id','purchaseorder_id'
		)
		->withPivot('unitcost', 'received_quantity', 'ordered_quantity', 'remaining_quantity')
		->withTimestamps();
	}

	/**
	 * Link to the receipt model
	 *
	 * @return object
	 */
	public function receipts()
	{
		return $this->belongsToMany(
			Receipt::class, 'receipts_supplies', 'supply_id', 'receipt_id'
		)
		->withPivot('unitcost', 'quantity', 'remaining_quantity')
		->withTimestamps();
	}

	/**
	 * Link to the request class
	 *
	 * @return object
	 */
	public function requests()
	{
		return $this->belongsToMany(Request::class,'requests_supplies','supply_id','request_id')
            ->withPivot('quantity_requested', 'quantity_issued', 'quantity_released', 'comments')
            ->withTimestamps();
	}

	/**
	 * Link to the category model
	 *
	 * @return void
	 */
	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}

	/**
	 * Link to the unit of the supply
	 *
	 * @return object
	 */
	public function unit()
	{
		return $this->belongsTo(Unit::class, 'unit_id', 'id');
	}

}
