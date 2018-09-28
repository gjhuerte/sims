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
            $receipts = App\Receipt::get();
            return datatables($receipts)->toJson();
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
        $receipt = App\Receipt::find($id);

        if($request->ajax())
        {

            /**
             * used when checking if a certain receipt exists
             * @var [receipt number]
             */
            if($request->has('type'))
            {

              $number = $this->sanitizeString(Input::get("number"));
              $receipt = App\Receipt::with('supplier')->findByNumber($number)->first();

              if(count($receipt) > 0) 

                return json_encode([
                    'receipt' => $receipt,
                    'fundcluster' => $receipt->purchaseorder->fundclusters->pluck('code'),
                    'supplies' => $receipt->supplies
                ]);

              return json_encode(null);

            }

            /**
             * found in autosuggest in jquery
             * returns list of receipt associated with that number
             */
            if(Input::has('term'))
            {
                $number = $this->sanitizeString(Input::get('term'));
                return json_encode(
                    App\Receipt::where('number','like',"%".$number."%")
                    ->pluck('number')
                );
            }

            if( $request->has('number') )
            {
                $receipt = App\Receipt::findByNumber($id);
                return json_encode($receipt);
            }

            /**
             * returns list of supplies under the receipt
             * @var [supplies]
             */
            return datatables($receipt->supplies)->toJson();
        }

        /**
         * only exists in ajax
         * must not occur outside of ajax
         * @var [id]
         */
        if($id == 'checkifexists')
        {
          return view('errors.404');
        }

        /**
         * returns show form
         */
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

            /**
             * if data sent has a stocknumber with it
             */
            if($request->has('stocknumber'))
            {
                /**
                 * init all values sent through ajax
                 * @var [unitcost]
                 * @var [stocknumber]
                 */
                $unitcost = $this->sanitizeString($request->get('unitprice'));
                $stocknumber = $this->sanitizeString($request->get('stocknumber'));

                /**
                 * fetch record of supply
                 * assign record to supply
                 * @var [supply]
                 */
                $supply = App\Supply::findByStockNumber($stocknumber);

                /**
                 * update receipt information
                 * @var [receipt]
                 */
                $receipt = App\Receipt::find($id)->supplies()->updateExistingPivot($supply->id, [ 'unitcost' => $unitcost ]);
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

    /**
     * [printReceipt description]
     * Create a printable form using the receipt details given
     * @param  [type] $receipt [description]
     * @return [type]          [description]
     */
    public function printReceipt($receipt)
    {
        $orientation = 'Portrait';
        $receiptsupplies = App\ReceiptSupply::with('supply')->where('receipt_id','=',$receipt)->get();
        $receipt = App\Receipt::find($receipt);

        $data = ['receipt' => $receipt, 'receiptsupplies' => $receiptsupplies ];

        $filename = "Receipt-".Carbon\Carbon::now()->format('mdYHm')."-$receipt->number".".pdf";
        $view = "receipt.print_show";

        return $this->printPreview($view,$data,$filename,$orientation);

        // return view($view);
    }
}
