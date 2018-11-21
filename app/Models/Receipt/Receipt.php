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

    /**
     * List of columns in the database that
     * can be filled using the create method
     * of the model
     *
     * @var array
     */
    protected $fillable = [
    	'reference', 'number', 'invoice', 'date_delivered', 'received_by', 'supplier_id', 'purchaseorder_id', 'invoice_date'
    ];

    /**
     * Additional columns when fetching records
     * These columns are automatically added when
     * the model is initialized
     *
     * @var array
     */
    protected $appends = [
        'parsed_date_delivered', 'purchaseorder_number', 'supplier_name', 'invoice_code', 'parsed_invoice_date', 'receipt_date'
    ];

    /**
     * Parse the invoice date
     *
     * @return object
     */
    public function getParsedInvoiceDateAttribute()
    {
        return isset($this->invoice_date) ? Carbon::parse($this->invoice_date)->toFormattedDateString() : config('app.data_not_set');
    }

    /**
     * Parse the date delivered
     *
     * @return object
     */
    public function getReceiptDateAttribute()
    {
        return isset($this->date_delivered) ? Carbon::parse($this->date_delivered)->toFormattedDateString() : config('app.data_not_set');
    }

    /**
     * Checks if the invoice code is set
     * Use the not set configuration if
     * the invoice is not set
     *
     * @return object
     */
    public function getInvoiceCodeAttribute()
    {
        return isset($this->invoice) ? $this->invoice : config('app.data_not_set');
    }

    /**
     * Parse the date delivered
     *
     * @return object
     */
    public function getParsedDateDeliveredAttribute($value)
    {
        return Carbon::parse($this->date_delivered)->toFormattedDateString();
    }

    /**
     * Fetch the purchase order for the receipt
     *
     * @return object
     */
    public function getPurchaseorderNumberAttribute()
    {
        return isset($this->purchaseorder) ? $this->purchaseorder->number : config('app.data_not_set');
    }

    /**
     * Fetch the supplier name for this receipt
     *
     * @return object
     */
    public function getSupplierNameAttribute()
    {
        return isset($this->supplier) ? $this->supplier->name : config('app.data_not_set');
    }

    /**
     * Fetch the invoice code for the receipt
     *
     * @return object
     */
    public function getInvoiceAttribute()
    {
        return isset($this->invoice) ? $this->invoice : config('app.data_not_set');
    }

    /**
     * Filters the query by receipt number
     *
     * @param Builder $query
     * @param string $value
     * @return object
     */
    public function scopeNumber($query, string $value)
    {
        return $query->where('number', '=', $value);
    }

    /**
     * Links to the supplies the receipt has
     *
     * @return object
     */
    public function supplies()
    {
        return $this->belongsToMany(
            Supply::class, 'receipts_supplies', 'receipt_id', 'supply_id'
        )->withPivot('quantity', 'remaining_quantity', 'unitcost')->withTimestamps();
    } 

    /**
     * Links to the supplier for the receipt
     *
     * @return object
     */
    public function supplier()
    {
      return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    /**
     * Links to the purchase order the receipt have
     *
     * @return object
     */
    public function purchaseorder()
    {
        return $this->belongsto(PurchaseOrder::class, 'purchaseorder_id', 'id');
    }
}
