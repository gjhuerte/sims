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
        $id = $this->sanitizeString($id);
        $fundcluster = App\FundCluster::find($id);

		if($request->ajax())
		{
            $purchaseorders = App\PurchaseOrder::with('supplier')->whereHas('fundclusters', function($query) use($id){
                $query->where('id', '=', $id);
            })->get();
			return datatables($purchaseorders)->toJson();
		}

		return view('fundcluster.show')
				->with('fundcluster',$fundcluster);
    }

    public function edit(Request $request, $id)
    {
        $fundcluster = App\FundCluster::find($id);

        return view('fundcluster.edit')
                ->with('fundcluster', $fundcluster);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $code = Input::get('code');
        $description = $this->sanitizeString(Input::get('description'));

        $fundcluster = App\FundCluster::find($id);
        
        $validator = Validator::make([
            'Code' => $code,
            'Description' => $description
        ], $fundcluster->updateRules());

        if($validator->fails())
        {
            DB::rollback();
            return redirect('fundcluster/create')
                    ->withInput()
                    ->withErrors($validator);
        }

        DB::beginTransaction();
        $fundcluster->code = $code;
        $fundcluster->description = $description;
        $fundcluster->save();

        DB::commit();

        \Alert::success('Operation Successful')->flash();
        return view('fundcluster.index');
    }

    public function destroy(Request $request, $id)
    {
        $id = $this->sanitizeString($id);
        $fundcluster = App\FundCluster::find($id);
        $fundcluster->delete();

        if($request->ajax())
        {
            return json_encode('success');
        }

        \Alert::success('Fund Cluster removed')->flash();
        return redirect('fundcluster');

    }
}
