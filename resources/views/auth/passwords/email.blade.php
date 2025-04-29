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
            <h2>{{ __('auth.password_reset') }}</h2>
        </div>

        <div class="w3-container w3-padding">

            @if (session('status'))
                <div class="w3-panel w3-green w3-display-container w3-round w3-margin-bottom">
                    <span onclick="this.parentElement.style.display='none'"
                          class="w3-button w3-large w3-display-topright">&times;</span>
                    <p>{{ session('status') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <label class="w3-text-grey"><b>{{ __('auth.email_address') }}</b></label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" type="email" name="email" required
                       autofocus>

                <button type="submit" class="w3-button w3-blue w3-round w3-block">
                    {{ __('auth.send_reset_link') }}
                </button>
            </form>

        </div>

    </div>
</div>

</body>
</html>
