<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:150'],
            'image' => 'file',
            'sale_price' => ['required', 'numeric'],
            'category_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => 'O campo imagem é obrigatório.',
            'category_id.required' => 'O campo categoria é obrigatório.',
        ];
    }
}
