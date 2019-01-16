<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
	protected $table = 'units';
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
		'name', 'description', 'abbreviation'
	];
}
