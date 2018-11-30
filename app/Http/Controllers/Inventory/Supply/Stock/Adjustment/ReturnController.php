<?php

namespace App\Http\Controllers\Inventory\Supply\Stock\Adjustment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReturnController extends Controller
{

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$title = 'Adjustment: Return';
		$action = 'return';

		return view('adjustment.return', compact('title', 'action'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->dispatch(new ReturnSupply($request->all()));
		return redirect('adjustment');
	}
}
