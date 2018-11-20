<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
use DB;

class RISList extends Model
{
    protected $table = "ris_list";
    protected $date = ['created_at','approved_at','released_at'];

}
