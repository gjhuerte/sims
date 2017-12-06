<?php

namespace App\Http\Controllers;

use App;
use Auth;
use Excel;
use DB;
use Carbon;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\File;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('import.index')
            ->with('title','Import');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = $request->get('type');
        $filename = $type.'-'.Carbon\Carbon::now()->format('mydhms');
        $file = $request->file('input-file-preview');

        $records = Excel::load($file)->toArray();

        $keys = [];

        // DB::getSchemaBuilder()->getColumnListing('stockcards');

        foreach($records[0] as $key=>$record)
        {
            array_push($keys,$key);
        }

        $rows = [];

        foreach($records as $record)
        {

            $inner_row = [];

            foreach($keys as $key)
            {
                $inner_row[$key] = $record[$key];
            }

            array_push($rows,$inner_row);


        }

        DB::beginTransaction();


        foreach($rows as $row)
        {
            $daystoconsume = "None";
            $purchaseorder = "";
            $deliveryreceipt = "";
            $date = $row['date'];
            $issued=  $row['issue'];
            $received = intval(str_replace(",","",$row['receipt']));
            $reference = explode(' ',$row['reference']);
            $supplier = $row['office'];

            if($reference == 'December Balance' || count($reference) == 1):

                $purchaseorder = $reference;
                $receipt = $reference;
                $supplier = 'None';

            else:

                if($reference[0] == 'APR'):

                    $supplier = config('app.main_agency');

                endif;

                if(isset($reference[1])):

                    $reference = explode('/',$reference[1]);

                    if(isset($reference[0]))  $purchaseorder = $reference[0];

                    if(isset($reference[1]))  $receipt = $reference[1];

                endif;
            endif;

            if(isset($receipt)):
                
                $deliveryreceipt = $receipt;

            endif;

            $fundcluster = '';
            $stocknumber = $row['stockno'];

            $transaction = new App\StockCard;
            $transaction->date = Carbon\Carbon::parse($date);
            $transaction->stocknumber = $stocknumber;
            $transaction->reference = $purchaseorder;
            $transaction->receipt = $deliveryreceipt;
            $transaction->organization = $supplier;
            $transaction->fundcluster = $fundcluster;
            $transaction->daystoconsume = $daystoconsume;
            $transaction->user_id = Auth::user()->id;

            if($received > 0):
                $transaction->received = $received;
                $transaction->receipt();
            else:
                $transaction->issued = $issued; 
                $transaction->issue();
            endif;
        }

        DB::commit();

        return view('import.index')
            ->with('title','Import')
            ->with('records', $records)
            ->with('keys',$keys);
    }

    public function importStockCard(Request $request)
    {
        $type = $request->get('type');
        $filename = $type.'-'.Carbon\Carbon::now()->format('mydhms');
        $file = $request->file('input-file-preview');

        $records = Excel::load($file)->toArray();

        $keys = [];

        // DB::getSchemaBuilder()->getColumnListing('stockcards');

        foreach($records[0] as $key=>$record)
        {
            array_push($keys,$key);
        }

        return view('import.index')
            ->with('title','Import')
            ->with('records', $records)
            ->with('keys',$keys);
    }

}
