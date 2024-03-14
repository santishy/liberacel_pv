<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFastSaleRequest extends FormRequest
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
            'description' => 'required_if:index,',
            'price' => 'required_if:index,|numeric|min:1',
            'qty' => 'required_if:index,|integer|min:1',
            'index' => 'numeric|min:0',
            'product_bonus_id' => 'required_if:index,',
            'is_credit' => 'boolean',
        ];
    }
}
