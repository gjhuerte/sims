<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use Auth;
use DB;
use Carbon;
use Session;
use PDF;
use Validator;
use Event;
use LRedis;

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

          $ret_val = App\Request::with('office')->with('requestor')->orderBy('created_at', 'asc');

          if(Auth::user()->access != 1)
          {
            if(Auth::user()->position == 'head') 
              $ret_val->findByOffice( Auth::user()->office );
            else 
              $ret_val->me();
          }

          return datatables($ret_val->get())->toJson();
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
      $purpose = $request->get("purpose");
      $requestor = Auth::user()->id;

      if(count($stocknumbers) <= 0 ) return back()->withInput()->withErrors(['Invalid Stock List Requested']);

      foreach(array_flatten($stocknumbers) as $stocknumber)
      {
        if($stocknumber == '' || $stocknumber == null || !isset($stocknumber))
        {
          \Alert::error('Encountered an invalid stock! Resetting table')->flash();
           return redirect("request/create");
        }

        $validator = Validator::make([
            'Purpose' => $purpose,
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
        'purpose' => $purpose,
        'status' => $status
      ]);

      $request->supplies()->sync($array);

      $office = App\Office::find($office);
      $requestor = App\User::find($requestor);
      $title = 'New Supply Request';
      $details = "A new request from $office->name by $requestor->firstname $requestor->lastname has been created.";
      $url = url("request/$request->id");

      App\Announcement::notify($title, $details, $access = 1, $url);

      event(new App\Events\GenerateRequest($details));

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
        $requests = App\Request::find($id);

        if(count($requests) <= 0 || (Auth::user()->access != 1 && $requests->requestor_id != Auth::user()->id && Auth::user()->office != App\Office::find($requests->office_id)->code))
        {
          return view('errors.404');
        }

        if($request->ajax())
        {

          $supplies = $requests->supplies;
          return json_encode([
            'data' => $supplies
          ]);
        }

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
      $issued_by = Auth::user()->username;
      $office = Auth::user()->id;
      $id = $this->sanitizeString($id);
      $purpose = $this->sanitizeString($request->get('purpose'));

      /**
       * [$array description]
       * variable used for storing stock details
       * to be used by sync method in request
       * @var array
       */
      $array = [];
      $requests = App\Request::find($id);

      if( count($requests) <= 0 || in_array($requests->status, [ 'approved', 'disapproved']) || Auth::user()->id != $requests->requestor_id)
      {
        return view('errors.404');
      }

      foreach(array_flatten($stocknumbers) as $stocknumber)
      {
        $validator = Validator::make([
            'Stock Number' => $stocknumber,
            'Quantity' => $quantity["$stocknumber"],
            'Purpose' => $purpose
        ], $requests->updateRules());

        /**
         * [$supply description]
         * returns the supply details found
         * using stocknumber as search attribute
         * @var [type]
         */
        $supply = App\Supply::findByStockNumber($stocknumber);

        if($validator->fails() || count($supply) <= 0 )
        {
          if(count($supply) <= 0)
          {
              \Alert::error("No information found for Supply with stocknumber of $stocknumber")->flash();
          }

          return redirect("request/$id/edit")
                  ->with('total',count($stocknumbers))
                  ->with('stocknumber',$stocknumbers)
                  ->with('quantity',$quantity)
                  ->withInput()
                  ->withErrors($validator);
        }

        $array[ $supply->id ] = [
            'quantity_requested' => $quantity["$stocknumber"]
        ];
      }

      DB::beginTransaction();

      $requests->purpose = $purpose;
      $requests->status = 'Updated on ' . Carbon\Carbon::now()->toDayDateTimeString();
      $requests->save();
      $requests->supplies()->sync($array);

      $data['id'] = $requests->requestor_id;
      $data['message'] = "Request $requests->code information has been updated by the user";

      event(new App\Events\RequestApproval($data));

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
                ->with('action','request')
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

      /**
       * find the requests details
       * change the status to released
       * assigned the current user as the one
       * who released the requests
       * @var [type]
       */
      $requests = App\Request::find($id);

      if( count($request) <= 0 || in_array($request->status, [ 'approved']) || Auth::user()->id != $request->requestor_id)
      {
        return view('errors.404');
      }

      if($request->status )

      $requests->status = 'released';
      $requests->released_at = $date;
      $requests->released_by = Auth::user()->id;
      $requests->save();

      $reference = $requests->code;
      $office = $requests->office->name;

      foreach($stocknumber as $stocknumber)
      {

        $_daystoconsume = "";
        $_quantity = 0;
        if(isset($daystoconsume["$stocknumber"]) && $daystoconsume["$stocknumber"] != null)
        {
            $_daystoconsume = $this->sanitizeString($daystoconsume["$stocknumber"]);
        }

        if(isset($quantity["$stocknumber"]) && $quantity["$stocknumber"] != null)
        {
          $_quantity = $this->sanitizeString($quantity["$stocknumber"]);
        }


        $validator = Validator::make([
          'Stock Number' => $stocknumber,
          'Requisition and Issue Slip' => $reference,
          'Date' => $date,
          'Issued Quantity' => $_quantity,
          'Office' => $office,
          'Days To Consume' => $_daystoconsume
        ],App\StockCard::$issueRules);

        $supply = App\Supply::findByStockNumber($stocknumber);
        $stock_balance = $supply->stock_balance;
        if($validator->fails() || $_quantity > $stock_balance)
        {

          DB::rollback();

          if($quantity > $stock_balance)
          {
            $validator = [ "The remaining balance ($supply->stock_balance) from $stocknumber is less than the quantity to be released ($_quantity)" ];
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
        $transaction->issued_quantity  = $_quantity;
        $transaction->daystoconsume = $_daystoconsume;
        $transaction->user_id = Auth::user()->id;
        $transaction->issue();

        $requests->supplies()->updateExistingPivot($supply->id, [
          'quantity_released' => $_quantity
        ]);
      }

      $data['id'] = $requests->requestor_id;
      $data['message'] = "Items from request $requests->code status has been released";

      event(new App\Events\RequestApproval($data));

      DB::commit();

      \Alert::success('Items Released')->flash();
      return redirect('request');

    }

    /**
     * [getAcceptForm description]
     * displays the info bout the requested items
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function getAcceptForm(Request $request, $id)
    {
        $requests = App\Request::find($id);
        

        return view('request.approval')
                ->with('request',$requests)
                ->with('title',$request->code)
                ->with('action', 'approval');
    }

    /**
     * [accept description]
     * action whether the request is approved/disapproved 
     * or for resubmission
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function accept(Request $request, $id)
    {

        $id = $this->sanitizeString($id);
        $quantity = $request->get('quantity');
        $comment = $request->get('comment');
        $stocknumbers = $request->get('stocknumber');
        $requested = $request->get('requested');
        $array = [];
        $remarks = $this->sanitizeString( $request->get('remarks') );
        $action = $this->sanitizeString( $request->get('action') );
        $issued_by = Auth::user()->id;
        
        if($action == 'approve'):
          $action = 'approved';
        elseif($action == 'resubmission'):
          $action = 'resubmit';
        else:
          $action = 'disapproved';
        endif;

        DB::beginTransaction();

        $requests = App\Request::find($id);

        if( count($request) <= 0 || in_array($request->status, ['approved', 'disapproved', 'released', 'cancelled']) || Auth::user()->access != 1)
        {
          return view('errors.404');
        }

        foreach($stocknumbers as $stocknumber)
        {

          $supply = App\Supply::findByStockNumber($stocknumber);

          if($action == 'approved')
          {

            $validator = Validator::make([
                'Stock Number' => $stocknumber,
                'Quantity' => $quantity["$stocknumber"]
            ],$requests->approveRules());

            if($validator->fails())
            {
                return redirect("request/$id/accept")
                        ->with('total',count($stocknumbers))
                        ->with('stocknumber',$stocknumbers)
                        ->with('quantity',$quantity)
                        ->withInput()
                        ->withErrors($validator);
            }

          }
          else
          {

            $validator = Validator::make([
                'Details' => $remarks
            ],$requests->commentsRules());

            if($validator->fails())
            {
                return redirect("request/$id/accept")
                        ->with('total',count($stocknumbers))
                        ->with('stocknumber',$stocknumbers)
                        ->with('quantity',$quantity)
                        ->withInput()
                        ->withErrors($validator);
            }
          }

          $array [ $supply->id ] = [
            'quantity_requested' => (isset($requested[$stocknumber])) ? $requested[$stocknumber] : 0,
            'quantity_issued' => (isset($quantity[$stocknumber]) && $quantity[$stocknumber] > 0 ) ? $quantity[$stocknumber] : 0,
            'comments' => $comment[$stocknumber]
          ];
          
        }

        $requests->supplies()->sync($array);

        $requests->remarks = $remarks;
        $requests->issued_by = $issued_by;
        $requests->status = $action; 
        $requests->approved_at = Carbon\Carbon::now();
        $requests->save();

        /**
         * data consists of the message to send to the broadcasting utility
         * id - the requestor id is required to filter only to whom is the 
         * message for
         * message - the message to send to the server
         */
        $data['id'] = $requests->requestor_id;
        $data['message'] = "Request $request->code has been $action";

        event(new App\Events\RequestApproval($data));

        DB::commit();

        $message = "Request $requests->code has been given an action"; 
        \Alert::success($message)->flash();

        return redirect('request');

    }

    /**
     * returns form for cancelling request
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getCancelForm($id)
    {
        $request = App\Request::find($id);

        return view('request.cancel')
                ->with('request',$request)
                ->with('title',$request->id);
    }

    /**
     * process involved when cancelling a request
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function cancel(Request $request, $id)
    {

      $details = $this->sanitizeString($request->get('details'));

      DB::beginTransaction();

      $requests = App\Request::find($id);

      if( count($request) <= 0 || in_array($request->status, ['cancelled', 'disapproved', 'released', 'approved']) || Auth::user()->id != $request->requestor_id)
      {
        return view('errors.404');
      }

      $requests->status = "cancelled";
      $requests->cancelled_by = Auth::user()->id;
      $requests->cancelled_at = Carbon\Carbon::now();
      $requests->remarks = $details;
      $requests->save();

      DB::commit();

      $data['id'] = $requests->requestor_id;
      $data['message'] = "Request $requests->code has been cancelled";

      event(new App\Events\RequestApproval($data));

      \Alert::success("$requests->code Cancelled")->flash();
      return redirect('request');
    }

    /**
     * Display the specified comments.
     *
     */
    public function getComments(Request $request,$id)
    {
        $id = $this->sanitizeString($id);
        $requests = App\Request::find($id);

        if( count($requests) <= 0 )
        {
          return view('errors.404');
        }

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

    /**
     * store comments of the user
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function postComments(Request $request,$id)
    {
      
      $comments = new App\RequestComments;
      $requests = App\Request::find($id);
      $details = $request->get('details');

      $validator = Validator::make([
          'Details' => $details
      ], $requests->commentsRules());

      if($validator->fails())
      {
          return back()->withInput()->withErrors($validator);
      }

      $comments->request_id = $id;
      $comments->details = $details;
      $comments->user_id = Auth::user()->id;
      $comments->save();

      $data['id'] = $requests->requestor_id;
      $data['message'] = "A comment for request $requests->code has been posted";

      event(new App\Events\RequestApproval($data));

      return back();
    }

    /**
     * reset the current status of request to null
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function resetStatus(Request $request, $id)
    {

      if($request->ajax())
      {
        $id = $this->sanitizeString($id);
        $requests = App\Request::find($id);

        if(count($requests) <= 0) return json_encode('error');

        $requests->remarks = null;
        $requests->issued_by = null;
        $requests->status = null;
        $requests->approved_at = null;
        
        foreach($requests->supplies as $supply):
          $supply->pivot->quantity_issued = null;
          $supply->pivot->quantity_released = null;
          $supply->pivot->comments = null;
          $supply->pivot->save();
        endforeach;

        $requests->save();

        $data['id'] = $requests->requestor_id;
        $data['message'] = "Request $requests->code status has been changed back to pending";

        event(new App\Events\RequestApproval($data));

        return json_encode('success');
      }

    }

    /**
     * creates a printable form of request
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function print($id)
    {
      $id = $this->sanitizeString($id);
      $request = App\Request::find($id);

      if(count($request) <= 0 || (Auth::user()->access != 1 && $request->requestor_id != Auth::user()->id && Auth::user()->office != App\Office::find($request->office_id)->code))
      {
        return view('errors.404');
      }

      $row_count = 14;
      $adjustment = 15;
      if(isset($request->supplies)):
        $data_count = count($request->supplies) % $row_count;
        if($data_count == 0 || (($data_count < 5) && (count($request->supplies) > $row_count))):

          if((count($request->supplies) > $row_count) && ($data_count < 7)):
            $remaining_rows = $data_count + $row_count + $adjustment;
          else:
            $remaining_rows = 0;
          endif;
        else:
          $remaining_rows = $row_count - $data_count;
        endif;
      endif;

      // return count($request->supplies);
      // return $data_count;
      // return $remaining_rows;
      $user = App\User::where('id','=',$request->requestor_id)->first();
      $data = [
        'request' => $request, 
        'approvedby' => App\Office::where('code','=','OVPAA')->first(),
        'row_count' => $row_count,
        'end' => $remaining_rows
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

    /**
     * [count description]
     * returns the amount of request based on the 
     * type given by the user
     * @param  Request $request [description]
     * @param  [type]  $type    [description]
     * @return [type]           [description]
     */
    public function count(Request $request, $type)
    {
      if($request->ajax())
      {
        $count = 0;
        $request = new App\Request;

        if($type == 'pending'):
          $request = $request->pending();
        endif;

        if(Auth::user()->access == 3):
          $request = $request->filterByOfficeCode(Auth::user()->office);
        endif;

        $count = $request->count();

        return json_encode($count);
      }
    }
}
