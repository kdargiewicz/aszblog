<?php

namespace App\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentsRequests extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'article_id' => 'required|exists:articles,id',
            'author'     => 'required|string|max:255',
            'content'    => 'required|string|max:5000',
        ];
    }
}
