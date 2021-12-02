<?php

namespace App\Http\Requests\Sale;

use App\Rules\CPF;
use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use App\Models\{Customer, Product, SaleSituation};

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
            $rules['customer_id'] = 'required|integer|exists:' .Customer::class.',id';
        } else {
            $rules['name']  = 'required|string|between:1,256';
            $rules['email'] = 'required|email|between:1,256';
            $rules['cpf']   = ['required', 'string', 'min:11', 'max:14','unique:' .Customer::class.',cpf,{$id}', new CPF];
        }

        return $rules + [
                'product_id'        => 'required|integer|exists:' .Product::class.',id',
                'sold_at'           => 'required|date|date_format:Y-m-d',
                'quantity'          => 'required|integer|between:1,999999999',
                'discount'          => 'required|numeric|between:0,100.00',
                'sale_situation_id' => 'required|integer|exists:' .SaleSituation::class.',id'
            ];
    }
}
