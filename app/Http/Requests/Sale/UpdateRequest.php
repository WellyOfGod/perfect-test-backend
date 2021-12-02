<?php

namespace App\Http\Requests\Sale;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->sold_at) {
            $this->merge([
                'sold_at' => Carbon::createFromFormat('d/m/Y', $this->sold_at)->format('Y-m-d'),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'customer_id'         => 'required|integer|exists:customer,id',
            'product_id'        => 'required|integer|exists:products,id',
            'sold_at'           => 'required|date|date_format:Y-m-d',
            'quantity'          => 'required|integer|between:1,999999999',
            'discount'          => 'required|numeric|between:0,100.00',
            'sale_situation_id' => 'required|integer|exists:sale_situations,id'
        ];
    }
}
