<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStoreWarehouse extends FormRequest
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
            'name' => ['required', Rule::unique('inventories')->ignore(optional($this->inventory)->id)],
            'address' => ['required']
        ];
    }

    public function messages(){
        return [
            'name.required' => 'El nombre es requerido: ',
            'name.unique' => 'El nombre ya existe en la base de datos',
            'address.required' => 'La dirección es requerida'
        ];
    }
}
