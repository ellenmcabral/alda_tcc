<?php

namespace App\Http\Requests\Shop;

use App\Models\Shop;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShopUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min: 3', 'max:60'],
            'url' => ['required', 'min: 3', 'max:60', 'alpha_dash', Rule::unique(Shop::class)->ignore($this->user()->shop->id)]
        ];
    }
}
