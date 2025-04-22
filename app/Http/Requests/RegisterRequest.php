<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'token' => 'required|string',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $token = $this->input('token');

            $record = DB::table('invitation_tokens')
                ->where('code', $token)
                ->where('used', false)
                ->where(function ($query) {
                    $query->whereNull('expires_at')
                        ->orWhere('expires_at', '>', Carbon::now());
                })
                ->first();

            if (! $record) {
                $validator->errors()->add('token', __('register.token_expired'));
            }
        });
    }

    public function messages(): array
    {
        return [
            'name.required' => __('register.name_required'),
            'email.required' => __('register.email_required'),
            'email.email' => __('register.email_email'),
            'email.unique' => __('register.email_unique'),
            'password.required' => __('register.password_required'),
            'password.confirmed' => __('register.password_confirmed'),
            'password.min' => __('register.password_min'),
            'token.required' => __('register.token_required'),
            'token.in' => __('register.token_in'),
        ];
    }
}

