<?php

namespace App\Http\Requests\SupplyRequest;

use App\Models\Inventory\Supply\Supply;
use Illuminate\Foundation\Http\FormRequest;

class SupplyUpdateRequest extends FormRequest
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
        $supply = Supply::findOrFail($this->supply);
        return [
            'stock_number' => 'required|unique:supplies,stocknumber,' . $supply->stocknumber . ',stocknumber',
            'details' => 'required|unique:supplies,details|max:256',
            'unit' => 'required|max:256',
            'reorder_point' => 'required|integer|max:256'
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
