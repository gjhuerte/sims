<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestComments extends Model
{
    protected $table = 'requests_comments';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
 	protected $dates = ['created_at','updated_at'];
    protected $fillable = ['details','requests_id','comment_by'];

   	public function post()
	{
	    return $this->belongsTo('App\Request');
	}
	public function user()
	{
	    return $this->belongsTo('App\User', 'user_id','id');
	}

}
