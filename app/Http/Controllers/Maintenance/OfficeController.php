<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Job\Office\CreateOffice;
use App\Job\Office\UpdateOffice;
use App\Job\Office\RemoveOffice;
use App\Http\Controllers\Controller;
use App\Http\Request\OfficeRequest\OfficeStoreRequest;
use App\Http\Request\OfficeRequest\OfficeUpdateRequest;

class OfficeController extends Controller 
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if($request->ajax()) {
			$offices = Office::all();
			return datatables($offices)->toJson();
		}

		return view('maintenance.office.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('maintenance.office.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(OfficeStoreRequest $request)
	{
		$this->dispatch(new Office($request->all()));
		return redirect('maintenance/office');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request, $id)
	{
		if($request->ajax()) {
			$office = Office::findOrFail($id);
			return datatables($office)->toJson();
		}

		return view('maintenance.office.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$office = Office::findOrFail($id);
		return view('maintenance.office.edit', compact('office'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(OfficeUpdateRequest $request, $id)
	{
		$this->dispatch(new UpdateOffice($request->all(), $id));
		return redirect('maintenance/office');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request, $id)
	{
		$this->dispatch(new RemoveOffice($request->all(), $id));	
		return redirect('maintenance/office');
	}

}
