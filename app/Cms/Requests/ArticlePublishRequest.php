<?php

namespace App\Cms\Requests;

use App\Constants\Constants;
use Illuminate\Foundation\Http\FormRequest;

class ArticlePublishRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'article_id' => 'required|integer|exists:articles,id',
            'new_status' => 'required|in:' . implode(',', [
                    Constants::NOT_PUBLISHED,
                    Constants::TEST_PUBLISHED,
                    Constants::PUBLISHED,
                ]),
        ];
    }
}
