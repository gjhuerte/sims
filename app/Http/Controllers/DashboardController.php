<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
    	$purchaseorder_count = App\PurchaseOrder::count();
    	$receipt_count = App\Receipt::count();
    	$supply_count = App\Supply::count();
    	$ris_count = App\StockCard::filterByIssued()->count();
    	$recent_supplies = App\StockCard::filterByReceived()->take(5)->orderBy('created_at','desc')->get();
    	$released_count = App\RSMI::select(DB::raw('sum(issued) as issued'),'date')->groupBy('date',DB::raw('YEAR(date)'),DB::raw('MONTH(date)'))->get();
    	$total = App\StockCard::filterByIssued()->select(DB::raw('sum(issued) as total'))->pluck('total')->first();
    	$most_request = App\StockCard::filterByIssued()->select(DB::raw('sum(issued) as total'),'stocknumber')->groupBy('stocknumber')->first();
    	$request_office = App\StockCard::filterByIssued()->select(DB::raw('sum(issued) as total'),'organization')->groupBy('organization')->orderBy('total','desc')->first();
    	$received = App\StockCard::filterByReceived()->take(5)->orderBy('date','desc')->orderBy('created_at','desc')->get();

    	return view('dashboard.index')
    			->with('purchaseorder_count',$purchaseorder_count)
    			->with('receipt_count',$receipt_count)
    			->with('supply_count',$supply_count)
    			->with('ris_count',$ris_count)
    			->with('recent_supplies',$recent_supplies)
    			->with('released_count',$released_count)
    			->with('total',$total)
    			->with('most_request', $most_request)
    			->with('request_office',$request_office)
    			->with('received',$received);
    }
}