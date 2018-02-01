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

    public function submit(Request $request, $id)
    {
        $id = $this->sanitizeString($id);
        $rsmi = App\RSMI::find($id);

        if(count($rsmi) <= 0) return view('errors.404');

        $rsmi->status = 'S';
        $rsmi->save();

        \Alert::success('Report Submitted ')->flash();
        return back();
    }

    public function showReceive(Request $request, $id)
    {
        $id = $this->sanitizeString($id);
        $rsmi = App\RSMI::with('stockcards.supply')->find($id);

        if(count($rsmi) <= 0) return view('errors.404');

        if( Auth::user()->access != 2 ) return redirect('/');

        if($request->ajax())
        {
            return datatables($rsmi)->toJson();
        }

        return view('rsmi.receive')
                ->with('rsmi', $rsmi);
    }
    
    public function receive(Request $request, $id)
    {
        $id = $this->sanitizeString($id);

        $rsmi = App\RSMI::find($id);

        $ids = $request->get('id');
        $unitcost = $request->get('unitcost');
        $array = [];

        DB::beginTransaction();

        foreach($ids as $id)
        {
            $array[$id] = [
                'unitcost' => isset($unitcost[$id]) ? (int)$unitcost[$id] : null
            ];
        }

        $rsmi->stockcards()->sync($array);

        $rsmi->status = 'R';
        $rsmi->save();

        DB::commit();

        \Alert::success('Report Received')->flash();
        return redirect('rsmi');

    }

	public function print($id)
	{
    	$id = $this->sanitizeString($id);
    	$rsmi = App\RSMI::with('stockcards.supply.unit')->find($id);

    	$recapitulation = App\RSMI::leftJoin('rsmi_stockcard', 'rsmi.id', '=', 'rsmi_id')
    							->leftJoin('stockcards', 'stockcard_id', '=', 'stockcards.id')
    							->leftJoin('supplies', 'supply_id', '=', 'supplies.id')
    							->where('rsmi.id', '=', $id)
    							->groupBy('supplies.details', 'stocknumber')
    							->select(
    								'stocknumber', 
    								DB::raw('sum(issued_quantity) as issued_quantity'), 
    								DB::raw('avg(unitcost) as unitcost'), 
    								DB::raw('(sum(issued_quantity) * avg(unitcost)) as amount'), 
    								'supplies.details as details'
    							)
    							->orderBy('supplies.stocknumber', 'asc')
    							->get();

    	$data = [
    		'rsmi' => $rsmi,
    		'recapitulation' => $recapitulation
    	];

        $filename = "RSMI-".Carbon\Carbon::parse($rsmi->report_date)->format('mdYHm').".pdf";
        $view = "rsmi.print_index";

        return $this->printPreview($view,$data,$filename);
	}
}
