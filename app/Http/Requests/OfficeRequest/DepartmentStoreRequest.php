<?php

namespace App\Http\Requests\OfficeRequest;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentStoreRequest extends FormRequest
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
			'name' => 'required|max:200',
			'head' => 'nullable|string|max:100',
			'designation' => 'nullable|string|max:100',
			'abbreviation' => 'nullable|string|max:20'
        ];
    }
}
