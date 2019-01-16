<?php

namespace App\Http\Requests\FactRequest;

use Illuminate\Foundation\Http\FormRequest;

class SolutionStoreRequest extends FormRequest
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
    		'title' => 'required|string|min:5|max:30',
    		'details' => 'nullable|string|max:800'
        ];
    }
}
