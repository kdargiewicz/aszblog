<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>{{ __('auth.confirm_email') }}</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="w3-light-grey">

<div class="w3-container w3-margin-top">
    <div class="w3-card-4 w3-white w3-round-large" style="max-width: 600px; margin: auto;">

        <div class="w3-container w3-blue w3-padding w3-center w3-round-top">
            <h2>{{ __('auth.confirm_your_email_address') }}</h2>
        </div>

        <div class="w3-container w3-padding">

            <p class="w3-center">
                {{ __('auth.check_your_inbox') }}<br>
                <b>{{ auth()->user()->email }}</b>
            </p>

            <form method="POST" action="{{ route('verification.send') }}" class="w3-center w3-margin-bottom">
                @csrf
                <button type="submit" class="w3-button w3-blue w3-round w3-margin-top">
                    {{ __('auth.resend_link') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="w3-center w3-margin-bottom">
                @csrf
                <button type="submit" class="w3-button w3-light-grey w3-round">
                    {{ __('auth.logout') }}
                </button>
            </form>

        </div>

    </div>
</div>

<script>
    setInterval(async () => {
        try {
            const response = await fetch("{{ route('api.check-verification') }}", {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (response.ok) {
                const json = await response.json();
                if (json.verified) {
                    window.location.href = "{{ route('dashboard') }}";
                }
            }
        } catch (error) {
            console.error("Błąd sprawdzania weryfikacji:", error);
        }
    }, 5000);
</script>

</body>
</html>
