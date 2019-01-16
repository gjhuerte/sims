<?php

namespace App\Http\Controllers\Inventory\Supply\Stock\Adjustment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DisposalController extends Controller
{

	/**
	 * dispose items
	 */
	public function dispose(Request $request)
	{
		$title = 'Adjustment: Disposal';
		$action = 'dispose';

		return view('adjustment.dispose', compact('title', 'action'));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request)
	{
		$this->dispatch(new DisposeSupply($request->all()));
		return redirect('adjustment');
	}
}
