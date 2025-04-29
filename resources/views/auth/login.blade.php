<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>{{ __('auth.login') }}</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="w3-light-grey">

<div class="w3-container w3-margin-top">
    <div class="w3-card-4 w3-white w3-round-large" style="max-width: 400px; margin: auto;">

        <div class="w3-container w3-blue w3-padding w3-center w3-round-top">
            <h2>{{ __('auth.login') }}</h2>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="w3-container w3-padding" method="POST" action="{{ route('login') }}">
            @csrf

            <label class="w3-text-grey"><b>{{ __('auth.email') }}</b></label>
            <input class="w3-input w3-border w3-round w3-margin-bottom" type="email" name="email" required autofocus>

            <label class="w3-text-grey"><b>{{ __('auth.password') }}</b></label>
            <input class="w3-input w3-border w3-round w3-margin-bottom" type="password" name="password" required>

            <button class="w3-button w3-blue w3-round w3-block w3-margin-top w3-margin-bottom" type="submit">
                {{ __('auth.log_in') }}
            </button>

            <div class="w3-center">
                <a href="{{ route('password.request') }}" class="w3-small w3-text-blue w3-hover-text-indigo">
                    {{ __('auth.recover_your_account') }}
                </a>
            </div>
        </form>

    </div>
</div>

</body>
</html>
