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
      'requestor' , 
      'office' ,
      'issued_by' , 
      'remarks'  , 
      'status' 
    ];
    
    public static $issueRules = array(
      'Stock Number' => 'required|exists:supplies,stocknumber',
      'Quantity' => 'required|integer|min:1',
    );
    
    public $appends = [
      'code'
    ];

    public function getCodeAttribute($value)
    {
      $date = Carbon\Carbon::parse($this->created_at);
      return $date->format('y') . '-' .  $date->format('m') . '-' .  $this->id;
    }

  	public function supply()
  	{
  		return $this->belongsToMany('App\Supply','requests_supplies','request_id','stocknumber');
  	}

    public function requestorInfo()
    {
      return $this->belongsTo('App\User','requestor','username');
    }

    public function officeInfo()
    {
      return $this->belongsTo('App\Office','office','code');
    }

    public function scopeMe($query)
    {
      return $query->where('requestor','=',Auth::user()->username);
    }

    public function scopeFindByOffice($query,$value)
    {
      return $query->where('office','=',$value);
    }

    public function comments()
    {
      return $this->hasMany('App\RequestComments');
    }
}
