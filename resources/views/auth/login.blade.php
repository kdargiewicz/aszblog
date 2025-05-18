@extends('auth.main')
@section('content')
    <div class="form-box">
        @if ($errors->any())
            <div style="background: #ffdddd; padding: 10px; border-radius: 4px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label class="form-label">{{ __('auth.email') }}</label>
            <input type="email" name="email" required autofocus style="width: 100%; padding: 8px; margin: 8px 0;">
            <label class="form-label">{{ __('auth.password') }}</label>
            <input type="password" name="password" required style="width: 100%; padding: 8px; margin: 8px 0;">
            <div style="margin: 10px 0;">
                <label class="link-muted">
                    <input type="checkbox" name="remember" class="link-muted">
                    {{ __('auth.remember_me') }}
                </label>
            </div>
            <button type="submit"
                    style="width: 100%; padding: 10px; background: #2196f3; color: white; border: none; cursor: pointer; margin-top: 10px;">
                {{ __('auth.log_in') }}
            </button>

            <div style="text-align: center; margin-top: 10px;">
                <a href="{{ route('password.request') }}" class="link-muted">
                    {{ __('auth.recover_your_account') }}
                </a>
            </div>
        </form>
    </div>
@endsection
