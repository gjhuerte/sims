<?php

namespace App\Http\Controllers\Audit;

use App\Models\Audit;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class AuditController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Request::ajax()) {
            $audits = Audit::all();
            return datatables($audits)->toJson();
        }

        return view('audit.index');
    }
}
