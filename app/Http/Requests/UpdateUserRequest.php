<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        /**Esto lo hice para cuando desactivo o activo el usuario */
        if (request()->has('active')) {
            return [
                "active" => ["required", "boolean"]
            ];
        }
        return $this->updateRules();
    }
    public function messages()
    {
        return [
            'name.string' => 'El nombre debe ser una cadena',
            'password.confirmed' => 'La confirmación de contraseña no coincide',
            'email.unique' => 'El email debe ser unico',
            'username.unique' => 'El nombre de usuario (username) debe ser único.',
            'username.required' => 'El username es requerido',
            'password.min' => 'El password como minimo debe tener cuatro caracteres.'
        ];
    }

    private function updateRules()
    {
        $rules = [
            'name' => ['string', 'max:255'],
            'email' => [
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->route('user')->id)
            ],
            'username' => ['required', 'min:4', Rule::unique('users')->ignore($this->route('user')->id)],
            'roles.*' => 'exists:roles,id',

        ];

        if ($this->filled('password')) {
            $rules['password'] = ['min:4', 'confirmed'];
        }
        return $rules;
    }
}
