<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
class Office extends Model{

	protected $table = 'offices';
	protected $primaryKey = 'id';
	protected $fillable = ['code','name','description', 'head'];
	public $timestamps = false;

	public static $rules = array(
		'Code' => 'required|max:20',
		'Name' => 'required|max:200',
		'Description' => 'max:200'
	);

	public static $updateRules = array(
		'Code' => 'required|max:20',
		'Name' => 'required|max:200',
		'Description' => 'max:200'
	);

	public function scopeFindByCode($query,$value)
	{
		return $query->where('code','=',$value)->first();
	}

	public function scopeCode($query,$value)
	{
		return $query->where('code','=',$value);
	}

}
