<?php

namespace App\Http\Requests;

use App\Rules\NoActiveRaffle;
use Illuminate\Foundation\Http\FormRequest;

class SaveRaffleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $rules =  [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'min_sale_total' => 'required|numeric|min:1',
        ];
        if (request()->user()->hasRole('admin')) {
            $rules['inventory_id'] = ['required', 'exists:inventories,id', new NoActiveRaffle];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre de la rifa es requerido.',
            'name.string' => 'El nombre de la rifa debe ser una cadena de texto.',
            'name.max' => 'El nombre de la rifa no debe exceder los 255 caracteres.',
            'description.string' => 'La descripción de la rifa debe ser una cadena de texto.',
            'start_date.required' => 'La fecha de inicio es requerida.',
            'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
            'end_date.required' => 'La fecha de finalización es requerida.',
            'end_date.date' => 'La fecha de finalización debe ser una fecha válida.',
            'end_date.after' => 'La fecha de finalización debe ser posterior a la fecha de inicio.',
            'min_sale_total.required' => 'El total mínimo de venta es requerido.',
            'min_sale_total.numeric' => 'El total mínimo de venta debe ser un número.',
            'min_sale_total.min' => 'El total mínimo de venta debe ser al menos 1.',
            'inventory_id.required' => 'El inventario es requerido.',
        ];
    }
}
