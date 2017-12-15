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
		'New Password'=>'required|min:8|max:50'
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

	public function createAuditTrail()
	{

		$audit = new Audit;
		$audit->table_affected = "User";
		$audit->action = $this->action;
		$array = [];
		$old = [];
		$details = "";
		$column = "";

		$user = User::find($this->id);


		if( $this->action == 'create' )
		{
			$details = "User created with the following details: ";
		}

		if( $this->action == 'update' )
		{
			$details = "User $user->username's information updated with the following:";
		}

		if( $this->action == 'delete' )
		{
			$details = "User with the following information deleted:";
		} 

		if(!($this->action == 'update' && $this->username == $user->username ))
		{
			array_push($old,"username",$user->username);
			array_push($array,"username",$this->username);
			$details = $details . "$this->username as username,";
			$column = $column . "username,";
		}
		
		if(!($this->action == 'update' && $this->firstname == $user->firstname ))
		{
			array_push($old,"firstname",$user->firstname);
			array_push($array,"firstname",$this->firstname);
			$details = $details . "$this->firstname as firstname,";
			$column = $column . "firstname,";
		}

		if(!($this->action == 'update' && $this->middlename == $user->middlename ))
		{
			array_push($old,"middlename",$user->middlename);
			array_push($array,"middlename",$this->middlename);
			$details = $details . "$this->middlename as middlename,";
			$column = $column . "middlename,";
		}

		if(!($this->action == 'update' && $this->lastname == $user->lastname ))
		{
			array_push($old,"lastname",$user->lastname);
			array_push($array,"lastname",$this->lastname);
			$details = $details . "$this->lastname as lastname,";
			$column = $column . "lastname,";
		}

		if(!($this->action == 'update' && $this->position == $user->position ))
		{
			array_push($old,"position",$user->position);
			array_push($array,"position",$this->position);
			$details = $details . "$this->position as position,";
			$column = $column . "position,";
		}

		if(!($this->action == 'update' && $this->access == $user->access ))
		{
			array_push($old,"access",$user->access);
			array_push($array,"access",$this->access);
			$details = $details . "$this->accessName as access,";
			$column = $column . "access,";
		}

		if(!($this->action == 'update' && $this->office == $user->office ))
		{
			array_push($old,"office",$user->office);
			array_push($array,"office",$this->office);
			$details = $details . "$this->office as office,";
			$column = $column . "office,";
		}

		if(!($this->action == 'update' && $this->email == $user->email ))
		{
			array_push($old,"email",$user->email);
			array_push($array,"email",$this->email);
			$details = $details . "$this->email as email,";
			$column = $column . "email,";
		}

		if($this->action == 'update' && $this->password != $user->password )
		{
			$column = "password,";
			$details = "Password Update for User with an id of $user->id";
		}

		$audit->details = $details;
		$audit->column = $column;

		if( $this->action == 'update' )
		{
			$audit->initial = json_encode($old);
			$audit->succeeding = json_encode($array);
		}
		else
		{
			$audit->initial = json_encode($array);
		}

		$audit->createRecord();
	}

	public function comments()
    {
        return $this->hasMany('App\RequestComments');
    }
}
