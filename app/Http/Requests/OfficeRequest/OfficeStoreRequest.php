<?php

namespace App\Http\Requests\OfficeRequest;

use Illuminate\Foundation\Http\FormRequest;

class OfficeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'code' => 'required|string|max:20|unique:offices,code',
			'name' => 'required|string|max:200',
			'description' => 'nullable|string|max:200'
        ];
    }
}
