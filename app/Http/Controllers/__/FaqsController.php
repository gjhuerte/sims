<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;
use Validator;

class FaqsController extends Controller
{
    public function index(Request $request)
    {	
    	$faqs = new App\Faqs;

    	if($request->has('search'))
    	{
    		$search = $this->sanitizeString($request->get('search'));
    		$faqs = $faqs->where('title', 'like', "%$search%")->orWhere('description', 'like', "%$search%");
    	}

    	$faqs = $faqs->orderBy('reads', 'desc')->orderBy('created_at', 'desc')->orderBy('importance', 'desc')->paginate(20);

    	return view('faqs.index')
    			->with('faqs', $faqs)
                ->with('link_limit', '7');
    }

    public function createIssue(Request $request)
    {
    	return view('faqs.create');
    }	

    public function storeIssue(Request $request)
    {
    	$title = $this->sanitizeString($request->get('title'));
    	$description = $this->sanitizeString($request->get('description'));

    	$faqs = new App\Faqs;

    	$validator = Validator::make([
    		'title' => $title,
    		'description' => $description
    	], $faqs->rules());

    	if($validator->fails())
    	{
    		return back()->withInput()->withErrors($validator);
    	}

    	$faqs->title = $title;
    	$faqs->description = $description;
    	$faqs->user_id = Auth::user()->id;
    	$faqs->save();

		\Alert::success("Question submitted!")->flash();
    	return redirect('faqs');
    }
}
