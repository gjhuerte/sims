<?php

namespace App\Http\Controllers;

use Validator;
use Carbon;
use Session;
use Auth;
use DB;
use App;
use Illuminate\Http\Request;

class RSMIController extends Controller
{
    
    public function index()
    {
    	return view('report.rsmi.index');
    }


	public function getRecapitulation(Request $request, $date)
	{
		if($request->ajax())
		{
			$date = $this->convertDateToCarbon($date);

			$report = App\RSMI::filterByMonth($date)
								->groupBy('stocknumber','issued','details','cost')
								->select('stocknumber',DB::raw("sum(issued) as issued"),'details',DB::raw("avg(cost) as cost"))
								->get();

			return json_encode([
				'data' => $report
			]);
		}
	}

	public function getIssued(Request $request, $date)
	{
		if($request->ajax())
		{
			$date = $this->convertDateToCarbon($date);

			$report = App\RSMI::filterByMonth($date)->get();

			return json_encode([
				'data' => $report
			]);
		}
	}

	public function getAllMonths(Request $request)
	{
		if($request->ajax())
		{
			$months =  App\RSMI::select('date')
						->orderBy('date','desc')
						->get()
						->groupBy('month');
			return json_encode([
				'data' => $months
			]);
		}
	}

	public function print($date)
	{

		$date = Carbon\Carbon::parse($date);

		$ris = App\RSMI::filterByMonth($date)->get();

        $recapitulation = App\RSMI::filterByMonth($date)
								->groupBy('stocknumber','issued','details','cost')
								->select('stocknumber',DB::raw("sum(issued) as issued"),'details',DB::raw("avg(cost) as cost"))
								->get();

        $data = [
            'ris' => $ris,
            'recapitulation' => $recapitulation
        ];

        $filename = "RSMI-".Carbon\Carbon::parse($date)->format('mdYHm').".pdf";
        $view = "report.rsmi.print_index";

        return $this->printPreview($view,$data,$filename);
	}
}
