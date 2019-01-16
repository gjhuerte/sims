<?php

namespace App\Http\Requests\InspectionRequest;

use Illuminate\Foundation\Http\FormRequest;

class InspectionStoreRequest extends FormRequest
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
            'Date' => 'required|date',
            'stock' => 'required|array',
            'stock.*' => 'required|exists:supplies,stocknumber',
            'purchase_order' => 'nullable',
            'delivery_receipt' => 'nullable',
            'office' => 'nullable',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
            'Days To Consume' => 'nullable|max:100',
        ];
    }
}
