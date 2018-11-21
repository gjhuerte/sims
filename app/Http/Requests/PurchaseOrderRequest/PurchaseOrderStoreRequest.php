<?php

namespace App\Http\Requests\PurchaseOrderRequest;

use App\Models\PurchaseOrder\PurchaseOrder;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderStoreRequest extends FormRequest
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
        $purchaseorder = PurchaseOrder::findOrFail($this->purchaseorder);
        return [
            'number' => 'required|unique:purchaseorders,number,' . $purchaseorder->number . ',number',
            'date' => 'required|date',
            'quantity' => 'nullable|integer|min:0'
        ];
    }
}
