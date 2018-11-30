<?php

namespace App\Models\Inventory\Supply;

use Illuminate\Database\Eloquent\Model;

class Adjustment extends Model
{
    protected $table = 'disposals';
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
    public $fillable = [
      'created_by', 'status', 'details'
    ];

    /**
     * Additional columns when fetching records
     * These columns are automatically added when
     * the model is initialized
     *
     * @var array
     */
    protected $appends = [
      'code', 'date_created'
    ];

    // public function getDetailsAttribute($value)
    // {
    //   if($this->attributes['details'])
    //     $details = $this->attributes['details'];
    //   else
    //     $details = 'Not Specified';

    //   return $details;
    // }

    // public function getCodeAttribute($value)
    // {
    //   $date = Carbon\Carbon::parse($this->created_at);
    //   return $date->format('y') . '-' .  $date->format('m') . '-' .  $this->id;
    // }

    // public function getStatusAttribute($value)
    // {
    //   if($this->attributes['status'] == null) 
    //     $status = config('app.default_status');
    //   else 
    //     $status = $this->attributes['status'];

    //   return ucfirst($status);
    // }

    // public function getTotalAmountAttribute($value)
    // {
    //     $quantity = isset($this->pivot->attributes['quantity']) ? $this->pivot->attributes['quantity'] : 0;
    //     $unitcost = isset($this->pivot->attributes['unitcost']) ? $this->pivot->attributes['unitcost'] : 0;

    //     return $quantity * $unitcost;
    // }

    // public function getDateCreatedAttribute($value)
    // {
    //   return Carbon\Carbon::parse($this->created_at)->toDayDateTimeString();
    // }
    
    // public static $rules = array(
    //   'Stock Number' => 'required|exists:supplies,stocknumber',
    //   'Quantity' => 'required|integer|min:1',
    // );

  	// public function supplies()
  	// {
  	// 	return $this->belongsToMany('App\Supply','disposal_supply', 'disposal_id', 'supply_id')
    //         ->withPivot('quantity', 'unitcost')
    //         ->withTimestamps();
  	// }
}
