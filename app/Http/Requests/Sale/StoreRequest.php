<?php

namespace App\Http\Requests\Sale;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreRequest extends FormRequest
{
    /**
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
     * @return array
     */
    public function rules(): array
    {
        if ($this->customer_id) {
            $rules['customer_id'] = 'required|integer|exists:customer,id';
        } else {
            $rules['name']  = 'required|string|between:1,256';
            $rules['email'] = 'required|email|between:1,256';
            $rules['cpf']   = 'required|cpf|formato_cpf';
        }

        return $rules + [
                'product_id'        => 'required|integer|exists:products,id',
                'sold_at'           => 'required|date|date_format:Y-m-d',
                'quantity'          => 'required|integer|between:1,999999999',
                'discount'          => 'required|numeric|between:0,100.00',
                'sale_situation_id' => 'required|integer|exists:sale_situations,id'
            ];
    }
}
