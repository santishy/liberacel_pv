<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRelationshipRequest extends FormRequest
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
            'username' => 'required|min:4',
            'password' => 'required',
            'model' => 'required',
            'id' => "required|exists:App\Models\\$this->model,id"
        ];
    }
    public function messages(){
        return [
            'username.required' => 'El campo nombre de usuario es requerido.',
            'username.min' => "el campo nombre de usuario como minimo tiene que tener 4 letras.",
            "model.required" => "Modelo requerido, hable con su proovedor.",
            "id.required" => "Id requerido, hable con su proveedor.",
            "password.required" => "El campo contraseña es requerido."

        ];
    }
}
