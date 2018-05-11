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

class AdjustmentsController extends Controller
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
			$adjustments = App\Adjustment::all();
			return datatables($adjustments)->toJson();
		}
		return view('adjustment.index')
					->with('title','Adjustment');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('adjustment.create')
					->with('title','Adjustment')
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
		$details = $request->get('details');
		$created_by = Auth::user()->firstname . " " . Auth::user()->middlename . " " . Auth::user()->lastname ;

		DB::beginTransaction();

		$adjustment = App\Adjustment::create([
			'created_by' => $created_by,
			'details' => $details,
			'status' => $status
		]);

		foreach(array_flatten($stocknumbers) as $stocknumber)
		{
			if($stocknumber == '' || $stocknumber == null || !isset($stocknumber))
			{
			  \Alert::error('Encountered an invalid stock! Resetting table')->flash();
			   return redirect("adjustment/create");
			}

			$validator = Validator::make([
			    'Stock Number' => $stocknumber,
			    'Quantity' => $quantity["$stocknumber"]
			],App\Adjustment::$rules);

			if($validator->fails())
			{
			    return redirect("adjustment/create")
			            ->with('total',count($stocknumbers))
			            ->with('stocknumber',$stocknumbers)
			            ->with('quantity',$quantity)
			            ->with('unitcost',$unitcost)
			            ->withInput()
			            ->withErrors($validator);
			}

			$supply = App\Supply::findByStockNumber($stocknumber);

			array_push($array,[
			    'quantity' => $quantity["$stocknumber"],
			    'supply_id' => $supply->id,
			    'unitcost' => $unitcost["$stocknumber"]
			]);

			$transaction = new App\StockCard;
			$transaction->date = Carbon\Carbon::now();
			$transaction->stocknumber = $supply->stocknumber;
			$transaction->reference = "Adjustment#$adjustment->code";
			$transaction->receipt = null;
			$transaction->organization = null;
			$transaction->received_quantity = $quantity["$stocknumber"];
			$transaction->daystoconsume = null;
			$transaction->user_id = Auth::user()->id;
			$transaction->receipt();
		}

		$adjustment->supplies()->sync($array);

		DB::commit();

		\Alert::success('Adjustment Report Created')->flash();
		return redirect('adjustment');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request, $id = null)
	{
		$adjustment = App\Adjustment::find($id);

		if(count($adjustment) <= 0) return view('errors.404');

		if($request->ajax())
		{
			return json_encode([
				'data' => $adjustment->supplies
			]);
		}

		return view('adjustment.show')
				->with('adjustment', $adjustment);
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
		return view("adjustment.edit")
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
	 * dispose items
	 */
	public function dispose(Request $request)
	{
		return view('adjustment.dispose')
				->with('title', 'Adjustment')
				->with('action', 'dispose');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request)
	{
		$stocknumbers = $request->get("stocknumber");
		$quantity = $request->get("quantity");
		$unitcost = $request->get("unitcost");
		$array = [];
		$status = null;
		$details = $request->get('details');
		$created_by = Auth::user()->firstname . " " . Auth::user()->middlename . " " . Auth::user()->lastname ;

		DB::beginTransaction();

		$adjustment = App\Adjustment::create([
			'created_by' => $created_by,
			'details' => $details,
			'status' => $status
		]);

		foreach(array_flatten($stocknumbers) as $stocknumber)
		{
			if($stocknumber == '' || $stocknumber == null || !isset($stocknumber))
			{
			  \Alert::error('Encountered an invalid stock! Resetting table')->flash();
			   return redirect("adjustment/create");
			}

			$validator = Validator::make([
			    'Stock Number' => $stocknumber,
			    'Quantity' => $quantity["$stocknumber"]
			],App\Adjustment::$rules);

			if($validator->fails())
			{
			    return redirect("adjustment/create")
			            ->with('total',count($stocknumbers))
			            ->with('stocknumber',$stocknumbers)
			            ->with('quantity',$quantity)
			            ->with('unitcost',$unitcost)
			            ->withInput()
			            ->withErrors($validator);
			}

			$supply = App\Supply::findByStockNumber($stocknumber);

			array_push($array,[
			    'quantity' => $quantity["$stocknumber"],
			    'supply_id' => $supply->id,
			    'unitcost' => $unitcost["$stocknumber"]
			]);

			$transaction = new App\StockCard;
			$transaction->date = Carbon\Carbon::now();
			$transaction->stocknumber = $supply->stocknumber;
			$transaction->reference = "Adjustment#$adjustment->code";
			$transaction->receipt = null;
			$transaction->organization = null;
			$transaction->issued_quantity = $quantity["$stocknumber"];
			$transaction->daystoconsume = null;
			$transaction->user_id = Auth::user()->id;
			$transaction->issue();
		}

		$adjustment->supplies()->sync($array);

		DB::commit();

		\Alert::success('Adjustment Report Created')->flash();
		return redirect('adjustment');
	}

	public function print($id)
	{

      $id = $this->sanitizeString($id);
      $adjustment = App\Adjustment::find($id);
      $orientation = 'Portrait';
      $data = [
        'adjustment' => $adjustment
      ];

      $filename = "AdjustmentReport-".Carbon\Carbon::now()->format('mdYHm')."-$adjustment->code".".pdf";
      $view = "adjustment.print_show";

      return $this->printPreview($view,$data,$filename,$orientation);
	}
}
