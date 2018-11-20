<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
class RSMIView extends Model
{
 	protected $table = 'rsmi_view';
	protected $primaryKey = null;
	public $incrementing = true;
	public $timestamps = true;

	public function scopeMonth($query,$month)
	{
		if($month == 'undefined')
			$month = Carbon::now();
		else{
			$month = Carbon::parse($month);
		}

		$query->whereBetween('date',array($month->startOfMonth()->toDateString(),$month->endOfMonth()->toDateString()));
	}

	public static function getAllMonths()
	{
		return RSMIView::select(
					DB::raw("concat_ws(' ',YEAR(date),MONTH(date)) as year")
				)
				->groupBy(
					DB::raw("concat_ws(YEAR(date),MONTH(date))"),
					DB::raw("MONTH(date)"),
					'date'
				)
				->orderBy('date','desc')
				->distinct()
				->pluck('year');	
	}
}
