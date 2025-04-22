<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('register.email_required'),
            'email.email' => __('register.email_email'),
            'password.required' => __('register.password_required'),
            'password.confirmed' => __('register.password_confirmed'),
            'password.min' => __('register.password_min'),
        ];
    }
}

