<?php

namespace App\Http\Controllers;
use App;
use Carbon;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class DepartmentController extends Controller 
{
    public function index(Request $request)
	{
		if($request->ajax())
		{
			return datatables(App\Office::with('office'))->toJson();
		}
		return view('maintenance.department.index');
	}

	public function create()
	{
		return view('maintenance.department.create')
					->with('title','Department')
					->with('office',App\Office::pluck('name','id'));
	}

	public function store()
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
		],$department->rules());

		if($validator->fails())
		{
			return redirect('maintenance/department/create')
				->withInput()
				->withErrors($validator);
		}
		$department->abbreviation = $abbreviation;
		$department->name = $name;
		$department->office_id = $office;
		$department->head = $head;
		$department->designation = $designation;
		$department->save();

		\Alert::success('Department Added')->flash();
		return redirect("maintenance/office/$office");
	}

	public function edit($id)
	{
		$department = App\Department::find($id);

		if(count($department) <= 0)
		{
			return view('errors.404');
		}
		return view("maintenance.department.edit")
				->with('department',$department)
				->with('office',App\Office::pluck('name','id'));
	}

		public function update($id)
	{
		$name = $this->sanitizeString(Input::get('name'));
		$abbreviation = $this->sanitizeString(Input::get('abbreviation'));
		$office = $this->sanitizeString(Input::get('office'));
		$head = $this->sanitizeString(Input::get('head'));
		$designation = $this->sanitizeString(Input::get('designation'));

		$department = App\Department::find($id);

		$validator = Validator::make([
			'Name' => $name,
			'Abbreviation' => $abbreviation,
			'Head' => $head,
			'Designation' => $designation
		],$department->updateRules());

		if($validator->fails())
		{
			return redirect("maintenance/department/$id/edit")
				->withInput()
				->withErrors($validator);
		}
		$department->abbreviation = $abbreviation;
		$department->name = $name;
		$department->office_id = $office;
		$department->head = $head;
		$department->designation = $designation;
		$department->save();

		\Alert::success('Department Updated')->flash();
		return redirect('maintenance/department');
	}

	public function destroy(Request $request, $id)
	{
		if($request->ajax())
		{
			$department = App\Department::find($id);
			$department->delete();
			return json_encode('success');
		}

		try
		{
			$department = App\Department::find($id);
			$department->delete();
			\Alert::success('department Removed')->flash();
		} catch (Exception $e) {
			\Alert::error('Problem Encountered While Processing Your Data')->flash();
		}
		return redirect('maintenance/department');
	}

}
