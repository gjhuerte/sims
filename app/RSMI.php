<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class RSMI extends Model
{
    protected $table = "rsmi_v";
    protected $dates = [
    	'dates'
    ];

    public $appends = [
    	'month'
    ];	

    public function getMonthAttribute($value)
    {
    	$date = Carbon\Carbon::parse($this->date);
    	return $date->month . " " . $date->year;
    }

	public function scopeFilterByMonth($query, $date)
	{

		return $query->whereBetween('date',[
					$date->startOfMonth()->toDateString(),
					$date->endOfMonth()->toDateString()
				]);
	}
}
