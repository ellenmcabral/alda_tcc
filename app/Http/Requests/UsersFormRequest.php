<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersFormRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:60'],
            'email' => [
                'required',
                'email',
                'min:3',
                'max:60',
                Rule::unique('users')->ignore($this->user['id'])
            ],
            'password' => [
                Rule::when(request()->isMethod('POST'), 'required|min:6'),
            ],
            'phone' => [
                'required', 'min:16', 'max:16',
                Rule::unique('users')->ignore($this->user['id'])
            ],
        ];
    }
}
