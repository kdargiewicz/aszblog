<?php

namespace App\Cms\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleDraftRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'required|string',
            'article_uuid' => 'nullable|uuid',
        ];
    }
}
