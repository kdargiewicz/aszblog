<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegistrationForm(): object
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'token'    => $data['token'],
        ]);

        DB::table('invitation_tokens')
            ->where('code', $data['token'])
            ->update(['used' => true, 'updated_at' => now()]);


        event(new Registered($user));

        auth()->login($user);

        return redirect()->route('dashboard')->with('success', __('register.account_create_success'));
    }
}

