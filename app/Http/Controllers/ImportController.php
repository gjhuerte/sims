<?php

namespace App\Http\Controllers;

use App;
use Auth;
use Excel;
use DB;
use Carbon;
use Session;
use Validator;

// use App\Fileentry;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\File;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('input-file-preview'))
        {
            $type = $request->get('type');
            $filename = $type.'-'.Carbon\Carbon::now()->format('mydhms');
            $file = $request->file('input-file-preview');

            $validator = Validator::make($request->all(),[
                'input-file-preview' => 'required|file'
            ]);

            if($validator->fails())
            {
                return back()->withErrors($validator)->withInput();
            }

            $records = Excel::load($file)->get()->toArray();

            $keys = $this->getRecordColumns($records[0]);
            $rows = $this->clean($records, $keys);

            DB::beginTransaction();

            if($type == 'stockcard'):
                $this->importStockCard($rows);
            elseif($type == 'ledgercard'):
                $this->importLedgerCard($rows);
            else:
                DB::rollback();
                \Alert::error('Incorrect data for importing')->flash();
                return redirect('import')->with('records',$rows)->withInput();
            endif;

            DB::commit();

            \Alert::success('Data Imported')->flash();

            return view('import.index')
                ->with('title','Import')
                ->with('records', $records)
                ->with('keys',$keys);
        }

        \Alert::error('No Data Found')->flash();
        return back();
    }

    public function clean($records , $keys)
    {

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

        return $rows;
    }

    public function getRecordColumns($record)
    {
        $keys = [];
        foreach($record as $key=>$record)
        {
            array_push($keys,$key);
        }

        return $keys;
    }

    public function importLedgerCard($rows)
    {

        foreach($rows as $row)
        {
            $separator = ' ';
            $reference = $row['reference'];
            $issuedunitcost = floatVal(str_replace(",","",$row['issuedprice']));
            $receiptunitcost = floatVal(str_replace(",","",$row['receiptprice']));
            $daystoconsume = "None";
            $purchaseorder = "";
            $date = $row['date'];
            $receipt = null;
            $fundcluster = '';
            $stocknumber = $row['stockno'];
            $issued =  floatVal(str_replace(",","",$row['issue']));
            $received = floatVal(str_replace(",","",$row['receipt']));

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
            $transaction = new App\LedgerCard;
            $transaction->date = Carbon\Carbon::parse($date);
            $transaction->stocknumber = $stocknumber;
            $transaction->reference = (is_array($reference)) ? implode(' ', $reference) : $reference;
            $transaction->receipt = $receipt;
            $transaction->issued_unitcost = $issuedunitcost;
            $transaction->received_unitcost = $receiptunitcost;
            $transaction->daystoconsume = $daystoconsume;
            $transaction->created_by = Auth::user()->id;

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
                $transaction->received_quantity = $received;
                $transaction->receipt();
            }
            else
            {
                $transaction->issued_quantity = $issued;
                $transaction->issue();
            }
        }
    }

    public function importStockCard($rows)
    {

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
                $transaction->received_quantity = $received;
                $transaction->receipt();
            }
            else
            {
                $transaction->issued_quantity = $issued;
                $transaction->issue();
            }
        }
    }

}
