<?php

namespace App\Http\Requests\Customer;

use App\Rules\CPF;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'  => 'required|string',
            'email' => 'required|email:rfc,dns',
            'cpf'   => ['required', 'string', 'min:11', 'max:14', new CPF]
        ];
    }
}
