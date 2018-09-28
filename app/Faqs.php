<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faqs extends Model
{
    protected $table = 'faqs';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function rules()
    {
    	return [
    		'title' => 'required|min:5|max:30',
    		'description' => 'max:800'
    	];
    }

    protected $appends = [
        'created_by'
    ];

    public function getCreatedByAttribute()
    {
        $created_by = $this->creator->firstname . " " . $this->creator->lastname;
        return $created_by;
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function solutions()
    {
        return $this->hasMany('App\Solution', 'faqs_id', 'id');
    }
}
