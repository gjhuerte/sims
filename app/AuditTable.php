<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditTable extends Model
{
    protected $table = 'audittable';

	public $timestamps = false;
}
