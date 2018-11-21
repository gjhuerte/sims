<?php

namespace App;

use App\Models\User\User;
use App\Models\Inventory\Supply\Stock;
use App\Models\Inventory\Supply\Ledger;
use Illuminate\Database\Eloquent\Model;

class RSMI extends Model
{
    protected $table = "rsmi";
    protected $primary = 'id';

    /**
     * The dates attribute for the table
     * The following array will set the items
     * inside as date
     *
     * @var array
     */
    protected $dates = [
    	'report_date'
    ];

    /**
     * Additional columns when fetching records
     * These columns are automatically added when
     * the model is initialized
     *
     * @var array
     */
    public $appends = [
        'created_by', 'parsed_report_date', 'status_name', 'parsed_month', 'parsed_unitcost'
    ];

    /**
     * List of all the status for the table
     *
     * @var array
     */
    public $status_list = [
        'P' => 'Pending',
        'S' => 'Submitted',
        'R' => 'Received',
        'E' => 'Returned',
        'C' => 'Cancelled',
        'AP' => 'Applied To Ledger Card'    
    ];

    /**
     * Fetch the unit cost for the report
     *
     * @return void
     */
    public function getParsedUnitcostAttribute()
    {
        return isset($this->pivot) ? $this->pivot->issued_unitcost : config('app.data_not_set');
    }

    /**
     * Fetch the month and year of the report date
     *
     * @return object
     */
    public function getMonthAttribute()
    {
        $date = Carbon::parse($this->report_date);
        return $date->month . ' ' . $date->year;
    }

    /**
     * Fetch the month and year of the report date
     *
     * @return object
     */
    public function getParsedMonthAttribute()
    {
        $date = Carbon\Carbon::parse($this->report_date);
        return $date->format('M Y');
    }

    /**
     * Returns the status name for the report if exists else
     * returns the default config
     *
     * @return object
     */
    public function getStatusNameAttribute()
    {
        return isset($this->status_list[$this->status]) ? $this->status_list[$this->status] : config('app.data_not_set');
    }

    /**
     * Filters the query by status
     * if the argument passed is array
     * use where in else use where
     *
     * @param Builder $query
     * @param string|array $value
     * @return object
     */
    public function scopeStatus($query, $value)
    {
        if(is_array($value)) {
            return $query->whereIn('status', $value);
        }

        return $query->where('status', '=', $value);
    }

    /**
     * Returns the parsed date when the report was created
     *
     * @return string
     */
    public function getParsedReportDateAttribute()
    {
        return Carbon::parse($this->report_date)->toDayDateTimeString();
    }

    /**
     * Fetch the full name of the creator of instance of the record
     *
     * @return string
     */
    public function getCreatedByAttribute()
    {
        return $this->user->full_name;
    }

    /**
     * Links to the stocks model
     *
     * @return object
     */
    public function stocks()
    {
        return $this->belongsToMany(Stock::class, 'rsmi_stockcard', 'rsmi_id', 'stockcard_id')
                ->withPivot('ledgercard_id', 'unitcost', 'uacs_code')
                ->withTimestamps();
    }

    /**
     * Links to the ledgers model
     *
     * @return object
     */
    public function ledgers()
    {
        return $this->belongsToMany(Ledger::class, 'rsmi_stockcard', 'rsmi_id', 'ledgercard_id')
                ->withPivot('stockcard_id')
                ->withTimestamps();
    }

    /**
     * Links to the users model
     *
     * @return object
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
