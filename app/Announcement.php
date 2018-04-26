<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon;

class Announcement extends Model
{
    protected $table = 'announcements';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public $access_list = [

        0 => 'Administrator Only',
        1 => 'Assets Management', 
        2 => 'Accounting',
        3 => 'Offices',
        4 => 'All'

    ];

    protected $fillable = [
    	'title', 'details', 'access', 'user_id'
    ];

    protected $appends = [
        'created_by', 'access_name'
    ];

    public function rules()
    {
        return [
            'Title' => 'required|max:50',
            'Details' => 'max:100'
        ];
    }

    public function updateRules()
    {
        return [
            'Title' => 'required|max:50',
            'Details' => 'max:100'
        ];
    }

    public function getAccessNameAttribute()
    {
        $ret_val = 'Not Set';

        if(array_key_exists($this->access, $this->access_list))
        {
            $ret_val = $this->access_list[$this->access];
        }

        return $ret_val;
    }

    public function scopeOfficeOrSelf($query)
    {
        $query->where(function($query){
            $query->where('specified_users', '=', Auth::user()->access)
                ->orWhereIn('specified_users', User::where('office', '=', Auth::user()->office )->pluck('id'));
        });
    }

    public function scopeOrOffice($query)
    {
        return $query->orWhereIn('specified_users', User::where('office', '=', Auth::user()->office )->pluck('id'));
    }

    public function scopeOrSelf($query)
    {
        return $query->orWhere('specified_users', '=', Auth::user()->access);
    }

    public function scopeForAll($query)
    {
        return $query->where('access','=','4');
    }

    public function scopeSelf($query)
    {
        return $query->where('specified_users', '=', Auth::user()->access);
    }

    public function getCreatedByAttribute()
    {
        return $this->creator->firstname . " " . $this->creator->lastname;
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function users()
    {
    	return $this->belongsToMany('App\User', 'announcement_user', 'user_id', 'announcement_id')
    			->withPivot(['is_read'])
    			->withTimestamps();
    }

    public function scopeFindByAccess($query, $value)
    {
        if(is_array($value)) return $query->whereIn('access', $value);

        return $query->where('access','=', $value);
    }

    public static function notify($title, $details, $access = 4, $url = null, $user = null)
    {
        $announcement = new Announcement;
        $announcement->title = $title;
        $announcement->details = $details;
        $announcement->access = $access;
        $announcement->url = $url;
        $announcement->user_id = Auth::user()->id;
        $announcement->specified_users = $user;
        $announcement->save();
    }

}
