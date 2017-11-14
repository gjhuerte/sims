<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestSupply extends Model
{
    protected $table = 'requests_supplies';
    protected $primaryKey = 'id';
    protected $fillable = [ 'stocknumber', 'quantity_requested','quantity_issued','comments' ];
    public $timestamps = true;

    public function supply()
    {
      return $this->belongsTo('App\Supply','stocknumber','stocknumber');
    }

    public function request()
    {
      return $this->belongsTo('App\Request','request_id','id');
    }

}
