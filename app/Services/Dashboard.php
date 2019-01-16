<?php

namespace App\Services;

use App\Models\Office\Office;
use App\Models\Receipt\Receipt;
use App\Views\Request as RequestView;
use App\Models\Inventory\Supply\Stock;
use App\Models\Inventory\Supply\Supply;
use App\Models\Announcement\Announcement;
use App\Models\PurchaseOrder\PurchaseOrder;
use App\Models\Request\Request as RequestModel;

class Dashboard
{

    /**
     * Fetch the view for the announcements of 
     * the current authenticated user
     *
     * @return Response
     */
	public function announcementDashboard()
	{
        $announcements = Announcement::filterByCurrentUsersAccess()
                            ->orderBy('created_at', 'desc')
                            ->paginate(20);

        return view('announcement.index', compact('announcements', 'link_limit'));
    }
    
    /**
     * Get the view for the summary of a dahsboard
     *
     * @return Response
     */
    public function summaryDashboard()
    {
        $purchaseorder = PurchaseOrder::all();
        $receipt_count = Receipt::count();
        $supply_count = Supply::count();
        $most_requested_stock = RequestView::selectMostRequestedStock()->get();

        $released_count = Request::countWithDateReleased()
                            ->groupedByDate()
                            ->orderBy('released_at')
                            ->get();
        $request_count = RequestModel::countWithDateReleased()
                            ->groupedByDate()
                            ->orderBy('date_released')
                            ->get();         
                                    
        $ris_pending = RequestModel::selectCount()
                            ->pending()
                            ->first();

        $ris_approved = RequestModel::selectCount()
                            ->approved()
                            ->first();
                            
        $ris_disapproved = RequestModel::selectCount()
                            ->disapproved()
                            ->first();
                            
        $ris_cancelled = RequestModel::selectCount()
                            ->cancelled()
                            ->first();
                            
        $ris_released = RequestModel::selectCount()
                            ->released()
                            ->first();
        $ris_count = RequestModel::selectCount()
                            ->first();

        $total = Stock::issued()
                            ->select(DB::raw('sum(issued_quantity) as total'))
                            ->pluck('total')
                            ->first();
                            
        $most_request =  RequestView::released()
                                ->groupBy('stocknumber','details')
                                ->orderBy('total_requested','desc')
                                ->first();

        $request_office = Stock::issued()
                            ->select(DB::raw('sum(issued_quantity) as total'), 'organization')
                            ->take(5)
                            ->groupBy('organization')
                            ->orderBy('total','desc')
                            ->first();
                            
        $received = Stock::received()
                            ->take(5)
                            ->orderBy('date','desc')
                            ->orderBy('created_at','desc')
                            ->get();

        $offices = Office::withCount('request')
                            ->orderBy('request_count','desc')
                            ->get();

        return view('dashboard.index', compact(
            'purchaseorders', 'receipt_count', 'supply_count', 'ris_count', 'most_requested_stock',
            'released_count', 'request_count', 'total', 'ris_pending', 'ris_approved', 'ris_disapproved',
            'ris_cancelled', 'ris_released', 'ris_count', 'most_request', 'request_office', 'offices', 'received'
        ));
    }
}