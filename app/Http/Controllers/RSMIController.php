<?php

namespace App\Http\Controllers;

use Validator;
use Carbon;
use Session;
use Auth;
use DB;
use App;
use Illuminate\Http\Request;

class RSMIController extends Controller
{
    
    public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$rsmi = new App\RSMI;

    		if(Auth::user()->access != 1) $rsmi = $rsmi->filterByStatus(['S', 'R', 'C', 'E', 'AP']);

    		return datatables($rsmi->orderBy('id','desc')->get())->toJson();
    	}

        $months =  App\StockCard::filterByIssued()
        			->select('date')
        			->get()
                 	->pluck('parsed_month')
                 	->unique();

    	return view('rsmi.index')
    			->with('months', $months);
    }

    public function store(Request $request)
    {
    	$month = Carbon\Carbon::parse($this->sanitizeString($request->get('month')));

    	$id = App\StockCard::filterByIssued()->filterByMonth($month)->select('id')->pluck('id');

    	DB::beginTransaction();

    	$rsmi = new App\RSMI;
    	$rsmi->status = 'P';
    	$rsmi->report_date = $month;
    	$rsmi->user_id = Auth::user()->id;
    	$rsmi->save();

    	$rsmi->stockcards()->sync($id);

    	DB::commit();

    	\Alert::success('Report Generated')->flash();
    	return redirect("rsmi/$rsmi->id");
    }

    public function show(Request $request, $id)
    {
    	$id = $this->sanitizeString($id);
    	$rsmi = App\RSMI::find($id);

    	if($request->ajax())
    	{
    		$stockcards = $rsmi->stockcards;
    		return datatables($stockcards)->toJson();
    	}

    	return view('rsmi.show')
    			->with('rsmi', $rsmi);
    }

    public function submit(Request $request, $id)
    {
        $id = $this->sanitizeString($id);
        $rsmi = App\RSMI::find($id);

        if(count($rsmi) <= 0) return view('errors.404');

        $rsmi->status = 'S';
        $rsmi->save();

        \Alert::success('Report Submitted ')->flash();
        return back();
    }

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

        /**
         * loops through each record
         * creates an array of unitcost based on the id
         * of the stockcard given
         */
        foreach($ids as $id)
        {
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

    /**
     * [append description]
     * appends the rsmi details to ledger card
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function apply(Request $request, $id)
    {
        $rsmi = App\RSMI::with('stockcards.supply')->find($id);

        /**
         * append each record to ledger card
         */
        DB::beginTransaction();

        foreach($rsmi->stockcards as $stockcard):

            $date = $stockcard->date;
            $stocknumber = $stockcard->supply->stocknumber;
            $reference = $stockcard->reference; 
            $unitcost = $stockcard->pivot->unitcost; 
            $issued_quantity = $stockcard->issued_quantity; 
            $daystoconsume = $stockcard->daystoconsume; 

            $transaction = new App\LedgerCard;
            $transaction->date = Carbon\Carbon::parse($date);
            $transaction->stocknumber = $stocknumber;
            $transaction->reference = $reference;
            $transaction->received_quantity = 0;
            $transaction->issued_quantity = $issued_quantity;
            $transaction->issued_unitcost = $transaction->received_unitcost = $unitcost;
            $transaction->daystoconsume = $daystoconsume;
            $transaction->created_by = Auth::user()->id;
            $transaction->issue();

        endforeach;

        DB::commit();

        /**
         * [$rsmi->status description]
         * set the rsmi status as appended to ledger card
         * @var string
         */
        $rsmi->status = 'AP';
        $rsmi->save();

        \Alert::success("Records from RSMI $rsmi->parsed_month added to Ledger Card");
        return redirect("rsmi/$rsmi->id");
    }

	public function print($id)
	{
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
    								'supplies.details as details'
    							)
    							->orderBy('supplies.stocknumber', 'asc')
    							->get();

    	$data = [
    		'rsmi' => $rsmi,
    		'recapitulation' => $recapitulation
    	];

        $filename = "RSMI-".Carbon\Carbon::parse($rsmi->report_date)->format('mdYHm').".pdf";
        $view = "rsmi.print_index";

        return $this->printPreview($view,$data,$filename);
	}
}
