<?php
namespace App\Http\Controllers;
	
use App;
use DB;
use Carbon;
use Session;
use Validator;
use Hash;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		return view('pagenotfound');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		return view('login');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request)
	{
		$person = Auth::user();
		return view('user.index')
			->with('person',$person);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Request $request)
	{
		$user = Auth::user();
		return view('user.edit')
				->with("user",$user);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		$lastname = $this->sanitizeString($request->get('lastname'));
		$firstname = $this->sanitizeString($request->get('firstname'));
		$middlename = $this->sanitizeString($request->get('middlename'));
		$email = $this->sanitizeString($request->get('email'));
		$password = $this->sanitizeString($request->get('password'));
		$newpassword = $this->sanitizeString($request->get('newpassword'));

		$user = App\User::find(Auth::user()->id);

		$validator = Validator::make([
			'Lastname'=>$lastname,
			'Firstname'=>$firstname,
			'Middlename'=>$middlename,
			'Email' => $email
		], App\User::$informationRules);

		if( $validator->fails() )
		{
			return redirect('settings')
				->withInput()
				->withErrors($validator);
		}

		if(!($password == "" && $newpassword == "")){
			$confirm = $this->sanitizeString($request->get('newpassword_confirmation'));

			$validator = Validator::make([
				'Current Password'=>$password,
				'New Password'=>$newpassword,
				'Confirm Password' => $confirm
			], App\User::$passwordRules);

			if( $validator->fails() )
			{
				return redirect('settings')
					->withInput()
					->withErrors($validator);
			}

			//verifies if password inputted is the same as the users password
			if(Hash::check($password,Auth::user()->password))
			{

				//verifies if current password is the same as the new password
				if(Hash::check($newpassword,Auth::user()->password)){
					Session::flash('error-message','Your New Password must not be the same as your Old Password');
					return redirect('settings')
						->withInput()
						->withErrors($validator);
				}else{

					$user->password = Hash::make($newpassword);
				}
			}else{

				Session::flash('error-message','Incorrect Password');
				return redirect('settings')
					->withInput();
			}

		}

		$user->firstname = $firstname;
		$user->middlename = $middlename;
		$user->lastname = $lastname;
		$user->email = $email;	
		$user->save();

		Session::flash('success-message','Information updated');
		return redirect('settings');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request)
	{
		//remove everything from session
		Session::flush();
		//remove everything from auth
		Auth::logout();
		return redirect('login');
	}

	// public function getHrisLogin(Request $request)
	// {
	// 	return view('hris');
	// }

	// public function hrisLogin(Request $request)
	// {
	// 	try{

	// 		$username = $this->sanitizeString($request->get('username'));
	// 		$password = $this->sanitizeString($request->get('password'));

	// 		$hris = DB::connection('sqlsrv')->select('exec ValidateLogin ?,?', [
	// 			$username,
	// 			$password
	// 		]);

	// 		$hris = collect($hris)->first();
	// 		$user = App\User::findByUserName($hris->UserName)->first();

	// 		if(count($user) <= 0) $user = new App\User;

	// 		$user->username = $hris->UserName;
	// 		$user->firstname = $hris->FName;
	// 		$user->middlename = $hris->MName;
	// 		$user->lastname = $hris->LName;
	// 		$user->password = Hash::make($password);
	// 		$user->department = $hris->DepartmentCode;
	// 		$user->office = $hris->ParentDepartmentCode;
	// 		$user->position = $hris->PlantillaPosition;
	// 		$user->status = 1;
	// 		$user->access = 3;
	// 		$user->save();

	// 		$user_information = [
	// 			'username' => $username,
	// 			'password' => $password
	// 		];

	// 		if(Auth::attempt($user_information)){
	// 			return redirect('/');
	// 		}


	// 	} catch(\Illuminate\Database\QueryException $ex){
	// 			return back()->withInput()->withErrors([ 'username' => 'Invalid Login Credentials']);
	// 	}

	// 	return redirect('/');
	// }

	public function getLogin(Request $request)
	{
		return view('login');
	}

	public function login(Request $request, App\User $user)
	{
		$username = $this->sanitizeString($request->get('username'));
		$password = $this->sanitizeString($request->get('password'));

		$validator = Validator::make([
			'username' => $username, 
			'password' => $password
		], $user->loginRules());

		if($validator->fails())
		{
			return back()->withInput()->withErrors($validator);
		}
		
		$user_information = [
			'username' => $username,
			'password' => $password
		];

		if(Auth::attempt($user_information)){
			return redirect('/');
		}
		else{
			// return back()->withInput()->withErrors(["Invalid Credentials Submitted. Are you using H.R.I.S. Account? Click 'Use HRIS Credentials' and log in to your HRIS Account  " ]);
			return back()->withInput()->withErrors(["Invalid Credentials Submitted. " ]);
		}

	}

}
