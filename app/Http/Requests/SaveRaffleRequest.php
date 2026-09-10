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
        $raffle = $this->route('raffle');
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'total_numbers' => 'required|integer|min:5',
            'min_sale_total' => 'required|numeric|min:1',
        ];
        // TODO: esto se puede mejorar, por que si el usuario no es admin, no se le va a mostrar el select de inventarios, entonces no se va a enviar el inventory_id, entonces no se va a validar, pero si el usuario es admin, entonces si se va a validar el inventory_id, entonces se le va a mostrar el select de inventarios, entonces se va a enviar el inventory_id, entonces se va a validar, entonces se va a validar que no haya una rifa activa en ese inventario, entonces se va a validar que el inventory_id exista en la base de datos, entonces se va a validar que el inventory_id sea requerido
        if (request()->user()->hasRole('admin')) {
            $rules['inventory_id'] = [
                'required',
                'exists:inventories,id',
                new NoActiveRaffle(ignoredId: $raffle?->id), // esto lo puse para cuando se tenga que editar algo, pero solo edita si la raffle esta activa en este inventario
            ];
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
            'total_numbers.required' => 'El total de números es requerido.',
            'total_numbers.integer' => 'El total de números debe ser un número entero.',
            'total_numbers.min' => 'El total de números debe ser al menos 10.',
        ];
    }
}
