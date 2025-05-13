<?php

namespace App\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'contact_name' => ['required', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_message' => ['required', 'string', 'max:2000'],
            'captcha' => ['required', function ($attribute, $value, $fail) {
                if ((int)$value !== session('captcha_sum')) {
                    $fail(__('Niepoprawny wynik działania antyspamowego.'));
                }
            }],
        ];
    }
}
