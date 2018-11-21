<?php
namespace App\Models\Inventory\Inspection;

use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
	protected $table = 'inspections_remarks';
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
		'title', 'user_id', 'description'
	];
}