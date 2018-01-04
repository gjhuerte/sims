<?php

namespace App\Http\Controllers;

use App;
use Auth;
use DB;
use Carbon;
use Session;
use PDF;
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

          $ret_val = App\Request::with('office')->with('requestor');

          if(Auth::user()->access != 1)
          {
            if(Auth::user()->position == 'head') $ret_val->findByOffice( Auth::user()->office );
            else $ret_val->me();
          }

          return json_encode([
              'data' => $ret_val->get()
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
    public function create(Request $request)
    {
      $code = $this->generate($request);

      return view('request.create')
              ->with('code',$code)
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
      $stocknumbers = $request->get("stocknumber");
      $quantity = $request->get("quantity");
      $quantity_issued = null;
      $array = [];
      $office = App\Office::findByCode(Auth::user()->office)->id;
      $status = null;
      $requestor = Auth::user()->id;

      foreach(array_flatten($stocknumbers) as $stocknumber)
      {
        $validator = Validator::make([
            'Stock Number' => $stocknumber,
            'Quantity' => $quantity["$stocknumber"]
        ],App\Request::$issueRules);

        if($validator->fails())
        {
            return redirect("request/create")
                    ->with('total',count($stocknumbers))
                    ->with('stocknumber',$stocknumbers)
                    ->with('quantity',$quantity)
                    ->withInput()
                    ->withErrors($validator);
        }

        array_push($array,[
            'quantity_requested' => $quantity["$stocknumber"],
            'supply_id' => App\Supply::findByStockNumber($stocknumber)->id,
            'quantity_issued' => $quantity_issued
        ]);
      }

      DB::beginTransaction();

      $request = App\Request::create([
        'requestor_id' => $requestor,
        'issued_by' => null,
        'office_id' => $office,
        'remarks' => null,
        'status' => $status
      ]);

      $request->supplies()->sync($array);

      DB::commit();

      \Alert::success('Request Sent')->flash();
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

          $supplies = App\Request::find($id)->supplies;
          return json_encode([
            'data' => $supplies
          ]);
        }

        $requests = App\Request::find($id);
        return view('request.show')
              ->with('request',$requests)
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

        return view('request.edit')
                ->with('request',$request)
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
      $stocknumbers = $request->get("stocknumber");
      $quantity = $request->get("quantity");
      $quantity_issued = null;
      $array = [];
      $issued_by = Auth::user()->username;
      $office = Auth::user()->office;
      $status = null;

      foreach(array_flatten($stocknumbers) as $stocknumber)
      {
        $validator = Validator::make([
            'Stock Number' => $stocknumber,
            'Quantity' => $quantity["$stocknumber"]
        ],App\Request::$issueRules);

        if($validator->fails())
        {
            return redirect("request/$id/edit")
                    ->with('total',count($stocknumbers))
                    ->with('stocknumber',$stocknumbers)
                    ->with('quantity',$quantity)
                    ->withInput()
                    ->withErrors($validator);
        }

        if(Auth::user()->access == 1)
        {
          if( App\Supply::findByStockNumber($stocknumber)->balance <= $quantity["$stocknumber"])
          {
              return redirect("request/create")
                      ->with('total',count($stocknumbers))
                      ->with('stocknumber',$stocknumbers)
                      ->with('quantity',$quantity)
                      ->withInput()
                      ->withErrors(["No more items to release for supply with stock number of $stocknumber"]);
          }

          $status = 'approved';
          $quantity_issued = $quantity[$stocknumber];
        }

        array_push($array,[
            'quantity_requested' => $quantity["$stocknumber"],
            'supply_id' => App\Supply::findByStockNumber($stocknumber)->id,
            'quantity_issued' => $quantity_issued
        ]);
      }

      DB::beginTransaction();

      $request = App\Request::find($id)->supplies()->sync($array);

      DB::commit();

      \Alert::success('Request Updated')->flash();
      return redirect("request/$id");

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function releaseView(Request $request, $id)
    {
        $requests = App\Request::find($id);

        return view('request.release')
                ->with('request',$requests)
                ->with('title',$requests->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

      $daystoconsume = $request->get('daystoconsume');
      $quantity = $request->get('quantity');
      $stocknumber = $request->get('stocknumber');
      $date = Carbon\Carbon::now();

      DB::beginTransaction();

      $requests = App\Request::find($id);
      $requests->status = 'released';
      $requests->released_at = $date;
      $requests->released_by = Auth::user()->id;
      $requests->save();

      $reference = $requests->code;
      $office = $requests->office;

      foreach($stocknumber as $stocknumber)
      {

        if(isset($daystoconsume["$stocknumber"]) && $daystoconsume["$stocknumber"] != null)
        {
            $daystoconsume = $this->sanitizeString($daystoconsume["$stocknumber"]);
        }else
        {
            $daystoconsume = "";
        }

        if(isset($quantity["$stocknumber"]) && $quantity["$stocknumber"] != null)
        {
          $quantity = $this->sanitizeString($quantity["$stocknumber"]);
        }else
        {
            $quantity = 0;
        }


        $validator = Validator::make([
          'Stock Number' => $stocknumber,
          'Requisition and Issue Slip' => $reference,
          'Date' => $date,
          'Issued Quantity' => $quantity,
          'Office' => $office,
          'Days To Consume' => $daystoconsume
        ],App\StockCard::$issueRules);

        $balance = App\Supply::findByStockNumber($stocknumber)->stock_balance;
        if($validator->fails() || $quantity > $balance)
        {

          DB::rollback();

          if($quantity > $balance)
          {
            $validator = [ "You cannot release quantity of $stocknumber which is greater than the remaining balance ($balance)" ];
          }

          return back()
              ->with('total',count($stocknumber))
              ->with('stocknumber',$stocknumber)
              ->with('quantity',$quantity)
              ->with('daystoconsume',$daystoconsume)
              ->withInput()
              ->withErrors($validator);
        }

        $transaction = new App\StockCard;
        $transaction->date = $date;
        $transaction->stocknumber = $stocknumber;
        $transaction->reference = $reference;
        $transaction->organization = $office;
        $transaction->issued  = $quantity;
        $transaction->daystoconsume = $daystoconsume;
        $transaction->user_id = Auth::user()->id;
        $transaction->issue();
      }

      DB::commit();



      \Alert::success('Items Released')->flash();
      return redirect('request');

    }

    public function getApproveForm(Request $request, $id)
    {
        $requests = App\Request::find($id);
        

        return view('request.approval')
                ->with('request',$requests)
                ->with('title',$request->code);
    }

    public function approve(Request $request, $id)
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
        $stocknumbers = $request->get('stocknumber');
        $requested = $request->get('requested');
        $array = [];
        $remarks = $this->sanitizeString( $request->get('remarks') );
        $user = App\Office::findByCode(Auth::user()->office)->first()->id;

        foreach($stocknumbers as $stocknumber)
        {
          $validator = Validator::make([
              'Stock Number' => $stocknumber,
              'Quantity' => $quantity["$stocknumber"]
          ],App\Request::$issueRules);

          if($validator->fails())
          {
              return redirect("request/$id/edit")
                      ->with('total',count($stocknumbers))
                      ->with('stocknumber',$stocknumbers)
                      ->with('quantity',$quantity)
                      ->withInput()
                      ->withErrors($validator);
          }

          array_push($array,[
            'quantity_requested' => (isset($requested[$stocknumber])) ? $requested[$stocknumber] : 0,
            'quantity_issued' => $quantity[$stocknumber],
            'supply_id' => App\Supply::findByStockNumber($stocknumber)->id,
            'comments' => $comment[$stocknumber]
          ]);
        }

        DB::beginTransaction();

        $request = App\Request::find($id);
        $request->remarks = $remarks;
        $request->issued_by = $user;
        $request->status = 'approved';
        $request->approved_at = Carbon\Carbon::now();
        $request->save();

        $request->supplies()->sync($array);

        DB::commit();

        \Alert::success('Request Approved')->flash();
        return redirect('request');

    }

    public function disapprove(Request $request, $id)
    {
        if($request->ajax())
        {
            $id = $this->sanitizeString($id);
            $remarks = $this->sanitizeString($request->get('reason'));

            $request = App\Request::find($id);
            $request->status = "disapproved";
            $request->approved_at = Carbon\Carbon::now();
            $request->remarks = $remarks;
            $request->save();

            return json_encode('success');
        }

        DB::beginTransaction();

        $request = App\Request::find($id);

        $request->status = 'disapproved';
        $request->approved_at = Carbon\Carbon::now();
        $request->save();

        DB::commit();

        \Alert::success('Request Disapproved')->flash();
        return redirect('request');

    }

    public function getCancelForm($id)
    {
        $request = App\Request::find($id);

        return view('request.cancel')
                ->with('request',$request)
                ->with('title',$request->id);
    }

    public function cancel(Request $request, $id)
    {

      $details = $this->sanitizeString($request->get('details'));

      DB::beginTransaction();

      $requests = App\Request::find($id);
      $requests->status = "cancelled";
      $requests->cancelled_by = Auth::user()->id;
      $requests->cancelled_at = Carbon\Carbon::now();
      $requests->remarks = $details;
      $requests->save();

      DB::commit();

      \Alert::success("$requests->code Cancelled")->flash();
      return redirect('request');
    }

    /**
     * Display the specified comments.
     *
     *
     * 
     */
    public function getComments(Request $request,$id)
    {
        $id = $this->sanitizeString($id);
        $requests = App\Request::find($id);

        if( count($requests) <= 0 ) return view('errors.404');

        if($request->ajax())
        {
          return json_encode([
            'data' => $requests->comments()
          ]);
        }

        $comments = $requests->comments()->orderBy('created_at','desc')->get();

        return view('request.comments')
              ->with('request',$requests)
              ->with('comments',$comments);

    }

    public function postComments(Request $request,$id)
    {
      
      $comments = new App\RequestComments;
      $comments->request_id = $id;
      $comments->details = $request->get('details');
      $comments->user_id = Auth::user()->id;
      $comments->save();

      return back();
    }

    public function print($id)
    {
      $id = $this->sanitizeString($id);
      $supplyrequests = App\RequestSupply::with('supply')->where('request_id','=',$id)->get();
      $request = App\Request::find($id);

      $data = [
        'request' => $request, 
        'supplyrequests' => $supplyrequests,
        'approvedby' => App\Office::where('code','=','OVPAA')->first()
      ];

      $filename = "Request-".Carbon\Carbon::now()->format('mdYHm')."-$request->code".".pdf";
      $view = "request.print_show";

      return $this->printPreview($view,$data,$filename);
    }

    public function generate(Request $request)
    {

      $requests = App\Request::orderBy('created_at','desc')->first();
      $id = 1;
      $now = Carbon\Carbon::now();
      $const = $now->format('y') . '-' . $now->format('m');

      if(count($requests) > 0)
      {
        $id = $requests->id + 1;
      }
      else
      {
        $id = count(App\StockCard::filterByIssued()->get()) + 1;
      }

      if($request->ajax())
      {
        return json_encode( $const . '-' . $id ); 
      }

      return $const . '-' . $id;

    }
}
