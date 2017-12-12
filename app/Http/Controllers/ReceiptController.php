<?php

namespace App\Http\Controllers;

use App;
use Validator;
use Session;
use DB;
use Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ReceiptController extends Controller
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
            return json_encode([
                'data' => App\Receipt::all()
            ]);
        }

        return view('receipt.index')
                ->with('title','Receipt');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('receipt.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Alert::success('Receipt Created')->flash();
        return redirect('receipt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {
        $id = $this->sanitizeString($id);

        if($request->ajax())
        {
            if($id == 'checkifexists')
            {

              $number = $this->sanitizeString(Input::get("number"));
              $receipt = App\Receipt::with('supplier')->findByNumber($number)->first();

              if(count($receipt) > 0)
              {
                return json_encode($receipt);
              }

              return json_encode(null);

            }

            if(Input::has('term'))
            {
                $number = $this->sanitizeString(Input::get('term'));
                return json_encode(
                    App\Receipt::where('number','like',"%".$number."%")
                    ->pluck('number')
                );
            }

            return json_encode([
                'data' => App\ReceiptSupply::with('supply')->where('receipt_number','=',$id)->get()
            ]);
        }

        if($id == 'checkifexists')
        {
          return view('errors.404');
        }

        $receipt = App\Receipt::findByNumber($id);
        return view('receipt.show')
                ->with('receipt',$receipt);
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
        $id = $this->sanitizeString($id);

        if($request->ajax())
        {
            if(Input::has('stocknumber'))
            {
                $cost = $this->sanitizeString(Input::get('unitprice'));
                $stocknumber = $this->sanitizeString(Input::get('stocknumber'));
                $receipt = App\ReceiptSupply::where('receipt_number','=',$id)
                                                ->where('stocknumber','=',$stocknumber)
                                                ->first();

                $receipt->cost = $cost;
                $receipt->save();
            }

            return json_encode('success');
        }

        \Alert::success('Receipt Updated')->flash();
        return redirect('receipt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Alert::success('Receipt Removed')->flash();
        return redirect('receipt');
    }

    public function printReceipt($receipt)
    {
        $receiptsupplies = App\ReceiptSupply::with('supply')->where('receipt_number','=',$receipt)->get();
        $receipt = App\Receipt::findByNumber($receipt);

        $data = ['receipt' => $receipt, 'receiptsupplies' => $receiptsupplies ];

        $filename = "Receipt-".Carbon\Carbon::now()->format('mdYHm')."-$receipt->number".".pdf";
        $view = "receipt.print_show";

        return $this->printPreview($view,$data,$filename);

        // return view($view);
    }
}
