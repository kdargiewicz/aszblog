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
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <label class="form-label">{{ __('auth.user_name') }}</label>
                <input type="text" name="name" required autofocus style="width: 100%; padding: 8px; margin: 8px 0;" value="{{ old('name') }}">

                <label class="form-label"><b>{{ __('auth.email') }}</b></label>
                <input style="width: 100%; padding: 8px; margin: 8px 0;" type="email" name="email" id="email"
                       value="{{ old('email') }}" required>

                <label class="form-label"><b>{{ __('auth.password') }}</b></label>
                <input style="width: 100%; padding: 8px; margin: 8px 0;" type="password" name="password"
                       id="password" required>

                <label class="form-label"><b>{{ __('auth.repeat_password') }}</b></label>
                <input style="width: 100%; padding: 8px; margin: 8px 0;" type="password" name="password_confirmation"
                       id="password_confirmation" required>

                <label class="form-label"><b>{{ __('auth.token') }}</b></label>
                <input style="width: 100%; padding: 8px; margin: 8px 0;" type="text" name="token" id="token"
                       value="{{ old('token') }}" required>

                <button type="submit"
                        style="width: 100%; padding: 10px; background: #2196f3; color: white; border: none; cursor: pointer; margin-top: 10px;">
                    {{ __('auth.register_user') }}
                </button>
            </form>
    </div>
@endsection
