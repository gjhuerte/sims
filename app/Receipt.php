<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon;

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
    	'supplier_id'
    ];

    protected $appends = [
        'parsed_date_delivered'
    ];

    public function getParsedDateDeliveredAttribute($value)
    {
        return Carbon\Carbon::parse($this->date_delivered)->toFormattedDateString();
    }

    public function supplies()
    {
        return $this->belongsToMany('App\Supply', 'receipts_supplies', 'receipt_id', 'supply_id')
            ->withPivot('quantity', 'remaining_quantity', 'unitcost')
            ->withTimestamps();
    } 

    public function supplier()
    {
      return $this->belongsTo('App\Supplier','supplier_id','id');
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
