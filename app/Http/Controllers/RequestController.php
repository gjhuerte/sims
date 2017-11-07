<?php

namespace App\Http\Controllers;

use App;
use Auth;
use DB;
use Carbon;
use Session;
use Validator;
use Illuminate\Http\Request;

class RequestController extends Controller
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
          if(Auth::user()->accesslevel == 3)
          {
            return json_encode([
              'data' => App\Request::self()->get()
            ]);
          }

          return json_encode([
              'data' => App\Request::all()
          ]);
        }

        return view('request.index')
                ->with('title','Request');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('request.create')
                ->with('title','Request');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stocknumber = $request->get("stocknumber");
        $quantity = $request->get("quantity");
        $quantity_issued = null;
        $array = [];

        foreach(array_flatten($stocknumber) as $_stocknumber)
        {
            $validator = Validator::make([
                'Stock Number' => $stocknumber,
                'Quantity' => $quantity["$_stocknumber"]
            ],App\Request::$issueRules);

            if($validator->fails())
            {
                return redirect("request/create")
                        ->with('total',count($stocknumber))
                        ->with('stocknumber',$stocknumber)
                        ->with('quantity',$quantity)
                        ->withInput()
                        ->withErrors($validator);
            }

            if(Auth::user()->accesslevel == 1)
            {
              if(App\Supply::stocknumber($_stocknumber)->first()->balance <= $quantity["$_stocknumber"])
              {
                  return redirect("request/create")
                          ->with('total',count($stocknumber))
                          ->with('stocknumber',$stocknumber)
                          ->with('quantity',$quantity)
                          ->withInput()
                          ->withErrors(["No more items to release for supply with stock number of $_stocknumber"]);
              }

              $quantity_issued = $quantity[$_stocknumber];
            }

            array_push($array,[
                'quantity_requested' => $quantity["$_stocknumber"],
                'stocknumber' => $_stocknumber,
                'quantity_issued' => $quantity_issued
            ]);
        }

        $status = null;
        $issued_by = Auth::user()->username;

        if(Auth::user()->accesslevel == 1)
        {
          $status = 'approved';
        }

        DB::transaction(function() use ($array,$issued_by,$status){

            $request = App\Request::create([
                'id' => App\Request::generateID(),
                'requestor' => Auth::user()->username,
                'issued_by' => $issued_by,
                'remarks' => null,
                'status' => $status
            ]);

            $request->supply()->sync($array);
        });

        Session::flash('success-message','Request Sent');
        return redirect('request');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $id = $this->sanitizeString($id);

        if($request->ajax())
        {
          return json_encode([
            'data' => App\SupplyRequest::with('supply')->where('request_id','=',$id)->get()
          ]);
        }

        $request = App\Request::find($id);
        return view('request.show')
              ->with('request',$request)
              ->with('title','Request');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $request = App\Request::find($id);
        $supplyrequest = App\SupplyRequest::where('request_id','=',$id)->get();

        return view('request.edit')
                ->with('request',$request)
                ->with('supplyrequest',$supplyrequest)
                ->with('title',$request->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->ajax())
        {
            $id = $this->sanitizeString($id);
            $status = $this->sanitizeString($request->get('status'));
            $remarks = $this->sanitizeString($request->get('reason'));

            $request = App\Request::find($id);
            $request->status = $status;
            $request->approved_at = Carbon\Carbon::now();
            $request->remarks = $remarks;
            $request->save();

            return json_encode('success');
        }

        $quantity = $request->get('quantity');
        $comment = $request->get('comment');
        $stocknumber = $request->get('stocknumber');

        DB::beginTransaction();

        $request = App\Request::find($id);

        foreach($stocknumber as $stocknumber)
        {
          $request->supply()->updateExistingPivot($stocknumber,[
            'quantity_issued' => $quantity[$stocknumber],
            'comments' => $comment[$stocknumber]
          ]);
        }

        $request->issued_by = Auth::user()->username;
        $request->status = 'approved';
        $request->approved_at = Carbon\Carbon::now();
        $request->save();

        DB::commit();

        Session::flash('success-message','Request Approved');
        return redirect('request');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function releaseView($id)
    {
        $request = App\Request::find($id);
        $supplyrequest = App\SupplyRequest::where('request_id','=',$id)->get();

        return view('request.release')
                ->with('request',$request)
                ->with('supplyrequest',$supplyrequest)
                ->with('title',$request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
      $requests = App\Request::find($id);
      $requests->status = 'released';
      $requests->save();

      $daystoconsume = $request->get('daystoconsume');
      $quantity = $request->get('quantity');
      $stocknumber = $request->get('stocknumber');

      DB::beginTransaction();

      foreach($stocknumber as $stocknumber)
      {
        $supplyrequest = App\SupplyRequest::where('request_id','=',$id)
                                              ->where('stocknumber','=',$stocknumber)
                                              ->first();

        $date = Carbon\Carbon::now();
        $purchaseorder = '';
        $reference = $requests->id;
        $office = App\User::where('username','=',$requests->requestor)->pluck('office')->first();
        $daystoconsume = $this->sanitizeString($daystoconsume[$stocknumber]);
        $quantity = $this->sanitizeString($quantity[$stocknumber]);

        $supplyrequest->released_at = $date;
        $supplyrequest->save();

        $transaction = new App\SupplyTransaction;
        $transaction->date = $date;
        $transaction->stocknumber = $stocknumber;
        $transaction->purchaseorderno = $purchaseorder;
        $transaction->reference = $reference;
        $transaction->office = $office;
        $transaction->quantity  = $quantity;
        $transaction->daystoconsume = $daystoconsume;
        $transaction->issue();
      }

      DB::commit();



      Session::flash('success-message','Items Released');
      return redirect('request');

    }

    public function print($id)
    {
      $id = $this->sanitizeString($id);
      $supplyrequests = App\SupplyRequest::with('supply')->where('request_id','=',$id)->get();
      $request = App\Request::find($id);

      return view('request.print_show')
              ->with('request',$request)
              ->with('supplyrequests',$supplyrequests);



  		$pdf = PDF::loadView('request.print_index',['request' => $request, 'supplyrequests' => $supplyrequests ]);
  		return $pdf->download('request.pdf');
    }
}
