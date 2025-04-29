<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>{{ __('auth.register') }}</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="w3-light-grey">

<div class="w3-container w3-margin-top">
    <div class="w3-card-4 w3-white w3-round-large" style="max-width: 500px; margin: auto;">

        <div class="w3-container w3-blue w3-padding w3-center w3-round-top">
            <h2>{{ __('auth.register') }}</h2>
        </div>

        <div class="w3-container w3-padding">

            @if ($errors->any())
                <div class="w3-panel w3-red w3-display-container w3-round w3-margin-bottom">
                    <span onclick="this.parentElement.style.display='none'"
                          class="w3-button w3-large w3-display-topright">&times;</span>
                    <ul class="w3-ul">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <label class="w3-text-grey"><b>{{ __('auth.user_name') }}</b></label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" type="text" name="name" id="name"
                       value="{{ old('name') }}" required autofocus>

                <label class="w3-text-grey"><b>{{ __('auth.email') }}</b></label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" type="email" name="email" id="email"
                       value="{{ old('email') }}" required>

                <label class="w3-text-grey"><b>{{ __('auth.password') }}</b></label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" type="password" name="password"
                       id="password" required>

                <label class="w3-text-grey"><b>{{ __('auth.repeat_password') }}</b></label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" type="password" name="password_confirmation"
                       id="password_confirmation" required>

                <label class="w3-text-grey"><b>{{ __('auth.token') }}</b></label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" type="text" name="token" id="token"
                       value="{{ old('token') }}" required>

                <button class="w3-button w3-blue w3-round w3-block w3-margin-top" type="submit">
                    {{ __('auth.register_user') }}
                </button>
            </form>

        </div>

    </div>
</div>

</body>
</html>
