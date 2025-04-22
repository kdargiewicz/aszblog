<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm(): object
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request): object
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __('messages.mail.reset_link_mail'))
            : back()->withErrors(['email' => __('messages.mail.error_link_mail')]);
    }
}
