<?php

namespace App;

use App\Models\Office\Office;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'offices';
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
		'name', 'abbreviation' , 'office_id'
	];
	
	/**
	 * Lik to the office model
	 *
	 * @return void
	 */
	public function office()
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    } 
}
