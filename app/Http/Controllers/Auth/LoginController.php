<?php

namespace App\Http\Controllers\Auth;

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function showLoginForm(): object
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        dd($data);
        if (Auth::attempt($data, $request->filled('remember'))) { dd('kurwa');
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => __('login.login_error'),
        ])->withInput();
    }

    public function logout(Request $request): object
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/login');
    }
}
