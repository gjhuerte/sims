<?php

namespace App\Http\Controllers;

use App;
use Validator;
use Carbon;
use Session;
use Auth;
use DB;
use App\SupplyTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class FundClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
		{
			return datatables(App\FundCluster::all())->toJson();
		}
		return view('fundcluster.index')
					->with('title','Fund Cluster');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = App\FundCluster::all();

        return view('fundcluster.create')
                ->with('title','Fund Cluster');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $code = Input::get('code');
        $description = $this->sanitizeString(Input::get('description'));
        
        $validator = Validator::make([
            'Code' => $code,
            'Description' => $description
        ],App\FundCluster::$rules);

        if($validator->fails())
        {
            DB::rollback();
            return redirect('fundcluster/create')
                    ->withInput()
                    ->withErrors($validator);
        }

        DB::beginTransaction();

        $fundcluster = new App\FundCluster;
        $fundcluster->code = $code;
        $fundcluster->description = $description;
        $fundcluster->save();

        DB::commit();

        \Alert::success('Operation Successful')->flash();
        return view('fundcluster.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
		$fund = App\FundCluster::find($id);

		if($request->ajax())
		{
			return datatables(App\PurchaseOrderFundCluster::where("fundcluster_code","=",$fund->code))->toJson();
		}
		return view('fundcluster.show')
				->with('fundcode',$fund->code)
				->with('fund',$id);
    }
}
