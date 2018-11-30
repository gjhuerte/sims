<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller 
{
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index(Request $request)
	{
		if($request->ajax()) {
			return datatables(Office::all())->toJson();
		}
		return view('maintenance.department.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$departments = Office::where('code', 'NOT LIKE', '%-A%')->orderBy('name')->pluck('name', 'id');
		return view('maintenance.department.create', compact('departments'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(DepartmentStoreRequest $request)
	{
		$this->dispatch(new CreateDepartment($request->all()));
		return redirect('maintenance/office/' . $office);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request, $id = null)
	{
		$id = $this->sanitizeString($id);
		$office = App\Office::find($id);

		if($request->ajax())
		{

			if(Input::has('term'))
			{
				$code = $this->sanitizeString(Input::get('term'));
				return json_encode( App\Office::where('code','like','%'.$code.'%')->pluck('code')->toArray());
			}

			if(count($office) > 0 )
			{
				return datatables($office->departments)->toJson();
			}

			return json_encode([
				'data' => App\Office::findByCode($id)
			]);
		}

		if(count($office) <= 0 )
		{
			 return view('errors.404');
		}

		return view('maintenance.department.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$department = App\Department::find($id);
		$office = App\Office::where('code','NOT LIKE','%-A%')->orderBy('name')->pluck('name','id');
		if(count($department) <= 0)
		{
			return view('errors.404');
		}
		return view("maintenance.department.edit")
				->with('department',$department)
				->with('office', $office);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(DepartmentUpdateRequest $request, $id)
	{
		$name = $this->sanitizeString(Input::get('name'));
		$abbreviation = $this->sanitizeString(Input::get('abbreviation'));
		$office = $this->sanitizeString(Input::get('office'));
		$head = $this->sanitizeString(Input::get('head'));
		$designation = $this->sanitizeString(Input::get('designation'));

		$department = new App\Department;

		$validator = Validator::make([
			'Name' => $name,
			'Abbreviation' => $abbreviation,
			'Head' => $head,
			'Designation' => $designation
		],$department->updateRules());
		
		$department = App\Office::find($id);

		if($validator->fails())
		{
			return redirect("maintenance/department/$department->head_office/edit")
				->withInput()
				->withErrors($validator);
		}

		$department->code = $abbreviation;
		$department->name = $name;
		$department->head_office = $office;
		$department->head = $head;
		$department->head_title = $designation;
		$department->save();

		\Alert::success('Department Updated')->flash();
		return redirect("maintenance/office/$department->head_office");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request, $office, $department)
	{
		$this->dispatch(new RemoveDepartment($request, $office, $department));
		return redirect('maintenance/office/' . $office);
	}

}
