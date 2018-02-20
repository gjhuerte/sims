<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;
use Carbon;
use DB;
use Validator;

class InspectionController extends Controller
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
            $inspection = App\Inspection::all();
            return datatables($inspection)->toJson();
        }

        return view('inspection.index')
                ->with('title', 'Inspection');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInitialVerifyForm()
    {
        return view('inspection.initial')
                ->with('title', 'Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = $this->sanitizeString($id);

        if(Auth::user()->access != 3 || Auth::user()->access != 4)
        {
            \Alert::error('You do not have enough priviledge to access this page.')->flash();
            return back();   
        }
        $inspection = App\Inspection::with('supplies')->find($id);
        return view('inspection.approval')
                    ->with('inspection', $inspection);
    }

    public function approval(Request $request, $id)
    {
        $id = $this->sanitizeString($id);
        $stocknumbers = $request->get("stocknumber");
        $quantity = $request->get("quantity");
        $received = $request->get("received");
        $remarks = $request->get("remarks");
        $action = $request->get("action");

        DB::beginTransaction();

        $inspection = App\Inspection::find($id);

        /**
         * check what actions the user has made to the inspection
         */
        if($action == 'passed'):
            $action = 'passed';
        elseif($action == 'failed'):
            $action = 'failed';
        else:
            $action = 'Pending';
        endif;

        /**
         * assign the status whether it is first or second inspection
         */
        $inspection->status = ($action == 'failed' || $action == null || $action == 'Pending') ? $action : ($inspection->status == null) ? '1st Inspection' : '2nd Inspection';

        $inspection->save();

        /**
         * loops through each record
         * update the record in the database
         */
        foreach($stocknumbers as $stocknumber)
        {
             
            $_quantity = $quantity["$stocknumber"];
            $supply = App\Supply::findByStockNumber($stocknumber)->first();

            if($inspection->status == '2nd Inspection')
            {
                $inspection->supplies()->updateExistingPivot( $supply->id, [
                    'quantity_final' => $_quantity
                ]);
            }else{
                $inspection->supplies()->updateExistingPivot( $supply->id, [
                    'quantity_adjusted' => $_quantity
                ]);
            }
        }

        DB::commit();

        \Alert::success("Inspection " . ucfirst($action))->flash();
        return redirect('inspection');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        //
    }
}
