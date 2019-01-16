<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	protected $table = 'categories';
	protected $primaryKey = 'id';
	public $timestamps = false;

    /**
     * List of columns in the database that
     * can be filled using the create method
     * of the model
     *
     * @var array
     */
	protected $fillable = [
		'code', 'name', 'uacs_code'
	];

	/**
	 * Filter the query by the given code argument
	 *
	 * @param Builder $query
	 * @param string $value
	 * @return object
	 */
	public function scopeCode($query, $value)
	{
		return $query->where('uacs_code', '=', $value);
	}

}
