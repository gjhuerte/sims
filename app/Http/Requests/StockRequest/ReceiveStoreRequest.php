<?php

namespace App\Http\Requests\StockRequest;

use Illuminate\Foundation\Http\FormRequest;

class ReceiveStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'Date' => 'required',
            'Stock Number' => 'required',
            'Purchase Order' => 'nullable',
            'Delivery Receipt' => 'nullable',
            'Office' => '',
            'Receipt Quantity' => 'required|integer',
            'Days To Consume' => 'max:100'
        ];
    }
}
