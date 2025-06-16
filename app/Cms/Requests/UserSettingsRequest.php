<?php

namespace App\Cms\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $colorFields = ['topbar-footer', 'body', 'body_pattern_color', 'font-color'];

        $colorRules = [];
        foreach ($colorFields as $field) {
            $colorRules["main_colors.$field"] = ['nullable', $this->colorRegex()];
        }

        return array_merge([
            'avatar' => ['nullable', 'image', 'max:40960'],
            'main_image' => ['nullable', 'image', 'max:40960'],
            'about_me' => ['nullable', 'string', 'max:5000'],
            'my_motto' => ['nullable', 'string', 'max:255'],
            'blog_template' => ['nullable', 'string', 'in:one,two,blogy,minimalist'],
            'about_me_image' => ['nullable', 'image', 'max:40960'],
            'main_colors.body_pattern' => [
                'nullable',
                'in:diagonal,dots,grid,circles,overlapping_circles,diamonds,fractals'
            ],
            'show_article_sidebar' => ['nullable', 'in:1,2'],
        ], $colorRules);
    }


    protected function colorRegex(): string
    {
        return 'regex:/^#[0-9A-Fa-f]{6}$/';
    }

    public function messages(): array
    {
        return [
            'avatar.image' => __('validation.custom.avatar.image'),
            'avatar.max' => __('validation.custom.avatar.max'),
            'main_image.image' => __('validation.custom.main_image.image'),
            'main_image.max' => __('validation.custom.main_image.max'),
            'about_me.max' => __('validation.custom.about_me.max'),
            'my_motto.max' => __('validation.custom.my_motto.max'),
            'blog_template.in' => __('validation.custom.blog_template.in'),
            'about_me_image.image' => __('validation.custom.main_image.image'),
        ];
    }
}
