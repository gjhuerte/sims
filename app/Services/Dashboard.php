<?php

namespace App\Services;

use Illuminate\Http\Request;
use App;
use Auth;

class Dashboard
{
	public function showDashboard(Request $request)
	{

        $announcements = new App\Announcement;
        if(Auth::user()->access != 1):
            $announcements = $announcements->findByAccess(['3', '4']);
        endif;
        
        $announcements = $announcements->orderBy('created_at', 'desc')->paginate(20);

        if($request->ajax())
        {
            return datatables($announcements)->toJson();
        }

        return view('announcement.index')
                ->with('announcements', $announcements)
                ->with('link_limit', '7');
	}
}