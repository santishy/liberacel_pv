<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStoreProductBonus extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('product_bonuses')->ignore(optional($this->productBonus->id))
            ],
            'points' => ['required','numeric','min:1']
        ];
    }
    public function messages(){
        return [
            'name.required' => 'El nombre es requerido: ',
            'name.unique' => 'El nombre ya existe en la base de datos',
            'points.required' => 'El campo puntos es requerido',
            'points.numeric' => 'El campo puntos debe ser un número entero'
        ];
    }
}
