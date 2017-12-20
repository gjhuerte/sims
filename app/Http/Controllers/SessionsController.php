<?php
namespace App\Http\Controllers;
	
use App\User;
use Carbon;
use Session;
use Validator;
use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class SessionsController extends Controller {

use AuthenticatesUsers;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('pagenotfound');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('login');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
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
	public function edit()
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
	public function update()
	{
		$lastname = $this->sanitizeString(Input::get('lastname'));
		$firstname = $this->sanitizeString(Input::get('firstname'));
		$middlename = $this->sanitizeString(Input::get('middlename'));
		$email = $this->sanitizeString(Input::get('email'));
		$password = $this->sanitizeString(Input::get('password'));
		$newpassword = $this->sanitizeString(Input::get('newpassword'));

		$user = User::find(Auth::user()->id);

		$validator = Validator::make([
			'Lastname'=>$lastname,
			'Firstname'=>$firstname,
			'Middlename'=>$middlename,
			'Email' => $email
		],User::$informationRules);

		if( $validator->fails() )
		{
			return redirect('settings')
				->withInput()
				->withErrors($validator);
		}

		if(!($password == "" && $newpassword == "")){
			$confirm = $this->sanitizeString(Input::get('newpassword_confirmation'));

			$validator = Validator::make([
				'Current Password'=>$password,
				'New Password'=>$newpassword,
				'Confirm Password' => $confirm
			],User::$passwordRules);

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
	public function destroy()
	{
		//remove everything from session
		Session::flush();
		//remove everything from auth
		Auth::logout();
		return redirect('login');
	}

}
