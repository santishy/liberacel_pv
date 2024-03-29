<?php

namespace App\Http\Requests;

use App\Rules\IsCreditAccepted;
use Illuminate\Foundation\Http\FormRequest;

class StoreFastSaleRequest extends FormRequest
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
            'description' => 'required',
            'commission_amount' => 'numeric',
            'price' => 'required|numeric|min:1',
            'qty' => 'required|integer',
            'product_bonus_id' => 'required',
            'client_id' => 'exists:clients,id',
            'is_credit' => [new IsCreditAccepted(optional($this->route('client_id')))]
        ];
    }
}
