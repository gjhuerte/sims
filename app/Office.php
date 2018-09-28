<?php
namespace App;

use Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;
class Office extends Model{

	protected $table = 'offices';
	protected $primaryKey = 'id';
	protected $fillable = [
		'code',
		'name',
		'description', 
		'head',
		'head_title',
		'head_office'
	];
	public $timestamps = true;

	public function rules(){
		return array(
			'Code' => 'required|max:20|unique:offices,code',
			'Name' => 'required|max:200',
			'Description' => 'max:200'
		);
	}

	public function updateRules(){
		$code = $this->code;
		return array(
			'Code' => 'required|max:20|unique:offices,code,'.$code.',code',
			'Name' => 'required|max:200',
			'Description' => 'max:200'
		);
	}

	public $appends = [
		'office_head'
	];

	public function getHeadTitleAttribute($value)
	{
		if($value == null || $value == '' ) return 'None';

		return $value;
	}

	public function getHeadAttribute($value)
	{
		if($value == null || $value == '' ) return 'None';
		return $value;
	}

	public function getOfficeHeadAttribute()
	{
		if($this->head == null || $this->head == '' ) return 'None';

		return $this->head;
	}

	public function scopeFindByCode($query,$value)
	{
		return $query->where('code', '=', $value)->first();
	}

	public function scopeCode($query,$value)
	{
		return $query->where('code','=',$value);
	}

	public function departments()
	{
		return $this->hasMany('App\Office', 'head_office', 'id');
	}

	public function request()
	{
		return $this->hasMany('App\Request', 'office_id', 'id');
	}
	public function HeadOffice()
	{
		return $this->belongsTo('App\Office', 'head_office', 'id');
	}
}
