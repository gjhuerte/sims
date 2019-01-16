<?php

namespace App\Http\Controllers\Report\RSMI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReceivingController extends Controller
{
    /**
     * [showReceive description]
     * displays receive form
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function showReceive(Request $request, $id)
    {
        $id = $this->sanitizeString($id);
        $rsmi = App\RSMI::with('stockcards.supply')->find($id);

        if(count($rsmi) <= 0) return view('errors.404');

        if( Auth::user()->access != 2 ) return redirect('/');

        if($request->ajax())
        {
            return datatables($rsmi)->toJson();
        }

        return view('rsmi.receive')
                ->with('rsmi', $rsmi);
    }
    
    /**
     * [receive description]
     * set the rsmi as received in status
     * updates the unitcost per item on the rsmi
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function receive(Request $request, $id)
    {
        $id = $this->sanitizeString($id);
        $ids = $request->get('id');
        $unitcosts = $request->get('unitcost');
        $array = [];

        $rsmi = App\RSMI::find($id);

        DB::beginTransaction();

        /**
         * loops through each record
         * creates an array of unitcost based on the id
         * of the stockcard given
         */
        foreach($ids as $id)
        {

            $unitcost = isset($unitcosts[$id]) ? (int)$unitcosts[$id] : null;

            /**
             * checks whether the unitcost of the said item
             * is equals to zero(0)
             * if the unitcost is zero, returns error
             */
            if( ! (isset($unitcost) && $unitcost > 0) )
            {
                return back()->withInput()->withErrors(["Unitcost must not be equals to zero"]);
            }

            $array[$id] = [
                'unitcost' => $unitcost
            ];
        }

        $rsmi->stockcards()->sync($array);
        $rsmi->status = 'R';
        $rsmi->save();

        DB::commit();

        \Alert::success('Report Received')->flash();
        return redirect('rsmi');

    }
}
