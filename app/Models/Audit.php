<?php

namespace App;

use Carbon\Carbon;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audits';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    /**
     * Additional columns when fetching records
     * These columns are automatically added when
     * the model is initialized
     *
     * @var array
     */
    protected $appends = [
    	'user_fullname', 'parsed_date'
    ];

    /**
     * Fetch the users full name attribute
     *
     * @return void
     */
    public function getUserFullnameAttribute()
    {
    	return isset($this->user) ? $this->user->full_name : config('app.data_not_set');
    }

    /**
     * Fetch the parsed date attribute
     *
     * @param Builder $value
     * @return object
     */
    public function getParsedDateAttribute($value)
    {
      return Carbon::parse($this->created_at)->toDayDateTimeString();
    }

    /**
     * Returns the link to the users class
     *
     * @return object
     */
    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }
   
}
