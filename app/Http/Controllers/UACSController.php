<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DB;
use Carbon;

class UACSController extends Controller
{
    public function getIndex(Request $request)
    {

    	$uacs_codes = App\Category::pluck('uacs_code');

    	return view('uacs.index')
    			->with('uacs_codes', $uacs_codes);
    }

    public function getAllMonths(Request $request)
    {
        if($request->ajax())
        {
            $months = App\UACS::groupBy( 'fundcluster_code', 'uacs_code' )->select('date_received', 'uacs_code', 'fundcluster_code', DB::raw('avg(receipt_unitcost) as receipt_unitcost'),  DB::raw('avg(receipt_quantity) as receipt_quantity'))->get()->groupBy('month');

            return json_encode([
                'data' => $months
            ]);
        }
    }

    public function getUACS(Request $request, $date)
    {

        if($request->ajax())
        {
            $date = $this->convertDateToCarbon($date);
            $uacs_codes = App\Category::pluck('uacs_code');
            $fundcluster = App\FundCluster::pluck('code');

            $uacs = array();
            $category = array();

            foreach($fundcluster as $fundcluster_code)
            {
                foreach($uacs_codes as $uacs_code)
                {
                   $category[ $uacs_code ] = count($query = App\UACS::groupBy('uacs_code')
                        ->where('fundcluster_code', '=', $fundcluster_code)
                        ->where('uacs_code', '=', $uacs_code)
                        ->filterByMonth($date)
                        ->select('uacs_code', DB::raw('(avg(receipt_unitcost)  * avg(receipt_quantity)) as total'))
                        ->first()) > 0 ?  $query :  [ 'total' => 0, 'uacs_code' => 'None' ] ;

                }

                array_push($uacs, [ 'fundcluster_code' => $fundcluster_code ] + $category );
                $category = array();
            }

            return datatables($uacs)->toJson();
        }
    }
}

// App\UACS::groupBy( 'fundcluster_code', 'uacs_code' )->select('date_received', 'uacs_code', 'fundcluster_code', DB::raw('avg(receipt_unitcost) as receipt_unitcost'),  DB::raw('avg(receipt_quantity) as receipt_quantity'))->get()->groupBy('month')->toJson()
