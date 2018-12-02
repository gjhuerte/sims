<?php

namespace App\Http\Controllers\Report\RSMI;

use App\Models\Request\RSMI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Inventory\Supply\Stock;
use App\Jobs\Request\GenerateNewReport;

class GenerationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
    	if($request->ajax()) {
    		$report = new RSMI;

    		if(Auth::user()->access != 1) {
                $report = $report->filterByStatus(['S', 'R', 'C', 'E', 'AP']);
            }

    		return datatables($report->orderBy('id', 'desc')->get())->toJson();
    	}

        $months =  Stock::issued()->select('date')->get()->pluck('parsed_month')->unique();
    	return view('rsmi.index', compact('months'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->dispatch(new GenerateNewReport($request->all()));
    	return redirect('rsmi/' . $rsmi->id);
    }
}
