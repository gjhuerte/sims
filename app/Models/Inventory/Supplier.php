<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseOrder\PurchaseOrder;

class Supplier extends Model
{
  	protected $table = 'suppliers';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = true;
	
    /**
     * List of columns in the database that
     * can be filled using the create method
     * of the model
     *
     * @var array
     */
	protected $fillable = [
		'name','address','contact','website','email'
	];

	/**
	 * Link to the purchase order model
	 *
	 * @return void
	 */
	public function purchase_order()
	{
		return $this->hasMany(PurchaseOrder::class, 'supplier_id', 'id');
	}
}
