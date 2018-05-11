<?php
namespace App\Http\Controllers;

use App;
use Carbon;
use Session;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class SupplyInventoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if($request->ajax())
		{

			// $supplies = App\Supply::with('unit')->get();
			$supplies = DB::table('supplies_v')->get();
			// $supplies = App\Supply::with('unit')->take(App\Supply::count());	
			return datatables($supplies)->toJson();
		}
		return view('inventory.supply.index')
                ->with('title','Supply Inventory');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getSupplyInformation(Request $request, $id = null)
	{
		if($request->ajax())
		{
			if(Input::has('term'))
			{

				$stocknumber = $this->sanitizeString(Input::get('term'));
				return App\Supply::where('stocknumber','like','%'.$stocknumber.'%')
								->pluck('stocknumber')
								->toJson();
			}

			if($id)
			{
				return json_encode([ 'data' => App\Supply::where('stocknumber','=',$id)->first() ]);
			}

			return view('errors.404');
		}
	}

	public function advanceSearch()
	{
		return view('errors.404');
	}

	public function show(Request $request, $id = null)
	{
		if($request->ajax())
		{
			if($request->has('term'))
			{
				$stocknumber = $this->sanitizeString($request->get('term'));
				$supply = App\Supply::where('stocknumber', 'like', '%'. $stocknumber . '%')->pluck('stocknumber');

				return json_encode($supply);
			}
		}
	}

	public function printMasterList(Request $request)
	{
		$orientation = 'Portrait';
		$supplies = App\Supply::all();

		$data = [
			'supplies' => $supplies
		];

		$filename = "SupplyMasterList-".Carbon\Carbon::now()->format('mdYHm').".pdf";
		$view = "inventory.supply.print_index";
		return $this->printPreview($view,$data,$filename,$orientation);
	}

}
