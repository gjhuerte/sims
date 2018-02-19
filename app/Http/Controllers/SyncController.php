<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SyncController extends Controller
{
	/**
	 * return resources 
	 * 
	 */
    public function getSync(Request $request)
    {
    	return view('sync.index');
    }

    /**
     * sync the transactions
     * based on the input of the user
     */
    public function sync(Request $request)
    {

    }
}
