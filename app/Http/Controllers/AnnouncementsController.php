<?php

namespace App\Http\Controllers;

use App;
use App\Announcement;
use Illuminate\Http\Request;
use Auth;
use Validator;
use DB;
use Carbon;
use App\Services\Dashboard;
use LRedis;
use Event;  

class AnnouncementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Dashboard $dashboard)
    {   
        return $dashboard->showDashboard($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Announcement $announcement)
    {
        $access_list = $announcement->access_list;

        return view('announcement.create')
                    ->with('access_list', $access_list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $this->sanitizeString($request->get('title'));
        $details = $this->sanitizeString($request->get('details'));
        $access = $this->sanitizeString($request->get('access'));

        $announcement = new App\Announcement;

        $validator = Validator::make([
            'Title' => $title,
            'Details' => $details
        ], $announcement->rules());

        if($validator->fails() || !array_key_exists($access, $announcement->access_list))
        {
            return back()
                    ->withInput()
                    ->withErrors($validator);
        }

        $announcement->title = $title;
        $announcement->details = $details;
        $announcement->access = $access;
        $announcement->user_id = Auth::user()->id;
        $announcement->save();

        $user = Auth::user()->firstname;
        $data['message'] = "$user has posted an announcement";
        $data['id']  = $announcement->access;

        event(new App\Events\TriggerAnnouncement($data));

        \Alert::success('Announcement Added!')->flash();
        return redirect('announcement');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $id = $this->sanitizeString($id);
        $announcement = App\Announcement::find($id);
        $access_list = $announcement->access_list;
        return view('announcement.edit')
                    ->with('access_list', $access_list)
                    ->with('announcement', $announcement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = $this->sanitizeString($id);
        $title = $this->sanitizeString($request->get('title'));
        $details = $this->sanitizeString($request->get('details'));
        $access = $this->sanitizeString($request->get('access'));

        $announcement = App\Announcement::find($id);

        $validator = Validator::make([
            'Title' => $title,
            'Details' => $details
        ], $announcement->updateRules());

        if($validator->fails() || !array_key_exists($access, $announcement->access_list))
        {
            return back()
                    ->withInput()
                    ->withErrors($validator);
        }

        $announcement->title = $title;
        $announcement->details = $details;
        $announcement->access = $access;
        $announcement->user_id = Auth::user()->id;
        $announcement->save();

        \Alert::success('Announcement Updated!')->flash();
        return redirect('announcement');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $id = $this->sanitizeString($id);
        if($request->ajax())
        {
            $announcement = App\Announcement::find($id);

            if(count($announcement) <= 0) return json_encode('error');

            $announcement->delete();

            return json_encode('success');
        }

        $announcement = App\Announcement::find($id);
        $announcement->delete();

        \Alert::success('Announcement Removed!')->flash();
        return redirect('announcement');
    }
}
