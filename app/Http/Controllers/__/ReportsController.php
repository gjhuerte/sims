<?php

namespace App\Http\Controllers;

use Validator;
use Carbon;
use Session;
use Auth;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
class ReportsController extends Controller
{

    function fundcluster()
    {
    	return view('report.fundcluster.index');
    }
}
