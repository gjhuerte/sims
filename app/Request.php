<?php

namespace App;

use Auth;
use Carbon;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [ 
      'requestor_id' , 
      'office_id' ,
      'issued_by' , 
      'remarks'  , 
      'purpose'  , 
      'status' 
    ];

    public function updateRules(){
      return [
        'Stock Number' => 'required|exists:supplies,stocknumber',
        'Quantity' => 'required|integer|min:1',
        'Purpose' => 'required',
      ];
    }

    public function approveRules(){
      return [
        'Stock Number' => 'required|exists:supplies,stocknumber',
        'Quantity' => 'required|integer|min:0',
      ];
    }
    
    public static $issueRules = array(
      'Stock Number' => 'required|exists:supplies,stocknumber',
      'Quantity' => 'required|integer|min:1',
      'Purpose' => 'required',
    );

    public function commentsRules(){
      return [
        'Details' => 'required|max:100'
      ];
    }
    
    public $appends = [
      'code', 'date_requested'
    ];

    public function getRemarksAttribute($value)
    {

      if($value == null) return 'No Remarks'; 

      return $value;
    }

    public function getStatusAttribute($value)
    {
      if($value == null) return 'Pending';

      return ucfirst($value);
    }

    public function scopePending($query)
    {
      return $query->whereNull('status')->orWhere('status', '=', 'Pending');
    }

    public function scopefilterByOfficeId($query, $value)
    {
      $query->where('office_id', '=', $value);
    }

    public function scopefilterByOfficeCode($query, $value)
    {
      $query->whereHas('office', function($query) use ($value){
        $query->where('code', '=', $value);
      });
    }

    public function getCodeAttribute($value)
    {
      $date = Carbon\Carbon::parse($this->created_at);
      return $date->format('y') . '-' .  $date->format('m') . '-' .  $this->id;
    }

    public function getDateRequestedAttribute($value)
    {
      return Carbon\Carbon::parse($this->created_at)->format("F d Y h:m A");
    }

  	public function supplies()
  	{
  		return $this->belongsToMany('App\Supply','requests_supplies', 'request_id', 'supply_id')
            ->withPivot('quantity_requested', 'quantity_issued', 'quantity_released', 'comments')
            ->withTimestamps();
  	}

    public function requestor()
    {
      return $this->belongsTo('App\User','requestor_id','id');
    }

    public function office()
    {
      return $this->belongsTo('App\Office','office_id','id');
    }

    public function scopeMe($query)
    {
      return $query->where('requestor_id','=',Auth::user()->id);
    }

    public function scopeFindByOffice($query,$value)
    {
      return $query->whereHas('office',function($query) use ($value){
        $query->where('code', '=', $value);
      });
    }

    public function comments()
    {
      return $this->hasMany('App\RequestComments');
    }
     
}