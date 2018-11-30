<?php

namespace App\Http\Controllers;

use App\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request, Dashboard $dashboard)
    {
        if(Auth::user()->access == 1) {
            return $dashboard->summaryDashboard();
        }

        return $dashboard->announcementDashboard();
    }
}