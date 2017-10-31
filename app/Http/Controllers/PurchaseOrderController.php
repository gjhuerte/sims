<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use App\PurchaseOrderSupply;
use Validator;
use Carbon;
use Session;
use Auth;
use DB;
use App\SupplyTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Request::ajax())
        {
            return json_encode([
                'data'=>PurchaseOrder::all()
            ]);
        }

        return view('purchaseorder.index')
                ->with('title','Purchase Order');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchaseorder.create')
                ->with('title','Purchase Order');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $stocknumber = Input::get('stocknumber');
        $details = $this->sanitizeString(Input::get('details'));
        $fundcluster = $this->sanitizeString(Input::get('fundcluster'));
        $date = $this->sanitizeString(Input::get('date'));
        $purchaseorderno = $this->sanitizeString(Input::get('po'));
        $quantity = Input::get('quantity');
        $unitprice = Input::get('unitprice');

        $validator = Validator::make([
            'Purchase Order' => $purchaseorderno,
            'Date' => $date,
            'Fund Cluster' => $fundcluster,
            'Details' => $details
        ],PurchaseOrder::$rules);

        if($validator->fails())
        {
            return redirect('purchaseorder/create')
                    ->withInput()
                    ->withErrors($validator);
        }

        DB::transaction(function() use ($purchaseorderno,$details,$fundcluster,$date,$stocknumber,$quantity,$unitprice){

            $purchaseorder = new PurchaseOrder;
            $purchaseorder->purchaseorderno = $purchaseorderno;
            $purchaseorder->date = Carbon\Carbon::parse($date);
            $purchaseorder->fundcluster = $fundcluster;
            $purchaseorder->details = $details;
            $purchaseorder->save();

            foreach($stocknumber as $_stocknumber)
            {
                $purchaseordersupply = new PurchaseOrderSupply;
                $purchaseordersupply->user_id = Auth::user()->id;
                $purchaseordersupply->purchaseorderno = $purchaseorder->purchaseorderno;
                $purchaseordersupply->supplyitem = $this->sanitizeString($_stocknumber);
                $purchaseordersupply->orderedquantity = $quantity["$_stocknumber"];
                $purchaseordersupply->receivedquantity = 0;
                $purchaseordersupply->unitprice = 0;
                $purchaseordersupply->save();
            }
        });

        Session::flash('success-message','Operation Successful');
        return redirect('purchaseorder');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Request::ajax())
        {
            return json_encode([
                'data' => PurchaseOrderSupply::with('supply')->where('purchaseorderno','=',$id)->get()
            ]);
        }

        $purchaseorder = PurchaseOrder::find($id);
        return $id;
        return view('purchaseorder.show')
                ->with('purchaseorder',$purchaseorder)
                ->with('title',$purchaseorder->purchaseorderno);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        if(Request::ajax())
        {
          if(Input::has('no'))
          {
            $id = $this->sanitizeString(Input::get('no'));
          }
          $purchaseorder = PurchaseOrder::find($id);

          if(count($purchaseorder) > 0)
          {
            if(Input::has('fundcluster'))
            {
              $purchaseorder->fundcluster = $this->sanitizeString(Input::get('fundcluster'));
            }

            if(Input::has('status'))
            {
              $purchaseorder->status = 'paid';
            }

            $purchaseorder->save();
            return json_encode('success');
          }

          return json_encode('error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAllPurchaseOrder()
    {
        if(Request::ajax())
        {
            $purchaseorderno = $this->sanitizeString(Input::get('term'));
            return json_encode(PurchaseOrder::where('purchaseorderno','like',"%".$purchaseorderno."%")->pluck('purchaseorderno') );
        }
    }
}
