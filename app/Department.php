<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
class Department extends Model
{
    protected $table = 'departments';
	protected $primaryKey = 'id';
	protected $fillable = ['name', 'abbreviation' , 'office_id'];
	public $timestamps = false;

	public function rules(){
		return array(
			'Name' => 'required|max:200',
			'Abbreviation' => 'max:200'
		);
	}

	public function updateRules(){
		return array(
			'Name' => 'required|max:200',
			'Abbreviation' => 'max:200'
		);
	}

	public function offices()
    {
        return $this->belongsTo('App\Office', 'office_id', 'id');
    } 
}
