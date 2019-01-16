<?php

namespace App\Http\Requests\RequisitionRequest;

use Illuminate\Foundation\Http\FormRequest;

class ApprovalStoreRequest extends FormRequest
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
            'stock' => 'required|array',
            'stock.*' => 'required|string|exists:supplies,stocknumber',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
            'remarks' => 'required|string|max:256',
        ];
    }
}
