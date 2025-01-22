<?php

namespace App\Http\Requests;

use App\Rules\ProductImageRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        if(request()->option == 'stock') {
            $attribute = 'stock';
        }
        elseif(request()->option == 'deadline') {
            $attribute = 'deadline';
        }

        return [
            'name' => ['required', 'string', 'min:3', 'max:60'],
            $attribute => ['required', 'numeric'],
            'images' => ['array'],
            'sale_price' => ['required', 'numeric', 'between:0,99999999.99'],
            'description' => ['max:700'],
            'category_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'images.required' => 'Pelo menos uma imagem é obrigatória.',
            'stock.required' => 'O campo estoque é obrigatório.',
            'deadline.required' => 'O campo prazo é obrigatório.',
            'sale_price.required' => 'O campo preço é obrigatório.',
            'sale_price.between' => 'O campo preço ultrapassa o limite permitido.',
            'category_id.required' => 'O campo categoria é obrigatório.',
        ];
    }
}
