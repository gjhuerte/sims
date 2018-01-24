<?php
namespace App;

use Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;
class Office extends Model{

	protected $table = 'offices';
	protected $primaryKey = 'id';
	protected $fillable = ['code','name','description', 'head'];
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

	public $appends = [
		'office_head'
	];

	public function getOfficeHeadAttribute()
	{
		if($this->head == null || $this->head == '' ) return 'None';

		return $this->head;
	}

	public function scopeFindByCode($query,$value)
	{
		return $query->where('code','=',$value)->first();
	}

	public function scopeCode($query,$value)
	{
		return $query->where('code','=',$value);
	}

	public function departments()
	{
		return $this->hasMany('App\Department', 'office_id', 'id');
	}
}
