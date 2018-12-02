<?php

namespace App\Http\Controllers\Report\RSMI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SummaryController extends Controller
{
    /**
     * [showReceive description]
     * displays receive form
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function showSummary(Request $request, $id)
    {
        $id = $this->sanitizeString($id);
        $rsmi = App\RSMI::find($id);

        $summary = App\RSMI::leftJoin('rsmi_stockcard', 'rsmi.id', '=', 'rsmi_id')
                                ->leftJoin('stockcards', 'stockcard_id', '=', 'stockcards.id')
                                ->leftJoin('supplies', 'supply_id', '=', 'supplies.id')
                                ->where('rsmi.id', '=', $id)
                                ->groupBy('supplies.details', 'stocknumber')
                                ->select(
                                    'stocknumber', 
                                    DB::raw('sum(issued_quantity) as issued_quantity'), 
                                    DB::raw('avg(unitcost) as unitcost'), 
                                    DB::raw('(sum(issued_quantity) * avg(unitcost)) as amount'), 
                                    DB::raw('max(uacs_code) as uacs_code'), 
                                    'supplies.details as details'
                                )
                                ->orderBy('supplies.stocknumber', 'asc')
                                ->get();

        if(count($rsmi) <= 0) return view('errors.404');

        if( Auth::user()->access != 2 ) return redirect('/');

        return view('rsmi.summary')
                ->with('rsmi', $rsmi)
                ->with('summary', $summary);
    }
    
    /**
     * [receive description]
     * set the rsmi as received in status
     * updates the unitcost per item on the rsmi
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function summary(Request $request, $id)
    {
        $id = $this->sanitizeString($id);
        $ids = $request->get('id');
        $codes = $request->get('uacs');
        $array = [];

        DB::beginTransaction();

        /**
         * loops through each record
         * creates an array of unitcost based on the id
         * of the stockcard given
         */
        foreach($ids as $id)
        {

            $code = isset($codes[$id]) ? $codes[$id] : null;

            $stockcards = App\StockCard::findByStockNumber($id)->select('id')->pluck('id');

            DB::table('rsmi_stockcard')
                ->whereIn('stockcard_id', $stockcards)
                ->update(['uacs_code' => $code]);

        }

        DB::commit();

        \Alert::success('Report Updated')->flash();
        return redirect('rsmi');

    }
}
