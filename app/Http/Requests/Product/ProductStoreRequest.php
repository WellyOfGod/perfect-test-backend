<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{


    protected function prepareForValidation(): void
    {
        $this->merge([
            'price' => (float) is_numeric($this->price) ? $this->price : str_replace(['.', ','], ['', '.'], $this->price)
        ]);
    }

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
        //dd($this->all());
        return [
            'name'        => 'required|string|between:1,256',
            'description' => 'required|string|between:1,1024',
            'price'       => 'required|numeric|between:0,99999999.99'
        ];
    }


}
