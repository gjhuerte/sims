<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
  	protected $table = 'suppliers';
	protected $primaryKey = 'id';
	protected $fillable = ['name','address','contact','website','email'];
	public $incrementing = true;
	public $timestamps = true;

	public static $rules = array(
		'Name' => 'required',
		'Email' => 'email',
 	);

	public static $updateRules = array(
		'Name' => 'required'
	);

	public function purchaseorder()
	{
		return $this->hasMany('App\PurchaseOrder','supplier_id','id');
	}
}
