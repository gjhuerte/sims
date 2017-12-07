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

    public $appends = [
      'code'
    ];

    public function getCodeAttribute($value)
    {
      $date = Carbon\Carbon::parse($this->created_at);
      return 'RIS' . '-' . $date->format('y') . '-' .  $date->format('m') . '-' .  $this->id;
    }

  	public function supply()
  	{
  		return $this->belongsToMany('App\Supply','requests_supplies','request_id','stocknumber');
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
  	public static $issueRules = array(
  		'Stock Number' => 'required|exists:supplies,stocknumber',
  		'Quantity' => 'required',
  	);
}
