<?php

namespace App\Http\Controllers\Report\RSMI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrintableController extends Controller
{

    /**
     * [print description]
     * create a printable form for rsmi
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
	public function print($id)
	{
        $orientation = 'Portrait';
    	$id = $this->sanitizeString($id);
    	$rsmi = App\RSMI::with('stockcards.supply.unit')->find($id);
        $recapitulation = App\RSMI::leftJoin('rsmi_stockcard', 'rsmi.id', '=', 'rsmi_id')
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

        $stockcard = App\StockCard::whereHas('rsmi', function($query) use($id) {
            $query->where('id', '=', $id);
        })->select('date', 'id', 'reference',DB::raw('SUBSTRING(reference,7,4) as risno'))->orderBy('risno')->get()->unique('reference');
        $start = $stockcard->sortBy('risno')->pluck('reference')->first();
        $end = $stockcard->sortByDesc('risno')->pluck('reference')->first();
        $ris = App\Request::whereMonth('created_at','=',$rsmi->report_date->month)->get();
    	$data = [
    		'rsmi' => $rsmi,
    		'recapitulation' => $recapitulation,
            'start' => $start,
            'end' => $end,
            'ris' => $ris
    	];

        $filename = "RSMI-".Carbon\Carbon::parse($rsmi->report_date)->format('mdYHm').".pdf";
        $view = "rsmi.print_index";

        return $this->printPreview($view,$data,$filename,$orientation);
	}
}
