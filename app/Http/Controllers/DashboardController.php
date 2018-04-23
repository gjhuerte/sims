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
            $purchaseorder = App\PurchaseOrder::all();
            $receipt_count = App\Receipt::count();
            $supply_count = App\Supply::count();
            $recent_supplies = App\StockCard::filterByReceived()->take(5)->orderBy('created_at','desc')->get();
            $released_count = App\Request::Released()
                                ->select(DB::raw('DATE_FORMAT("released_at", "%M %d %Y") AS released_at'))
                                ->groupBy('released_at')
                                ->get();
                                /*DB::table('stockcards')
                                ->select(DB::raw('sum(issued_quantity) as issued, MONTH(date) as month, YEAR(date) as year'))
                                ->where('issued_quantity', '>', '0')
                                ->whereBetween('date',[
                                    Carbon\Carbon::now()->startOfMonth()->toDateString(),
                                    Carbon\Carbon::now()->endOfMonth()->toDateString()])
                                ->groupBy( DB::raw('MONTH(date)'), DB::raw('YEAR(date)'))
                                ->get();*/
            /**
             * fetch from stockcard
             * @var [stockcard]
             */
            $ris_count = App\Request::all()
                                ->count();
            $total = App\StockCard::filterByIssued()
                                ->select(DB::raw('sum(issued_quantity) as total'))
                                ->pluck('total')
                                ->first();
            $most_request = App\Stockcard::filterByIssued()
                                ->select(DB::raw('sum(issued_quantity) as total'),'supply_id')
                                ->groupBy('supply_id')
                                ->first();
            $request_office = App\StockCard::filterByIssued()
                                ->select(DB::raw('sum(issued_quantity) as total'),'organization')
                                ->groupBy('organization')
                                ->orderBy('total','desc')->first();
            $received = App\StockCard::filterByReceived()
                                ->take(5)
                                ->orderBy('date','desc')
                                ->orderBy('created_at','desc')
                                ->get();
            $office = App\Office::withCount('request')
                                ->orderBy('request_count','desc')
                                ->get();
            return view('dashboard.index')
                    ->with('purchaseorder',$purchaseorder)
                    ->with('receipt_count',$receipt_count)
                    ->with('supply_count',$supply_count)
                    ->with('ris_count',$ris_count)
                    ->with('recent_supplies',$recent_supplies)
                    ->with('released_count',$released_count)
                    ->with('total',$total)
                    ->with('most_request', $most_request)
                    ->with('request_office',$request_office)
                    ->with('office',$office)
                    ->with('received',$received);
        }
        else
        {
            return $dashboard->showDashboard($request);
        }
    }
}