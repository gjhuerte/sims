<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Validator;

class SyncController extends Controller
{
	/**
	 * return resources 
	 * 
	 */
    public function getSync(Request $request)
    {
    	return view('sync.index');
    }

    /**
     * sync the transactions
     * based on the input of the user
     */
    public function sync(Request $request, App\Supply $supply)
    {
        if($request->ajax())
        {
            $rows = $this->sanitizeString($request->get('rows'));
            $stockcard = $this->sanitizeString($request->get('stockcard'));
            $stocknumber = $this->sanitizeString($request->get('stocknumber'));

            $card = new App\LedgerCard;

            if($stockcard == true){
                $card = new App\StockCard;
            }

            $validator = Validator::make([
                'Stock Number' => $stocknumber
            ], $supply->legitimateStockNumber());

            if($validator->fails()){
                $errors = $validator->errors();
                $errors =  json_decode($errors); 

                return response()->json([
                    'success' => false,
                    'message' => $errors
                ], 422);
            }

            $stockcards = $card->syncBalance($stocknumber);

            return response()->json([
                'success' => true
            ], 200);
        }
    }

    public function getStockNumbers(Request $request, App\Supply $supply)
    {
        if($request->ajax())
        {
            
            $rows = $this->sanitizeString($request->get('rows'));
            $stockcard = $this->sanitizeString($request->get('stockcard'));
            $stocknumbers = $this->sanitizeString($request->get('stocknumbers'));
            $stocknumbers = ($stocknumbers != null && $stocknumbers != '') ? explode(',',$stocknumbers) : null;


            if($rows != 'all' && $stocknumbers != null ){
                $supply = $supply->whereIn('stocknumber', $stocknumbers);
            } 

            $supply = $supply->pluck('stocknumber');

            return response()->json([
                'success' => true,
                'message' => $supply
            ], 200);

        }

    }
}
