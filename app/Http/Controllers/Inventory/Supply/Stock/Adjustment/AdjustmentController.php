<?php

namespace App\Http\Controllers\Inventory\Supply\Stock\Adjustment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory\Supply\Adjustment;

class AdjustmentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if($request->ajax()) {
			$adjustments = Adjustment::all();
			return datatables($adjustments)->toJson();
		}

		return view('adjustment.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request, $id)
	{
		$adjustment = Adjustment::findOrFail($id);
		if($request->ajax()) {
			return datatables($adjustment->supplies)->toJson();
		}

		return view('adjustment.show', compact('adjustment'));
	}
}
