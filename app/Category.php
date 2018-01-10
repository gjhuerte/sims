<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
class Category extends Model{

	protected $table = 'categories';
	protected $primaryKey = 'id';
	protected $fillable = ['code','name','uacs_code'];
	public $timestamps = false;

	public function rules(){
		return array(
			'Code' => 'required|max:20|unique:Categories,uacs_code',
			'Name' => 'required|max:200|unique:Categories,name'
		);
	}

	public function updateRules(){
		$code = $this->uacs_code;
		$name = $this->name;
		return array(
			'Code' => 'required|max:20|unique:Categories,uacs_code,'.$code.',uacs_code',
			'Name' => 'required|max:200|unique:Categories,name,'.$name.',name'
		);
	}

	public function scopeFindByCode($query,$value)
	{
		return $query->where('uacs_code','=',$value)->first();
	}

	public function scopeCode($query,$value)
	{
		return $query->where('uacs_code','=',$value);
	}

}
