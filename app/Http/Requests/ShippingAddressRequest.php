<?php

namespace App\Http\Requests;

use App\Rules\PostalCodeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;

class ShippingAddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'street' => ['required', 'string', 'max:160'],
            'number' => ['required', 'string', 'max:20'],
            'complement' => ['max:40'],
            'locality' => ['required', 'string', 'max:60'],
            'city' => ['required', 'string', 'max:90'],
            'region_code' => ['required', 'string', 'max:2'],
            'postal_code' => ['required', new PostalCodeRule()],
        ];
    }
}
