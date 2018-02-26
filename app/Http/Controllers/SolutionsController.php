<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Validator;
use Auth;

class SolutionsController extends Controller
{

	public function index($id)
	{
		$id = $this->sanitizeString($id);
		$faq = App\Faqs::find($id);
		$solutions = $faq->solutions()->paginate(20);

		$faq->increment('reads');

		return view('faqs.show')
				->with('faq', $faq)
				->with('solutions', $solutions);
	}

    public function createSolution(Request $request, $id)
    {
		$id = $this->sanitizeString($id);
		$faq = App\Faqs::find($id);

    	return view('faqs.create-solution')
    			->with('faq', $faq);

    }

    public function storeSolution(Request $request, $id)
    {
    	$title = $this->sanitizeString($request->get('title'));
    	$description = $this->sanitizeString($request->get('description'));
		$id = $this->sanitizeString($id);
		$faq = App\Faqs::find($id);

    	$solution = new App\Solution;

    	$validator = Validator::make([
    		'title' => $title,
    		'description' => $description
    	], $solution->rules());

    	if($validator->fails())
    	{
    		return back()->withInput()->withErrors($validator);
    	}

    	$solution->title = $title;
    	$solution->description = $description;
    	$solution->faqs_id = $faq->id;
    	$solution->user_id = Auth::user()->id;
    	$solution->save();

		\Alert::success("Solution submitted!")->flash();
    	return redirect("question/$faq->id/solution");

    }
}
