<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
  	protected $table = 'supplier';
	protected $fillable = ['name'];
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = true;

	public static $rules = array(
	'Name' => 'required'
	);

	public static $updateRules = array(
	'Name' => ''
	);
}
