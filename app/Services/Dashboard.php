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

        if(Auth::user()->access == 0):
            $announcements = $announcements->findByAccess(['0', '3', '4']);
        elseif(Auth::user()->access == 2):
            $announcements = $announcements->findByAccess(['2', '3', '4']);
        elseif(Auth::user()->access == 3):
            $announcements = $announcements->findByAccess(['3', '4'])->ForAll()->orOffice();
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