<?php

namespace App\Http\Requests\UnitRequest;

use Illuminate\Foundation\Http\FormRequest;

class UnitStoreRequest extends FormRequest
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
            'name' => 'required|unique:units,name',
            'description' => 'required|max:256',
            'abbreviation' => 'required|unique:units,abbreviation'
        ];
    }
}
