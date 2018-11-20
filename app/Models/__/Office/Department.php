<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
class Department extends Model
{
    protected $table = 'offices';
	protected $primaryKey = 'id';
	protected $fillable = ['name', 'abbreviation' , 'office_id'];
	public $timestamps = false;

	public function rules(){
		return array(
			'Name' => 'required|max:200',
			'Head' => 'max:100',
			'Designation' => 'max:100',
			'Abbreviation' => 'max:20'
		);
	}

	public function updateRules(){
		return array(
			'Name' => 'required|max:200',
			'Head' => '',
			'Designation' => '',
			'Abbreviation' => 'max:200'
		);
	}

	public function office()
    {
        return $this->belongsTo('App\Office', 'office_id', 'id');
    } 
}
