<?php

namespace App\Http\Requests\LedgerRequest;

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
            'Date' => 'required',
            'Stock Number' => 'required',
            'Receipt Quantity' => 'required',
            'Receipt Unit Cost' => 'required',
            'Days To Consume' => 'max:100'
        ];
    }
}
