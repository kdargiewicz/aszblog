<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function show(): object
    {
        return view('auth.verify');
    }

    public function verify(EmailVerificationRequest $request): object
    {
        $request->fulfill();
        return redirect('/dashboard');
    }

    public function resend(Request $request): object
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', __('register.send_mail_verification_success'));
    }
}
