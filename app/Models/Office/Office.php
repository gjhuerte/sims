<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
	protected $table = 'offices';
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
		'code', 'name', 'description',  'manager_id', 'parent_office'
	];

	/**
	 * Filters the query by office code
	 *
	 * @param Builder $query
	 * @param string $value
	 * @return object
	 */
	public function scopeCode($query, string $code)
	{
		return $query->whereCode($code);
	}

	/**
	 * Links to the parent office
	 *
	 * @return object
	 */
	public function parent()
	{
		return $this->belongsTo(Office::class, 'office_id', 'id');
	}

	/**
	 * Links to the child office
	 *
	 * @return object
	 */
	public function children()
	{
		return $this->hasMany(Office::class, 'parent_id', 'id');
	}

	/**
	 * Links to the list of request
	 * the office has
	 *
	 * @return object
	 */
	public function request()
	{
		return $this->hasMany(Request::class, 'office_id', 'id');
	}
}
