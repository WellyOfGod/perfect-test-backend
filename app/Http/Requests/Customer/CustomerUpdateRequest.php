<?php

namespace App\Http\Requests\Customer;

use App\Rules\CPF;
use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        $id = $this->customer ? ",{$this->customer->id}" : '';

        return [
            'name'  => 'required|string|max:64',
            'email'  => "nullable|string|max:128|unique:App\Models\Customer,email{$id}",
            'cpf'   => ['required', 'string', 'min:11', 'max:14','unique:App\Models\Customer,cpf,{$id}', new CPF]
        ];
    }
}
