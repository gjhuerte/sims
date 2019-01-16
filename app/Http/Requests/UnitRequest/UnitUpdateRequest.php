<?php

namespace App\Http\Requests\UnitRequest;

use App\Models\Inventory\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UnitUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $unit = Unit::findOrFail($this->unit);
        return [
			'name' => 'required|string|unique:units,name,' . $unit->name . ',name',
			'description' => 'required|string|max:256',
			'abbreviation' => 'required|string'
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
