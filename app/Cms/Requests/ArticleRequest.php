<?php

namespace App\Cms\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'article_uuid'   => ['required', 'uuid'],
            'title' => ['nullable', 'string', 'max:255'],
            'tags' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'content' => ['nullable', 'string'],
            'allow_comments' => ['nullable', 'boolean'],
            'created_at' => [
                'nullable',
                'date_format:Y-m-d\TH:i',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'latitude.between' => __('article.requests.latitude_between'),
            'longitude.between' => __('article.requests.longitude_between'),
        ];
    }
}
