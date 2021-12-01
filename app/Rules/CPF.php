<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CPF implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param $cpf
     * @return bool
     */
    public function passes($attribute, $cpf): bool
    {
        // apenas números
        $cpf = preg_replace('/\D/is', '', $cpf);

        if (
            strlen($cpf) != 11 ||
            preg_match('/(\d)\1{10}/', $cpf) // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        ) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'CPF inválido!';
    }
}
