<?php
namespace App\Http\Controllers;

use App\Office;
use Carbon;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
class OfficeController extends Controller {

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
				'data' => Office::all()
			]);
		}
		return view('maintenance.office.index')
					->with('title','Office');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('maintenance.office.create')
					->with('title','Office');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$deptname = $this->sanitizeString(Input::get('deptname'));
		$deptcode = $this->sanitizeString(Input::get('deptcode'));

		$validator = Validator::make([
			'Department Name' => $deptname,
			'Department Code' => $deptcode
		],Office::$rules);

		if($validator->fails())
		{
			return redirect('maintenance/office/create')
				->withInput()
				->withError($validator);
		}

		$office = new Office;
		$office->deptcode = $deptcode;
		$office->deptname = $deptname;
		$office->save();

		Session::flash("success-message",'Office added');
		return redirect('maintenance/office');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$office = Office::find($id);
		return view("maintenance.office.edit")
				->with('office',$office)
				->with('title','Office');
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$deptname = $this->sanitizeString(Input::get('deptname'));
		$deptcode = $this->sanitizeString(Input::get('deptcode'));

		$validator = Validator::make([
			'Department Name' => $deptname,
			'Department Code' => $deptcode
		],Office::$rules);

		if($validator->fails())
		{
			return redirect("maintenance/office/$id/edit")
				->withInput()
				->withError($validator);
		}

		$office = Office::find($id);
		$office->deptcode = $deptcode;
		$office->deptname = $deptname;
		$office->save();

		Session::flash('success-message','Office Information Updated');
		return redirect('maintenance/office');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Request::ajax())
		{
			$office = Office::find($id);
			$office->delete();
			return json_encode('success');
		}

		try
		{
			$office = Office::find($id);
			$office->delete();
			Session::flash('success-message','Office Removed');
		} catch (Exception $e) {
			Session::flash('error-message','Problem Encountered While Processing Your Data');
		}
		return redirect('maintenance/office');
	}

	public function getAllCodes()
	{
		if(Request::ajax())
		{
			return json_encode(Office::pluck('deptcode')->toArray());
		}
	}

	public function getOfficeCode()
	{
		if(Request::ajax())
		{
			$code = $this->sanitizeString(Input::get('term'));
			return json_encode(Office::where('deptcode','like','%'.$code.'%')->pluck('deptcode')->toArray());
		}
	}


}
