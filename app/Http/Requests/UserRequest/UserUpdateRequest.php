<?php

namespace App\Http\Requests\UserRequest;

use App\Models\User\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $user = User::findOrFail($this->user);
        return [
            'username' => 'min:3|max:20|unique:users,username,' . $user->username . ',username',
            'firstname' => 'min:2|max:100|string',
            'middlename' => 'min:1|max:50|string',
            'lastname' => 'min:2|max:50|string',
            'email' => 'email',
            'office' => 'required|exists:offices,code'
        ];
    }
    
    public function validationData()
    {
        if (method_exists($this->route(), 'parameters')) {
            $this->request->add($this->route()->parameters('id'));
            $this->query->add($this->route()->parameters('id'));

            return array_merge($this->route()->parameters(), $this->all());
        }

        return $this->all();
    }
}
