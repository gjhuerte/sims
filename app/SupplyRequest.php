<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplyRequest extends Model
{
    protected $table = 'supply_requests';
    protected $primaryKey = 'id';
    protected $fillable = [ 'stocknumber','request_id', 'quantity_requested','quantity_issued','comments' ];
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
