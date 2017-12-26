<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DB;

class UACSController extends Controller
{
    public function getIndex(Request $request)
    {

    	if($request->ajax())
    	{
			return datatables( App\UACS::groupBy('date_received', 'uacs_code', 'fundcluster_code')->select('date_received', 'fundcluster_code', DB::raw("avg(purchaseorder_unitcost) as unitcost"))->get() )->toJson();
    	}

    	$uacs_codes = App\Category::pluck('uacs_code');

    	return view('uacs.index')
    			->with('uacs_codes', $uacs_codes);
    }
}
