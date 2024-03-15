<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'description' => [Rule::requiredIf(fn () => $this->hasIndex())],
            'price' => ['numeric', 'min:0', Rule::requiredIf(fn () => $this->hasIndex())],
            'qty' => ['numeric', 'min:1', 'integer', Rule::requiredIf(fn () => $this->hasIndex())],
            'index' => ['numeric', 'min:0'],
            'product_bonus_id' => ['numeric', 'min:1', Rule::requiredIf(fn () => $this->hasIndex())],
            'is_credit' => ['boolean'],
        ];
    }

    private function hasIndex()
    {
        return $this->index !== null;
    }
}
