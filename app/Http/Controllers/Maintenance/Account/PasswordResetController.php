<?php

namespace App\Http\Controllers\Maintenance\Account;

use Illuminate\Http\Request;
use App\Jobs\Account\ResetPassword;
use App\Http\Controllers\Controller;

class PasswordResetController extends Controller
{

	/**
	 * Resets the password of the user specified in the
	 * query parameter
	 *
	 * @param Request $request
	 * @param integer $id
	 * @return Response
	 */
	public function reset(Request $request, $id)
	{
		$this->dispatch(new ResetPassword($id));
		return redirect('user');
	}
}
