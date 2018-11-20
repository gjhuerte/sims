<?php

namespace App\Http\Requests\FactRequest;

use Illuminate\Foundation\Http\FormRequest;

class FactStoreRequest extends FormRequest
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
    		'title' => 'required|min:5|max:30',
    		'description' => 'max:800'
        ];
    }
}
