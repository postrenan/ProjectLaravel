<?php

namespace App\Http\Requests;

class CreateUserRequest extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules(): array
    {
        // @link https://laravel.com/docs/10.x/validation
        return [
            'email' => 'required|string|min:5|unique:user',
            'password' => 'required',
            'name' => 'nullable',
        ];
    }
}
