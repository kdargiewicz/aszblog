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
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <label class="form-label">{{ __('auth.email_address') }}</label>
                <input type="email" name="email" required autofocus style="width: 100%; padding: 8px; margin: 8px 0;">

                <button type="submit"
                        style="width: 100%; padding: 10px; background: #2196f3; color: white; border: none; cursor: pointer; margin-top: 10px;">
                    {{ __('auth.send_reset_link') }}
                </button>
            </form>
    </div>
@endsection
