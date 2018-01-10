<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class UACS extends Model
{
    protected $table = "uacs_v";
    protected $dates = [
    	'date_received', 'month'
    ];

    public $appends = [
    	'month'
    ];	

    public function getMonthAttribute($value)
    {
    	$date = Carbon\Carbon::parse($this->date_received);
    	return $date->month . " " . $date->year;
    }

    public function scopeFilterByMonth($query, $date)
    {

        return $query->whereBetween('date_received',[
                    $date->startOfMonth()->toDateString(),
                    $date->endOfMonth()->toDateString()
                ]);
    }
}