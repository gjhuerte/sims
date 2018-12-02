<?php

namespace App\Http\Controllers\Report\RSMI;

use Illuminate\Http\Request;
use App\Jobs\Request\ApplyToLedger;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{

    /**
     * Apply the generated RSMI to the 
     * ledger
     * 
     * @param  Request $request 
     * @param  int  $id      
     * @return Response           
     */
    public function apply(Request $request, $id)
    {
        $this->dispatch(new ApplyToLedger($id));
        return redirect("rsmi/$rsmi->id");
    }
}
