<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DB;
use Auth;
use Carbon;
use App\Services\Dashboard;

class DashboardController extends Controller
{
    public function index(Request $request, Dashboard $dashboard)
    {
        if(Auth::user()->access == 1)
        {
            $purchaseorder_count = App\PurchaseOrder::count();
            $receipt_count = App\Receipt::count();
            $supply_count = App\Supply::count();
            $recent_supplies = App\StockCard::filterByReceived()->take(5)->orderBy('created_at','desc')->get();
            $released_count = DB::table('stockcards')
                                ->select(DB::raw('sum(issued_quantity) as issued'), 'date')
                                ->where('issued_quantity', '>', '0')
                                ->whereBetween('date',[
                                    Carbon\Carbon::now()->startOfMonth()->toDateString(),
                                    Carbon\Carbon::now()->endOfMonth()->toDateString()
                                ])
                                ->groupBy('date', DB::raw('year(date)'), DB::raw('month(date)'))->get();

            /**
             * fetch from stockcard
             * @var [stockcard]
             */
            $ris_count = App\StockCard::filterByIssued()->count();
            $total = App\StockCard::filterByIssued()->select(DB::raw('sum(issued_quantity) as total'))->pluck('total')->first();
            $most_request = App\StockCard::filterByIssued()->select(DB::raw('sum(issued_quantity) as total'),'supply_id')->groupBy('supply_id')->first();
            $request_office = App\StockCard::filterByIssued()->select(DB::raw('sum(issued_quantity) as total'),'organization')->groupBy('organization')
                                ->orderBy('total','desc')->first();
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
        else
        {
            return $dashboard->showDashboard($request);
        }
    }
}