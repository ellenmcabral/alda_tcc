<?php

namespace App\Http\Requests\Shop;

use App\Models\Shop;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShopUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        if(request()->routeIs('artisan.shop.edit')) {
            $unique = Rule::unique(Shop::class)->ignore($this->user()->shop->id);
        }
        else {
            $unique = 'unique:shops,url';
        }
        return [
            'name' => ['required', 'string', 'min: 3', 'max:60'],
            'url' => ['required', 'min: 3', 'max:60', 'alpha_dash', $unique],
            'description' => ['nullable', 'string', 'min: 3', 'max:60'],
        ];
    }
}
