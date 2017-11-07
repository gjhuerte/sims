<?php

namespace App\Http\Controllers;

use App;
use Auth;
use Hash;
use Carbon;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AccountsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if($request->ajax())
		{
			return json_encode([
				'data' => App\User::all()
			]);
		}
		return view('account.index')
				->with('title','Accounts');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('account.create')
				->with('title','Accounts')
				->with('office',App\Office::pluck('deptname','deptcode'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$lastname = $this->sanitizeString(Input::get('lastname'));
		$firstname = $this->sanitizeString(Input::get('firstname'));
		$middlename = $this->sanitizeString(Input::get('middlename'));
		$username = $this->sanitizeString(Input::get('username'));
		$contactnumber = $this->sanitizeString(Input::get('contactnumber'));
		$email = $this->sanitizeString(Input::get('email'));
		$password = $this->sanitizeString(Input::get('password'));
		$type = $this->sanitizeString(Input::get('type'));
		$office = $this->sanitizeString(Input::get('office'));

		$validator = Validator::make([
			'Lastname' => $lastname,
			'Firstname' => $firstname,
			'Middlename' => $middlename,
			'Username' => $username,
			'Email' => $email,
			'Password' => $password,
			'Office' => $office
		],App\User::$rules);

		if($validator->fails())
		{
			return redirect('account/create')
				->withErrors($validator)
				->withInput();
		}

		$user = new App\User;
		$user->lastname = $lastname;
		$user->firstname = $firstname;
		$user->middlename = $middlename;
		$user->username = $username;
		$user->email = $email;
		$user->office = $office;
		$user->password = Hash::make($password);
		$user->status = '1';

		if($type == 'admin')
		$user->accesslevel = '0';
		if($type == 'amo')
		$user->accesslevel = '1';
		if($type == 'accounting')
		$user->accesslevel = '2';
		if($type == 'colleges')
		$user->accesslevel = '3';

		$user->save();

		Session::flash("success-message","Account successfully created!");

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
		$user = User::find($id);
		return view('account.show')
			->with('person',$user)
			->with('title','Accounts');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(isset($id)){
			$user = User::find($id);
			return view('account.update')
				->with('user',$user)
				->with('title','Accounts')
				->with('office',App\Office::pluck('deptname','deptcode'));
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$lastname = $this->sanitizeString(Input::get('lastname'));
		$firstname = $this->sanitizeString(Input::get('firstname'));
		$middlename = $this->sanitizeString(Input::get('middlename'));
		$email = $this->sanitizeString(Input::get('email'));
		$username = $this->sanitizeString(Input::get('username'));
		$office = $this->sanitizeString(Input::get('office'));

		$validator = Validator::make([
			'Lastname' => $lastname,
			'Firstname' => $firstname,
			'Middlename' => $middlename,
			'Email' => $email,
			'Office' => $office,
			'Username' => 'sampleusernameonly',
		],User::$informationRules);

		if($validator->fails())
		{
			return redirect("account/$id/edit")
				->withInput()
				->withErrors($validator);
		}

		$user = User::find($id);
		$user->username = $username;
		$user->lastname = $lastname;
		$user->firstname = $firstname;
		$user->middlename = $middlename;
		$user->office = $office;
		$user->email = $email;

		$user->save();

		Session::flash('success-message','Account information updated');
		return redirect('account');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Request::ajax()){
			try{

				$user = User::select('id')->get();
				if($id == Auth::user()->id)
				{
					return json_encode('self');
				}
				else if(count($user) <= 1)
				{
					return json_encode('invalid');
				}
				else
				{
					$user = User::find($id);
					if($user->accesslevel == 2)
						return json_encode('invalid');
					$user->delete();
					return json_encode('success');
				}
			} catch (Exception $e) {}
		}

		try{
			$user = User::find($id);
			$user->delete();
		} catch (Exception $e) {
			Session::flash('error_message','Error Ocurred while processing your data');
			return Redirect::back();
		}
		Session::flash('success-message','Account deleted!');
		return redirect('account/view/delete');
	}

	/**
	 * Change User Password to Default '12345678'
	 *
	 * user id
	 *@param  int  $id
	 */
	public function resetPassword()
	{
		if(Request::ajax())
		{
			$id = $this->sanitizeString(Input::get('id'));
		 	$user = User::find($id);
		 	$user->password = Hash::make('12345678');
		 	$user->save();

		 	return json_encode('success');
		}
	}

	public function changeAccessLevel()
	{
		$id = $this->sanitizeString(Input::get("id"));
		$access = $this->sanitizeString(Input::get('newaccesslevel'));

		try
		{

			if(Auth::user()->accesslevel != 0)
			{

				Session::flash('error-message','You do not have enough priviledge to change the users access level');
				return redirect('account');
			}

			$user = User::find($id);
			$user->accesslevel = $access;
			$user->save();

			Session::flash('success-message','Access Level Switched');
			return redirect('account');
		} catch (Exception $e){

			Session::flash('error-message','Error occurred while switching access level');
			return redirect('account');
		}
	}
}
