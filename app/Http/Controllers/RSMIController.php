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
    
    public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$rsmi = new App\RSMI;

    		if(Auth::user()->access != 1) $rsmi = $rsmi->filterByStatus(['S', 'R', 'C', 'E']);

    		return datatables($rsmi->orderBy('id','desc')->get())->toJson();
    	}

        $months =  App\StockCard::filterByIssued()
        			->select('date')
        			->get()
                 	->pluck('parsed_month')
                 	->unique();

    	return view('rsmi.index')
    			->with('months', $months);
    }

    public function store(Request $request)
    {
    	$month = Carbon\Carbon::parse($this->sanitizeString($request->get('month')));

    	$id = App\StockCard::filterByIssued()->filterByMonth($month)->select('id')->pluck('id');

    	DB::beginTransaction();

    	$rsmi = new App\RSMI;
    	$rsmi->status = 'P';
    	$rsmi->report_date = $month;
    	$rsmi->user_id = Auth::user()->id;
    	$rsmi->save();

    	$rsmi->stockcards()->sync($id);

    	DB::commit();

    	\Alert::success('Report Generated')->flash();
    	return redirect("rsmi/$rsmi->id");
    }

    public function show(Request $request, $id)
    {
    	$id = $this->sanitizeString($id);
    	$rsmi = App\RSMI::find($id);

    	if($request->ajax())
    	{
    		$stockcards = $rsmi->stockcards;
    		return datatables($stockcards)->toJson();
    	}

    	return view('rsmi.show')
    			->with('rsmi', $rsmi);
    }


	// public function getRecapitulation(Request $request, $date)
	// {
	// 	if($request->ajax())
	// 	{
	// 		$date = $this->convertDateToCarbon($date);

	// 		$report = App\RSMI::filterByMonth($date)
	// 							->groupBy('stocknumber','issued_quantity','details','cost')
	// 							->select('stocknumber',DB::raw("sum(issued_quantity) as issued_quantity"),'details',DB::raw("avg(cost) as cost"))
	// 							->get();

	// 		return datatables($report)->toJson();		
	// 	}
	// }

	// public function getIssued(Request $request, $date)
	// {
	// 	if($request->ajax())
	// 	{
	// 		$date = $this->convertDateToCarbon($date);

	// 		$report = App\RSMI::filterByMonth($date)->get();
			
	// 		return datatables($report)->toJson();
	// 	}
	// }

	// public function getAllMonths(Request $request)
	// {
	// 	if($request->ajax())
	// 	{
	// 		$months =  App\RSMI::select('date')
	// 					->orderBy('date','desc')
	// 					->get()
	// 					->groupBy('month');

	// 		return json_encode([
	// 			'data' => $months
	// 		]);
	// 	}
	// }

	// public function print($date)
	// {

	// 	$date = $this->convertDateToCarbon($date);

	// 	$ris = App\RSMI::filterByMonth($date);

 //        $recapitulation = App\RSMI::filterByMonth($date)
	// 							->groupBy('stocknumber','issued_quantity','details','cost')
	// 							->select('stocknumber',DB::raw("sum(issued_quantity) as issued_quantity"),'details',DB::raw("avg(cost) as cost"))
	// 							->get();


	// 	$ris = $ris->orderBy('date')->orderBy('id')->orderBy('created_at')->get();
	// 	$start = $ris->pluck('reference')->first();
	// 	$end = $ris->pluck('reference')->last();

 //        $data = [
 //            'ris' => $ris,
 //            'recapitulation' => $recapitulation,
 //            'start' => $start,
 //            'end' => $end
 //        ];

 //        $filename = "RSMI-".Carbon\Carbon::parse($date)->format('mdYHm').".pdf";
 //        $view = "report.rsmi.print_index";

 //        return $this->printPreview($view,$data,$filename);
	// }
}
