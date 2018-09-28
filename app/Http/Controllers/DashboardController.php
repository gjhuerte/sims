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
            $most_requested_stock = DB::table('requests_v')
                                    ->select('details','unit','stocknumber','name',
                                             DB::raw('SUM(quantity_requested) AS total_requested,
                                                      COUNT(quantity_requested) AS total_request,
                                                      AVG(quantity_requested) AS average_item_per_request,
                                                      MAX(quantity_requested) AS highest_quantity_requested
                                                      '))
                                    ->groupBy('stocknumber','details','unit','name')
                                    ->orderBy('total_requested','desc')
                                    ->get();
            $released_count = App\Request::select(DB::raw('DATE_FORMAT(released_at,"%m/%d/%y") AS date_released,COUNT(id) AS count'))
                                ->groupBy(DB::raw('DATE_FORMAT(released_at,"%m/%d/%y")'))
                                ->orderBy('released_at')
                                ->get();
            $request_count = App\Request::select(DB::raw('DATE_FORMAT(created_at,"%m/%d/%y") AS date_released,COUNT(id) AS count'))
                                ->groupBy(DB::raw('DATE_FORMAT(created_at,"%m/%d/%y")'))
                                ->orderBy('date_released')
                                ->get();         
                                          
                                /*DB::table('stockcards')
                                ->select(DB::raw('sum(issued_quantity) as issued, MONTH(date) as month, YEAR(date) as year'))
                                ->where('issued_quantity', '>', '0')
                                ->whereBetween('date',[
                                    Carbon\Carbon::now()->startOfMonth()->toDateString(),
                                    Carbon\Carbon::now()->endOfMonth()->toDateString()])
                                ->groupBy( DB::raw('MONTH(date)'), DB::raw('YEAR(date)'))
                                ->get();*/
            $ris_pending = App\Request::select(DB::raw('count(id) AS count'))
                                ->where(ucfirst('status'),'=',null)
                                ->first();
            $ris_approved = App\Request::select(DB::raw('count(id) AS count'))
                                ->where(ucfirst('status'),'=','Approved')
                                ->first();
            $ris_disapproved = App\Request::select(DB::raw('count(id) AS count'))
                                ->where(ucfirst('status'),'=','Disapproved')
                                ->first();
            $ris_cancelled = App\Request::select(DB::raw('count(id) AS count'))
                                ->where(ucfirst('status'),'=','Cancelled')
                                ->first();
            $ris_released = App\Request::select(DB::raw('count(id) AS count'))
                                ->where(ucfirst('status'),'=','Released')
                                ->first();
            $ris_count = App\Request::select(DB::raw('count(id) AS count'))
            ->first();
            $total = App\StockCard::filterByIssued()
                                ->select(DB::raw('sum(issued_quantity) as total'))
                                ->pluck('total')
                                ->first();
            $most_request =  DB::table('requests_v')
                                    ->select('details','stocknumber','name',
                                             DB::raw('SUM(quantity_requested) AS total_requested,
                                                      MAX(quantity_requested) AS highest_quantity_requested
                                                      '))
                                    ->where('status','=','released')
                                    ->groupBy('stocknumber','details')
                                    ->orderBy('total_requested','desc')
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
                    ->with('most_requested_stock',$most_requested_stock)
                    ->with('released_count',$released_count)
                    ->with('request_count',$request_count)
                    ->with('total',$total)
                    ->with('ris_pending',$ris_pending)
                    ->with('ris_approved',$ris_approved)
                    ->with('ris_disapproved',$ris_disapproved)
                    ->with('ris_cancelled',$ris_cancelled)
                    ->with('ris_released',$ris_released)
                    ->with('ris_count',$ris_count)
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