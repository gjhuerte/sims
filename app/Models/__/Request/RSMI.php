<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
use Auth;
use DB;

class RSMI extends Model
{
    protected $table = "rsmi";
    protected $primary = 'id';

    protected $dates = [
    	'report_date'
    ];

    public $appends = [
        'created_by', 'parsed_report_date', 'status_name', 'parsed_month', 'parsed_unitcost'
    ];

    public $status_list = [
        'P' => 'Pending',
        'S' => 'Submitted',
        'R' => 'Received',
        'E' => 'Returned',
        'C' => 'Cancelled',
        'AP' => 'Applied To Ledger Card'    
    ];


    public function getParsedUnitcostAttribute($value)
    {
        $ret_val = 'N/A';

        if(count($this->pivot) > 0) $ret_val = $this->pivot->issued_unitcost;

        return $ret_val;
    }

    public function getMonthAttribute($value)
    {
        $date = Carbon\Carbon::parse($this->report_date);
        return $date->month . ' ' . $date->year;
    }

    public function getParsedMonthAttribute($value)
    {
        $date = Carbon\Carbon::parse($this->report_date);
        return $date->format('M Y');
    }

    public function getStatusNameAttribute($value)
    {
        $ret_val = 'Not Set';

        if(array_key_exists($this->status, $this->status_list))
        {
            $ret_val = $this->status_list[$this->status];
        }

        return $ret_val;
    }

    public function scopeFilterByStatus($query, $value)
    {
        is_array($value) ? $query->whereIn('status', $value) : $query->where('status', '=', $value);
    }

    public function getParsedReportDateAttribute($value)
    {
        return Carbon\Carbon::parse($this->report_date)->toDayDateTimeString();
    }

    public function getCreatedByAttribute($value)
    {
        $user = isset($this->user) ? $this->user : null;

        return (count($user) > 0) ? $user->firstname  . ' ' .  $user->lastname : null;
    }

    public function stockcards()
    {
        return $this->belongsToMany('App\StockCard', 'rsmi_stockcard', 'rsmi_id', 'stockcard_id')
                ->withPivot('ledgercard_id', 'unitcost', 'uacs_code')
                ->withTimestamps();
    }

    public function ledgercards()
    {
        return $this->belongsToMany('App\LedgerCard', 'rsmi_stockcard', 'rsmi_id', 'ledgercard_id')
                ->withPivot('stockcard_id')
                ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
