<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
	protected $table = 'inspections_remarks';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = [
		'title',
		'user_id',
		'description'
	];

	public function insertRules()
	{
		return [
			'title' => 'max:30',
			'description' => 'max:150|required'
		];
	}
}