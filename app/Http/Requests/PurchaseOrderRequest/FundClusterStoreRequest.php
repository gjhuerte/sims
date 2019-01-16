<?php

namespace App\Http\Requests\PurchaseOrderRequest;

use Illuminate\Foundation\Http\FormRequest;

class FundClusterStoreRequest extends FormRequest
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
            'code' => 'required|string|max:256|unique:fundclusters,code',
            'description' => 'required|string|max:256'
        ];
    }
}
