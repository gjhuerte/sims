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
    	'supplier_id',
        'purchaseorder_id',
        'invoice_date'
    ];

    protected $appends = [
        'parsed_date_delivered', 'purchaseorder_number', 'supplier_name', 'invoice_code', 'parsed_invoice_date', 'receipt_date'
    ];

    public function getParsedInvoiceDateAttribute()
    {
        if($this->invoice_date == null || $this->invoice_date == "") return "None";

        return Carbon\Carbon::parse($this->invoice_date)->toFormattedDateString();
    }

    public function getReceiptDateAttribute()
    {
        if($this->date_delivered == null || $this->date_delivered == "") return "None";

        return Carbon\Carbon::parse($this->date_delivered)->toFormattedDateString();
    }

    public function getInvoiceCodeAttribute()
    {
        if($this->invoice == null || $this->invoice == "") return "None";

        return $this->invoice;
    }

    public function getParsedDateDeliveredAttribute($value)
    {
        return Carbon\Carbon::parse($this->date_delivered)->toFormattedDateString();
    }

    public function getPurchaseorderNumberAttribute()
    {
        if(isset($this->purchaseorder) && count($this->purchaseorder) > 0):
            if($this->purchaseorder->number)
                return $this->purchaseorder->number;
        endif;

        return 'None';
    }

    public function getSupplierNameAttribute()
    {
        if(isset($this->supplier) && count($this->supplier) > 0):
            if($this->supplier->name)
                return $this->supplier->name;
        endif;

        return 'None';
    }

    public function getInvoiceAttribute()
    {
        if(!$this->attributes['invoice']) return 'Not Set';

        return $this->attributes['invoice'];
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

    public function purchaseorder()
    {
        return $this->belongsto('App\PurchaseOrder', 'purchaseorder_id', 'id');
    }

    public function setReceivedByAttribute($value)
    {
    	$this->received_by = Auth::user()->id;
    }

    public function scopeFindByNumber($query, $value)
    {
        return $query->where('number', '=', $value)->first();
    }
}
