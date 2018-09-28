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
			return datatables(App\Office::All())->toJson();
		}
		return view('maintenance.department.index');
	}

	public function create()
	{

		$office = App\Office::where('code','NOT LIKE','%-A%')->orderBy('name')->pluck('name','id');
		return view('maintenance.department.create')
					->with('title','Department')
					->with('office',$office);
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

		$department = new App\Office;
		$department->code = $abbreviation;
		$department->name = $name;
		$department->head_office = $office;
		$department->head = $head;
		$department->head_title = $designation;
		$department->save();

		\Alert::success('Department Added')->flash();
		return redirect("maintenance/office/$office");
	}

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

		return view('maintenance.department.show')
				->with('title', "$office->code")
				->with('office', $office);
	}

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

	public function update($id)
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

	public function destroy(Request $request, $id)
	{
		if($request->ajax())
		{
			$department = App\Office::find($id);
			$department->delete();
			return json_encode('success');
		}

		try
		{
			$department = App\Office::find($id);
			$department->delete();
			\Alert::success('department Removed')->flash();
		} catch (Exception $e) {
			\Alert::error('Problem Encountered While Processing Your Data')->flash();
		}

		return redirect("maintenance/office/$id");
	}

}
