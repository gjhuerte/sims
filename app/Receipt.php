<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Receipt extends Model
{
    protected $table = 'receipts';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
    	'reference',
    	'number',
    	'invoice',
    	'date_delivered',
    	'received_by',
    	'supplier_name'
    ];

    public function supplier()
    {
      return $this->belongsTo('App\Supplier','supplier_name','name');
    }

    public function setReceivedByAttribute($value)
    {
    	$this->received_by = Auth::user()->id;
    }

    public function scopeFindByNumber($query, $value)
    {
        return $query->where('number','=',$value)->first();
    }
}
