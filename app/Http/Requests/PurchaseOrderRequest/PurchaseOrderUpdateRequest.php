<?php

namespace App\Http\Requests\PurchaseOrderRequest;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderUpdateRequest extends FormRequest
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
            'number' => 'required|unique:purchaseorders,number',
            'date' => 'required|date',
            'quantity' => 'nullable|integer|min:0'
        ];
    }

    /**
     * Appends the parameters of the route to the
     * to the list of request the object has and merge
     * it into the parameters
     *
     * @return this
     */
    public function validationData()
    {
        if (method_exists($this->route(), 'parameters')) {
            $this->request->add($this->route()->parameters('id'));
            $this->query->add($this->route()->parameters('id'));

            return array_merge($this->route()->parameters(), $this->all());
        }

        return $this->all();
    }
}
