<?php

namespace App;

use Auth;
use Carbon;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audits';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $appends = [
    	'user_fullname', 'parsed_date'
    ];

    public function getUserFullnameAttribute()
    {
    	$lastname = count($this->user) > 0 && isset($this->user->lastname) ? $this->user->lastname : "";
    	$firstname = count($this->user) > 0 && isset($this->user->firstname) ? $this->user->firstname : "";
    	$middlename = count($this->user) > 0 && isset($this->user->middlename) ? $this->user->middlename : "";
    	return $lastname . ", " . $firstname . " " . $middlename;
    }

    public function getParsedDateAttribute($value)
    {
      return Carbon\Carbon::parse($this->created_at)->toDayDateTimeString();
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }
   
}
