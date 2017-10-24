<?php

namespace Backpack\Settings\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'key' => 'required|min:3|max:255',
            // 'name' => 'required|min:3|max:255',
            // 'field' => 'required'
        ];
    }
}
