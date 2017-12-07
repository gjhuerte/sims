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

        $validator = Validator::make($request->all(),[
            'input-file-preview' => 'required|file'
        ]);

        if($validator->fails())
        {
            return back()->withErrors()->withInput();
        }

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

        $this->importStockCard($rows);

        \Alert::success('Data Imported')->flash();

        return view('import.index')
            ->with('title','Import')
            ->with('records', $records)
            ->with('keys',$keys);
    }

    public function importStockCard($rows)
    {

        DB::beginTransaction();

        foreach($rows as $row)
        {
            $separator = ' ';
            $reference = $row['reference'];
            $daystoconsume = "None";
            $purchaseorder = "";
            $date = $row['date'];
            $receipt = null;
            $supplier = $row['office'];
            $fundcluster = '';
            $stocknumber = $row['stockno'];
            $issued=  intval(str_replace(",","",$row['issue']));
            $received = intval(str_replace(",","",$row['receipt']));

            // return json_encode(count(explode(' ', 'APR PS17-02764/CSE17-4692')));

            /*
            *
            *   check if the reference is 
            *   December Balance
            *   returns true if has word 'alance'
            *
            */
            if(strpos($reference,'alance') != false)
            {
                $receipt = $reference;
                $supplier = 'None';
            }

            else
            {
                /*
                *
                *  separates the values of reference field
                *   if APR: APR Reference/Receipt
                *   if PO P.O #Number date 
                *
                */
                    
                $reference = explode($separator, $reference);

                if(count($reference) > 1)
                {
                    $index = 0;

                    //  apr
                    if($reference[0] == 'APR')
                    {
                        $supplier = config('app.main_agency');
                        $separator = '/';
                        $reference = explode('/', $reference[1]);
                        $receipt = $reference[1];
                        $reference = ltrim($reference[0], '#');
                    }
                    else
                    {

                        $receipt = $reference[2];
                        $reference = ltrim($reference[1], '#');

                    }

                }
            }

            /*
            *
            *   store to database
            *
            */
            $transaction = new App\StockCard;
            $transaction->date = Carbon\Carbon::parse($date);
            $transaction->stocknumber = $stocknumber;
            $transaction->reference = (is_array($reference)) ? implode(' ', $reference) : $reference;
            $transaction->receipt = $receipt;
            $transaction->organization = $supplier;
            $transaction->fundcluster = $fundcluster;
            $transaction->daystoconsume = $daystoconsume;
            $transaction->user_id = Auth::user()->id;

            /*
            *
            *   check whether the received has value
            *   if the received has value
            *   add to receipt
            *   if issued has value
            *   ass to issue
            */
            if($received > 0)
            {
                $transaction->received = $received;
                $transaction->receipt();
            }
            else
            {
                $transaction->issued = $issued; 
                $transaction->issue();
            }
        }

        DB::commit();
    }

}
