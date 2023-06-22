<?php

namespace App\Http\Requests;

use App\Rules\NotNullIsCreditRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
            'status' => ['required', 'regex:/completed|cancelled|pending/'],
            'total' => 'numeric|required',
            'inventory_id' => ['required'],
            'is_credit' => ["accepted", new NotNullIsCreditRule($this->route('sale'))]
        ];
    }
}
