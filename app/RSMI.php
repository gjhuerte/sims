<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RSMI extends Model
{
 	protected $table = 'rsmi';
	protected $primaryKey = 'id';
	public $incrementing = true;
	public $timestamps = true;
}
