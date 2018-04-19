<?php

namespace App\Http\Controllers;

use App;
use Auth;
use Session;
use Validator;
use Illuminate\Http\Request;

class ClientFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {

          $clientfeedback = App\ClientFeedback::All();
          return datatables($clientfeedback)->toJson();
         }

        
        return view('clientfeedback.index');
    }

    public function create(Request $request)
    {
        return view('clientfeedback.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $comment = $this->sanitizeString($request->get("comment"));

        $clientfeedback = new App\ClientFeedback;


        $validator = Validator::make([
            'Comment' => $comment,
        ],$clientfeedback->rules());

        if($validator->fails())
        {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($validator);
        }
        $clientfeedback->user = Auth::user()->firstname.' '.Auth::user()->middlename.' '.Auth::user()->lastname;
        $clientfeedback->type = 'comment';
        $clientfeedback->comment = $comment;
        $clientfeedback->save();

        \Alert::success('Unit Created')->flash();
        return redirect('maintenance/unit');
    }

    public function show(){
        $clientfeedback = App\ClientFeedback::All();

        return view('clientfeedback.show');
    }
}
