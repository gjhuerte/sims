<?php

namespace App;

use Auth;
use Carbon;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [ 'id' , 'requestor' , 'issued_by' , 'remarks'  , 'status' ];
    public $timestamps = true;

  	public function supply()
  	{
  		return $this->belongsToMany('App\Supply','supply_requests','request_id','stocknumber');
  	}

    public function scopeSelf($query)
    {
      return $query->where('requestor','=',Auth::user()->username);
    }

  	public static $issueRules = array(
  		'Stock Number' => 'required|exists:supply,stocknumber',
  		'Quantity' => 'required',
  	);
}
