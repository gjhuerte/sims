<?php
namespace App\Http\Controllers;

use App\Supply;
use App\SupplyTransaction;
use Carbon;
use Session;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
class SupplyInventoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Request::ajax())
		{
			return json_encode([
				'data' => Supply::all()
			]);
		}
		return view('inventory.supply.index')
                ->with('title','Supply Inventory');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('inventory.supply.create')
                ->with('title','Supply Inventory');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$stocknumber = $this->sanitizeString(Input::get('stocknumber'));
		$entityname = $this->sanitizeString(Input::get('entityname'));
		$description = $this->sanitizeString(Input::get('description'));
		$unit = $this->sanitizeString(Input::get('unit'));
		$reorderpoint = $this->sanitizeString(Input::get("reorderpoint"));
		$supplytype = $this->sanitizeString(Input::get('supplytype'));

		$validator = Validator::make([
			'Stock Number' => $stocknumber,
			'Entity Name' => $entityname,
			'Fund Cluster' => '0',
			'Supply Type' => $supplytype,
			'Unit' => $unit,
			'Unit Price' => 0,
			'Reorder Point' => $reorderpoint
		],Supply::$rules);

		if($validator->fails())
		{
			return redirect('inventory/supply/add')
					->withInput()
					->withErrors($validator);
		}

		$supply = new Supply;
		$supply->stocknumber = $stocknumber;
		$supply->entityname = $entityname;
		$supply->supplytype = $supplytype;
		$supply->unit = $unit;
		$supply->reorderpoint = $reorderpoint;
		$supply->save();

		Session::flash('success-message','Supplies added to Supply Inventory');
		return redirect('inventory.supply');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(Request::ajax())
		{
			return json_encode([ 'data' => Supply::where('stocknumber','=',$id)->first() ]);
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return redirect('inventory.supply');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return redirect('inventory.supply');
	}


}
