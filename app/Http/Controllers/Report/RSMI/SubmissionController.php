<?php

namespace App\Http\Controllers\Report\RSMI;

use Illuminate\Http\Request;
use App\Jobs\Request\SubmitReport;
use App\Http\Controllers\Controller;

class SubmissionController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
    	$rsmi = RSMI::findOrFail($id);

    	if($request->ajax()) {
    		$stocks = $rsmi->stocks;
    		return datatables($stocks)->toJson();
    	}

    	return view('rsmi.show', compact('rsmi'));
    }

    /**
     * Submit the generated RSMI to the assets 
     * management office 
     * 
     * @param  Request $request 
     * @param  int  $id      
     * @return object           
     */
    public function submit(Request $request, $id)
    {
        $this->dispatch(new SubmitReport($id));
        return back();
    }
}
