<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class PostalCodeRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $postalCode = str_replace(' ', '', $value);

        $response = Http::get('https://viacep.com.br/ws/' . $postalCode . '/json/');

        $dadosApi = $response->json();

        if($dadosApi == null) {
            $fail('O campo CEP está em um formato inválido.');
        }
        elseif(!empty($dadosApi['erro']) and $dadosApi['erro'] == true) {
            $fail('Este CEP não foi encontrado.');
        }
    }
}
