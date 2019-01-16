<?php

namespace App\Http\Requests\UserRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required_with:password|min:3|max:20|unique:users,username',
            'password' => 'required|min:8|max:50',
            'firstname' => 'required|between:2,100|string',
            'middlename' => 'min:1|max:50|string',
            'lastname' => 'required|min:2|max:50|string',
            'email' => 'email',
            'office' => 'required|exists:offices,code'
        ];
    }
}
