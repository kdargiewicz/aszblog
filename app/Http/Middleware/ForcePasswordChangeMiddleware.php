<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForcePasswordChangeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->force_password_change) {
            if (!$request->is('password/reset') && !$request->is('logout')) {
                return redirect()->route('password.request')->with('warning', 'Musisz zmienić swoje hasło przed kontynuowaniem.');
            }
        }

        return $next($request);
    }
}
