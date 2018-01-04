<?php
namespace App\Http\Controllers;

use App;
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

			$supplies = App\Supply::with('unit')->get();
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
	public function getSupplyInformation($id = null)
	{
		if(Request::ajax())
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

}
