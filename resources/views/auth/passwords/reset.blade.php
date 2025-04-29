<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>{{ __('auth.password_reset') }}</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="w3-light-grey">

<div class="w3-container w3-margin-top">
    <div class="w3-card-4 w3-white w3-round-large" style="max-width: 500px; margin: auto;">

        <div class="w3-container w3-blue w3-padding w3-center w3-round-top">
            <h2>{{ __('auth.set_new_password') }}</h2>
        </div>

        <div class="w3-container w3-padding">

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <label class="w3-text-grey"><b>{{ __('auth.new_password') }}</b></label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" type="password" name="password" id="password" required>

                <label class="w3-text-grey"><b>{{ __('auth.repeat_password') }}</b></label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" type="password" name="password_confirmation" id="password_confirmation" required>

                <button class="w3-button w3-blue w3-round w3-block w3-margin-top" type="submit">
                    {{ __('auth.change_password') }}
                </button>
            </form>

        </div>

    </div>
</div>

</body>
</html>

