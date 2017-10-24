<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
class Office extends Model{

	protected $table = 'office';


	protected $fillable = ['deptcode','deptname'];
	protected $primaryKey = 'deptcode';
	public $incrementing = false;
	public $timestamps = false;

	public static $rules = array(
		'Department Code' => 'required|max:20',
		'Department Name' => 'required|max:200'
	);

	public static $updateRules = array(
		'Department Code' => 'required|max:20',
		'Department Name' => 'required|max:200'
	);

	public function scopeCode($query,$value)
	{
		return $query->where('deptcode','=',$value);
	}

}
