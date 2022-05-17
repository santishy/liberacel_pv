<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerBonusRequest extends FormRequest
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
            'phone_number' => 'required|digits:10',
            'fast_sale_id' => 'required'
        ];
    }

    public function messages(){
        return [
            'phone_number.required' => 'El número de télefono es requerido.',
            'phone_number.digits' => 'El número de télefono debe tener 10 digitos.',
            'fast_sale_id.required' => 'El id de venta rápida es requerido.'
        ];
    }
}
