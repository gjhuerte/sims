<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptSupply extends Model
{
    protected $table = 'receipts_supplies';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function supply()
    {
    	return $this->belongsTo('App\Supply','stocknumber','stocknumber');
    }
}
