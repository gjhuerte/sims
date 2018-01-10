<?php

namespace App\Http\Controllers;

use App;
use Carbon;
use Session;
use Validator;
use DB;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class DisposalsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if($request->ajax())
		{
			$disposals = App\Disposal::all();
			return datatables($disposals)->toJson();
		}
		return view('disposal.index')
					->with('title','Disposal');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('disposal.create')
					->with('title','Disposal')
					->with('action', 'create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$stocknumbers = $request->get("stocknumber");
		$quantity = $request->get("quantity");
		$unitcost = $request->get("unitcost");
		$array = [];
		$status = null;
		$created_by = Auth::user()->firstname . " " . Auth::user()->middlename . " " . Auth::user()->lastname ;

		foreach(array_flatten($stocknumbers) as $stocknumber)
		{
			if($stocknumber == '' || $stocknumber == null || !isset($stocknumber))
			{
			  \Alert::error('Encountered an invalid stock! Resetting table')->flash();
			   return redirect("disposal/create");
			}

			$validator = Validator::make([
			    'Stock Number' => $stocknumber,
			    'Quantity' => $quantity["$stocknumber"]
			],App\Disposal::$rules);

			if($validator->fails())
			{
			    return redirect("disposal/create")
			            ->with('total',count($stocknumbers))
			            ->with('stocknumber',$stocknumbers)
			            ->with('quantity',$quantity)
			            ->with('unitcost',$unitcost)
			            ->withInput()
			            ->withErrors($validator);
			}

			array_push($array,[
			    'quantity' => $quantity["$stocknumber"],
			    'supply_id' => App\Supply::findByStockNumber($stocknumber)->id,
			    'unitcost' => $unitcost["$stocknumber"]
			]);
		}

		DB::beginTransaction();

		$disposal = App\Disposal::create([
			'created_by' => $created_by,
			'status' => $status
		]);

		$disposal->supplies()->sync($array);

		DB::commit();

		\Alert::success('Disposal Report Created')->flash();
		return redirect('disposal');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request, $id = null)
	{
		$disposal = App\Disposal::find($id);
		if($request->ajax())
		{
			return json_encode([
				'data' => $disposal->supplies
			]);
		}

		return view('disposal.show')
				->with('disposal', $disposal);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$id = $this->sanitizeString($id);
		$category = App\Category::find($id);

		if(count($category) <= 0)
		{
			return view('errors.404');
		}
		return view("disposal.edit")
				->with('category',$category)
				->with('title','Category');
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$id = $this->sanitizeString($id);
		$name = $this->sanitizeString(Input::get('name'));
		$code = $this->sanitizeString(Input::get('code'));

		$category = App\Category::find($id);

		$validator = Validator::make([
			'Name' => $name,
			'Code' => $code
		],$category->updateRules());

		if($validator->fails())
		{
			return redirect("maintenance/category/$id/edit")
				->withInput()
				->withErrors($validator);
		}

		$category->uacs_code = $code;
		$category->name = $name;
		$category->save();

		\Alert::success('Category Information Updated')->flash();
		return redirect('maintenance/category');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request, $id)
	{
			$id = $this->sanitizeString($id);

			if($request->ajax())
			{
				$category = App\Category::find($id);

				if(count($category) <= 0) return json_encode('error');
				$category->delete();
				return json_encode('success');
			}

			$category = App\Category::find($id);
			if(count($category) <= 0) \Alert::error('Problem Encountered While Processing Your Data')->flash();
			$category->delete();
			\Alert::success('Category Removed')->flash();

			return redirect('maintenance/category');
	}

	public function print($id)
	{

      $id = $this->sanitizeString($id);
      $disposal = App\Disposal::find($id);

      $data = [
        'disposal' => $disposal
      ];

      $filename = "DisposalReport-".Carbon\Carbon::now()->format('mdYHm')."-$disposal->code".".pdf";
      $view = "disposal.print_show";

      return $this->printPreview($view,$data,$filename);
	}
}
