<?php
namespace App;

use Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;
class ClientFeedback extends Model{

	protected $table = 'clientfeedbacks';
	protected $primaryKey = 'id';
	protected $fillable = [
		'user',
		'type',
		'comment'
	];
	public $timestamps = true;

	public function rules(){
		return array(
			'Comment' => 'required'
		);
	}
	}

