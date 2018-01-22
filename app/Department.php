<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
	protected $primaryKey = 'id';
	protected $fillable = ['name', 'abbreviation'];
	public $timestamps = false;

	public function rules(){
		return array(
			'Name' => 'required|max:200',
			'Abbreviation' => 'max:200'
		);
	}

	public function updateRules(){
		$code = $this->code;
		return array(
			'Name' => 'required|max:200',
			'Abbreviation' => 'max:200'
		);
	}
}
