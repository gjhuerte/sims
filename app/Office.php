<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
class Office extends Model{

	protected $table = 'offices';
	protected $primaryKey = 'id';
	protected $fillable = ['code','name','description', 'head', 'department_id'];
	public $timestamps = false;

	public function rules(){
		return array(
			'Code' => 'required|max:20|unique:Offices,code',
			'Name' => 'required|max:200',
			'Description' => 'max:200'
		);
	}

	public function updateRules(){
		$code = $this->code;
		return array(
			'Code' => 'required|max:20|unique:Offices,code,'.$code.',code',
			'Name' => 'required|max:200',
			'Description' => 'max:200'
		);
	}

	public function scopeFindByCode($query,$value)
	{
		return $query->where('code','=',$value)->first();
	}

	public function scopeCode($query,$value)
	{
		return $query->where('code','=',$value);
	}

}
