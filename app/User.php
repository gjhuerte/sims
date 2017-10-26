<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends \Eloquent implements Authenticatable
{
	use AuthenticableTrait;

	//Database driver
	/*
		1 - Eloquent (MVC Driven)
		2 - DB (Directly query to SQL database, no model required)
	*/

	//The table in the database used by the model.
	protected $table  = 'user';

	//The attribute that used as primary key.
	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = ['lastname','firstname','middlename','username','password','email','status','accesslevel'];

	protected $hidden = ['password','remember_token'];
	//Validation rules!
	public static $rules = array(
		'Username' => 'required_with:password|min:4|max:20|unique:User,username',
		'Password' => 'required|min:8|max:50',
		'Firstname' => 'required|between:2,100|string',
		'Middlename' => 'min:2|max:50|string',
		'Lastname' => 'required|min:2|max:50|string',
		'Email' => 'email',
		'Office' => 'required|exists:office,deptcode'
	);
	public static $informationRules = array(
		'Firstname' => 'required|between:2,100|string',
		'Middlename' => 'min:2|max:50|string',
		'Lastname' => 'required|min:2|max:50|string',
		'Email' => 'email'
	);

	public static $passwordRules = array(
		'Current Password'=>'required|min:8|max:50',
		'New Password'=>'required|min:8|max:50'
	);

	public static $updateRules = array(
		'Username' => 'min:4|max:20',
		'Password' => 'min:6|max:50',
		'First name' => 'min:2|max:100|string',
		'Middle name' => 'min:2|max:50|string',
		'Last name' => 'min:2|max:50|string',
		'Email' => 'email',
		'Office' => 'required|exists:office,deptcode'
	);


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


	public function office()
	{
		return $this->belongsTo('App\Office','office','deptcode');
	}
}
