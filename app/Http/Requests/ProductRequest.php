<?php

namespace App\Http\Requests;

use App\Rules\ProductImageRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:60'],
            'images' => ['required', 'array'],
            'sale_price' => ['required', 'numeric'],
            'description' => ['min:3', 'max:700'],
            'category_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'images.required' => 'Pelo menos uma imagem é obrigatória.',
            'category_id.required' => 'O campo categoria é obrigatório.',
        ];
    }
}
