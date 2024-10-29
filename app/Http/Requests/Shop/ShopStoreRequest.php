<?php

namespace App\Http\Requests\Shop;

use Illuminate\Foundation\Http\FormRequest;

class ShopStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:60'],
            'url' => ['required', 'min:3', 'max:60', 'alpha_dash', 'unique:shops']
        ];
    }
}
