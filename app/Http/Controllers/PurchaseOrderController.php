<?php

namespace App\Http\Controllers;

use App;
use Validator;
use Carbon;
use Session;
use Auth;
use DB;
use App\SupplyTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PurchaseOrderController extends Controller
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
            return datatables(App\PurchaseOrder::with('supplier')->get())->toJson();
            // return json_encode([
            //     'data'=> App\PurchaseOrder::with('supplier')->get()
            // ]);
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
        $supplier = App\Supplier::pluck('name', 'id');

        return view('purchaseorder.create')
                ->with('title','Purchase Order')
                ->with('supplier',$supplier);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $stocknumbers = Input::get('stocknumber');
        $details = $this->sanitizeString(Input::get('details'));
        $fundcluster = $this->sanitizeString(Input::get('fundcluster'));
        $date = $this->sanitizeString(Input::get('date'));
        $number = $this->sanitizeString(Input::get('po'));
        $quantity = Input::get('quantity');
        $unitprice = Input::get('unitprice');
        $supplier = $this->sanitizeString(Input::get('supplier'));
        $records = [];

        $validator = Validator::make([
            'Purchase Order' => $number,
            'Date' => $date,
            'Fund Cluster' => $fundcluster,
            'Details' => $details
        ],App\PurchaseOrder::$rules);

        if($validator->fails())
        {
            DB::rollback();
            return redirect('purchaseorder/create')
                    ->withInput()
                    ->withErrors($validator);
        }

        DB::beginTransaction();

        $stocknumbers = array_unique($stocknumbers);

        foreach($stocknumbers as $stocknumber)
        {
            $_quantity = $this->sanitizeString($quantity["$stocknumber"]);
            $_unitprice = $this->sanitizeString($unitprice["$stocknumber"]);

            $validator = Validator::make([
              'Stock Number' => $stocknumber,
              'Quantity' => $_quantity,
              'Unit Price' => $_unitprice,
            ],App\PurchaseOrderSupply::$rules,App\PurchaseOrder::$messages);

            if($validator->fails())
            {
                DB::rollback();
                return redirect('purchaseorder/create')
                        ->withInput()
                        ->withErrors($validator);
            }


            $supply = App\Supply::findByStockNumber($stocknumber);

            $records[$supply->id] = [
              'ordered_quantity' => $_quantity,
              'unitcost' => $_unitprice,
              'received_quantity' => 0
            ];
        }

        $purchaseorder = new App\PurchaseOrder;
        $purchaseorder->number = $number;
        $purchaseorder->date_received = Carbon\Carbon::parse($date);
        $purchaseorder->details = $details;
        $purchaseorder->supplier_id = $supplier;
        $purchaseorder->created_by = Auth::user()->id;
        $purchaseorder->save();

        $purchaseorder->supply()->attach( $records );

        DB::commit();

        \Alert::success('Operation Successful')->flash();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id=null)
    {

        $id = $this->sanitizeString($id);

        if($request->ajax())
        {

            /**
            * used to check if the purchase order exists
            * if exists @return purchase order information
            * else @return null
            */
            if($id == 'checkifexists')
            {
                $number = $this->sanitizeString(Input::get('number'));
                $purchaseorder = App\PurchaseOrder::with('supplier')->findByNumber($number)->first();

                if(count($purchaseorder) > 0)
                {
                  return json_encode($purchaseorder);
                }

                return json_encode(null);
            }

            /**
            * used in suggestion jquery
            * add term in get method
            * return purchase order with same term
            *
            */
            if(Input::has('term'))
            {
                $number = $this->sanitizeString(Input::get('term'));
                return json_encode(
                    App\PurchaseOrder::where('number','like',"%".$number."%")
                    ->pluck('number')
                );
            }

            /**
            * returns view of the purchase order supply
            * finds the supply information then return the values
            */
            $purchaseorder = App\PurchaseOrder::find($id);
            return datatables($purchaseorder->supply)->addColumn('pivot.amount', function() use ($purchaseorder){
              return $purchaseorder->supply()->first()->received_quantity * $purchaseorder->supply()->first()->unitcost;
            })->toJson();
        }

        if($id != 'checkifexists'):

          $purchaseorder = App\PurchaseOrder::find($id);
          $fundcluster = isset($purchaseorder->fundcluster) ? $purchaseorder->fundcluster : 'None';
          if(isset($purchaseorder->number))
          {
            return view('purchaseorder.show')
                    ->with('purchaseorder',$purchaseorder)
                    ->with('title',$purchaseorder->number)
                    ->with('fundcluster', $fundcluster);
          }

        endif;

        return view('errors.404');
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
    public function update(Request $request, $id)
    {
        if($request->ajax())
        {
          if(Input::has('no'))
          {
            $id = $this->sanitizeString(Input::get('no'));
          }

          $purchaseorder = App\PurchaseOrder::find($id);

          if(count($purchaseorder) > 0)
          {
            if(Input::has('fundcluster'))
            {
                $fundclusters = $this->sanitizeString($request->get('fundcluster'));
                $_fundclusters = [];

                if(count(explode(", " , $fundclusters) > 0)):
                  $fundclusters = explode(", " , $fundclusters);
                elseif(count(explode("," , $fundclusters) > 0)):
                  $fundclusters = explode("," , $fundclusters);
                else:
                  $fundcluster = null;
                endif;

                foreach($fundclusters as $fundcluster):
                  $fundcluster = App\FundCluster::firstOrCreate([ 'code' => $fundcluster ]);
                  array_push($_fundclusters, $fundcluster->id);

                  $validator = Validator::make( [ 'fundclusters' =>  $fundclusters ], [
                    'fundclusters' => 'array|required'
                  ]);

                  if($validator->fails())
                  {
                    return json_encode($validator->errors()->first());
                  }

                endforeach;

                $purchaseorder->fundcluster()->sync($_fundclusters);
            }

            if(Input::has('status'))
            {
              $purchaseorder->status = 'paid';
              $purchaseorder->save();
            }

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

    public function printPurchaseOrder($id)
    {
        $purchaseordersupply = App\PurchaseOrderSupply::with('supply')
            ->where('purchaseorder_number','=', App\PurchaseOrder::find($id)->pluck('number') )
            ->get();

        $purchaseorder = App\PurchaseOrder::find($id);

        $data = [
            'purchaseordersupply' => $purchaseordersupply,
            'purchaseorder' => $purchaseorder
        ];

        $filename = "PurchaseOrder-".Carbon\Carbon::now()->format('mdYHm')."-$purchaseorder->number".".pdf";
        $view = "purchaseorder.print_show";

        return $this->printPreview($view,$data,$filename);
    }
}
