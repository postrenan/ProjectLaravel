<?php

namespace App\Http\Requests;

class CreateArticleRequest extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules(): array
    {
        // @link https://laravel.com/docs/10.x/validation
        return [
            'title' => 'required|string|min:5',
            'content' => '',
        ];
    }
}
