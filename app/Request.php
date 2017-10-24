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

    public static function generateID()
    {
      $id = Request::orderBy('created_at','desc')->pluck('id')->first();

      if($id != '' && isset($id) && $id != null )
      {
        $id = explode('-',$id);
        $id = $id[3];
        $id = $id + 1;
      }
      else
      {
        $id = 1;
      }

      $date = Carbon\Carbon::now()->format('mdy');
      $office = Auth::user()->office;
      $id = 'RIS'. '-' . $date . '-' . $office . '-' . $id;
      return $id;
    }

  	public static $issueRules = array(
  		'Stock Number' => 'required|exists:supply,stocknumber',
  		'Quantity' => 'required',
  	);
}
