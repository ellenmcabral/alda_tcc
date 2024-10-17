<?php

namespace App\Http\Requests\Shop;

use Illuminate\Foundation\Http\FormRequest;

class ShopActivateRequest extends FormRequest
{
    public function rules(): array
    {
        if(request()->option == 'cpf') {
            $rules = [
                'cpf' => ['required', 'string', 'min:14']
            ];
        }
        if(request()->option == 'cnpj') {
            $rules = [
                'cnpj' => ['required', 'string', 'min:18'],
            ];
        }

        return $rules;
    }
}
