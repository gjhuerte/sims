<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class Unit extends Model{

	protected $table = 'units';
	protected $primaryKey = 'id';

	public $timestamps = false;

	protected $fillable = ['name','description'];
	public static $rules = array(
		'Name' => 'required|unique:units,name',
		'Description' => '',
		'Abbreviation' => 'required|unique:units,abbreviation'
	);

	public function updateRules(){
		$name = $this->name;
		return  array(
			'Name' => 'required|unique:units,name,'.$name.',name',
			'Description' => '',
			'Abbreviation' => 'required'
		);
	}
}
