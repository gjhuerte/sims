<?php

namespace App\Http\Requests\SupplyRequest;

use Illuminate\Foundation\Http\FormRequest;

class SupplyStoreRequest extends FormRequest
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
            'stock_number' => 'required|unique:supplies,stocknumber',
            'details' => 'required|unique:supplies,details|max:256',
            'unit' => 'required|max:256',
            'reorder_point' => 'required|integer|max:256'
        ];
    }
}
