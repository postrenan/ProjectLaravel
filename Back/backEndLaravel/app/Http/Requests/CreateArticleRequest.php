<?php

namespace App\Http\Requests;

class CreateArticleRequest extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:5|unique:article',
            'content' => 'required|max:100',
            'author' => 'required|in:users',
            'category' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'author' => 'O autor não existe',
        ];
    }
}
