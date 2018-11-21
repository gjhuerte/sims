<?php

namespace App\Models\Inspection\Inspection;

use Carbon\Carbon;
use App\Models\User\User;
use App\Models\Inspection\Remark;
use App\Models\Inventory\Supply\Supply;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
  	protected $table = 'inspections';
  	protected $primaryKey = 'id';
	public $timestamps = true;
	public $supply_list = [];

    /**
     * List of columns in the database that
     * can be filled using the create method
     * of the model
     *
     * @var array
     */
	protected $fillable = [ 
		'date', 'stocknumber', 'reference', 'receipt', 'received_by', 'issued', 'organization', 'daystoconsume'
	]; 

	/**
	 * List of status for the inspection
	 *
	 * @var array
	 */
	public static $choosableStatus = [
        0 => 'Pending',
        1 => '1st Inspection',
        2 => 'Passed 1st Inspection',
        3 => 'Final Inspection',
        4 => 'Passed Final Inspection',
        5 => 'Applied To Stock Card',
        99 => 'Failed'
    ];

    /**
     * Additional columns when fetching records
     * These columns are automatically added when
     * the model is initialized
     *
     * @var array
     */
	protected $appends = [
		'code', 'inspector_name'
	];

	/**
	 * Returns the inspector who supervised the inspection
	 *
	 * @return object
	 */
	public function getInspectorNameAttribute()
	{
		return isset($this->receiver) ? $this->receiver->full_name : config('app.data_not_set');
	}

	/**
	 * Link to the receiver model
	 *
	 * @return object
	 */
	public function receiver()
	{
		return $this->belongsTo(User::class, 'received_by', 'id');
	}

	/**
	 * Link to the supplies model
	 *
	 * @return object
	 */
  	public function supplies()
  	{
  		return $this->belongsToMany(Supply::class,'inspections_supplies', 'inspection_id', 'supply_id')
            ->withPivot('quantity_received', 'quantity_adjusted', 'quantity_final', 'daystoconsume')
            ->withTimestamps();
  	}
	
	/**
	 * Link to the remarks model
	 *
	 * @return object
	 */
  	public function remarks()
  	{
  		return $this->hasMany(Remark::class, 'inspection_id', 'id');
  	}
	
	/**
	 * Fetch the code for the given inspection
	 *
	 * @return object
	 */
  	public function getCodeAttribute()
  	{
  		$currentDate = Carbon::now();
  		return $currentDate->format('y') . '-' . $currentDate->format('m') . '-' . $this->id;
  	}
}
