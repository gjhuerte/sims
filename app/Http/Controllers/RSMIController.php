<?php

namespace App\Http\Controllers;

use Validator;
use Carbon;
use Session;
use Auth;
use DB;
use App\RSMIView;
use App\SupplyTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
class RSMIController extends Controller
{
    

	public function rsmi()
	{
		if(Request::ajax())
		{
			if($month == 'undefined') $month = Carbon\Carbon::now();
			else{
				$month = Carbon\Carbon::parse($month);
			}

			return json_encode([
				'data' => RSMIView::all()
			]);
		}
	}

	public function rsmiPerMonth($month)
	{
		if(Request::ajax())
		{
			return json_encode([
				'data' => RSMIView::month($month)->get()
			]);
		}
	}

	public function rsmiByStockNumber($month)
	{
		if(Request::ajax())
		{	
			return json_encode([
				'data' => RSMIView::month($month)
							->groupBy('stocknumber','supplytype','unitprice')
							->select(
										'stocknumber',
										DB::raw('sum(issuequantity) as issuequantity'),
										'supplytype',
										'unitprice'
									)
							->get()
			]);
		}
	}

	public function getAllMonths()
	{
		if(Request::ajax())
		{
			return json_encode([
				'data' => RSMIView::getAllMonths()
			]);
		}
	}
}
