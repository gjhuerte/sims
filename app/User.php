<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\UserResolver;
use Auth;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends \Eloquent implements Authenticatable, Auditable, UserResolver
{
	use AuthenticableTrait;
    use \OwenIt\Auditing\Auditable;

	//Database driver
	/*
		1 - Eloquent (MVC Driven)
		2 - DB (Directly query to SQL database, no model required)
	*/

	//The table in the database used by the model.
	protected $table  = 'users';

	//The attribute that used as primary key.
	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = ['lastname','firstname','middlename','username','password','email','status','access' ,' position' ];

	protected $hidden = ['password','remember_token'];
	//Validation rules!
	public static $rules = array(
		'Username' => 'required_with:password|min:4|max:20|unique:Users,username',
		'Password' => 'required|min:8|max:50',
		'Firstname' => 'required|between:2,100|string',
		'Middlename' => 'min:2|max:50|string',
		'Lastname' => 'required|min:2|max:50|string',
		'Email' => 'email',
		'Office' => 'required|exists:offices,code'
	);
	public static $informationRules = array(
		'Firstname' => 'required|between:2,100|string',
		'Middlename' => 'min:2|max:50|string',
		'Lastname' => 'required|min:2|max:50|string',
		'Email' => 'email'
	);

	public static $passwordRules = array(
		'Current Password'=>'required|min:8|max:50',
		'New Password'=>'required|min:8|max:50',
		'Confirm Password'=>'required|min:8|max:50|same:New Password',
	);

	public function updateRules(){
		$username = $this->username;
		return array(
			'Username' => 'min:4|max:20|unique:Users,username,'.$username.',username',
			'First name' => 'min:2|max:100|string',
			'Middle name' => 'min:2|max:50|string',
			'Last name' => 'min:2|max:50|string',
			'Email' => 'email',
			'Office' => 'required|exists:offices,code'
		);
	}

	public $action;

	protected $appends = [
		'accessName'
	];

	public function setAccessNameAttribute($value)
	{
		switch($value){
			case 0:
				$this->accessName = "Administrator";
				break;
			case 1:
				$this->accessName = "AMO";
				break;
			case 2:
				$this->accessName = "Accounting";
				break;
			case 3:
				$this->accessName = "Offices";
				break;
		}
	}

	public function getAccessNameAttribute($value)
	{
		switch($this->access){
			case 0:
				return "Administrator";
				break;
			case 1:
				return "AMO";
				break;
			case 2:
				return "Accounting";
				break;
			case 3:
				return "Offices";
				break;
		}
		return $value;
	}


	public function getRememberToken()
	{
		return null; // not supported
	}

	public function setRememberToken($value)
	{
		// not supported
	}

	public function getRememberTokenName()
	{
		return null; // not supported
	}

	/**
	* Overrides the method to ignore the remember token.
	*/
	public function setAttribute($key, $value)
	{
		$isRememberTokenAttribute = $key == $this->getRememberTokenName();
		if (!$isRememberTokenAttribute)
		{
		 parent::setAttribute($key, $value);
		}
	}

	/**
	* {@inheritdoc}
	*/
	public static function resolveId()
	{
		return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
	}


	public function officeInfo()
	{
		return $this->belongsTo('App\Office','office','code');
	}

	public function comments()
    {
        return $this->hasMany('App\RequestComments');
    }
}
