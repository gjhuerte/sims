<?php

namespace App\Http\Controllers\Maintenance\Account;

use App\Models\User\User;
use Illuminate\Http\Request;
use App\Models\Office\Office;
use App\Jobs\Account\CreateAccount;
use App\Jobs\Account\UpdateAccount;
use App\Jobs\Account\RemoveAccount;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest\UserStoreRequest;
use App\Http\Requests\UserRequest\UserUpdateRequest;

class AccountsController extends Controller 
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if($request->ajax()) {
			$users = User::all();
			return datatables($users)->toJson();
		}

		return view('account.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$offices = Office::orderBy('name')->pluck('name', 'code');
		return view('account.create', compact('offices'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UserStoreRequest $request)
	{
		$this->dispatch(new CreateUser($request->all()));
		return redirect('account');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$person = User::findOrFail($id);
		return view('account.show', compact('person'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::findOrFail($id);
		$offices = Office::orderBy('name')->pluck('name', 'code');

		return view('account.update', compact('user', 'offices'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$this->dispatch(new UpdateUser($request->all(), $id));
		return redirect('account');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request,$id)
	{
		$this->dispatch(new RemoveUser($id));
		return redirect('account');
	}
}
