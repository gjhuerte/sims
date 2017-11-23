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

			$report = App\RSMI::filterByMonth($date)->get();

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

	// public function rsmiPerMonth(Request $request, $month)
	// {
	// 	if($request->ajax())
	// 	{
	// 		return json_encode([
	// 			'data' => RSMIView::month($month)->get()
	// 		]);
	// 	}
	// }

	// public function rsmiByStockNumber(Request $request, $month)
	// {
	// 	if($request->ajax())
	// 	{	
	// 		return json_encode([
	// 			'data' => RSMIView::month($month)
	// 						->groupBy('stocknumber','supplytype','unitprice')
	// 						->select(
	// 									'stocknumber',
	// 									DB::raw('sum(issuequantity) as issuequantity'),
	// 									'supplytype',
	// 									'unitprice'
	// 								)
	// 						->get()
	// 		]);
	// 	}
	// }

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
}
