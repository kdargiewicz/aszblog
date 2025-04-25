<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - {{ __('errors.server_error') }}</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .background-image {
            /* Pełne tło */
            background-image: url('{{ asset('img/aszblog_error.jpeg') }}');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            background-blend-mode: darken;
        }
        .error-message {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 40px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="background-image">
    @yield('error-content')
{{--    <div class="w3-container error-message">--}}
{{--        <h1 class="w3-xxxlarge w3-text-light-grey">{{ __('errors.500') }}</h1>--}}
{{--        <h2 class="w3-xlarge">{{ __('errors.server_error') }}</h2>--}}
{{--        <p class="w3-large">{{ __('errors.try_again_later') }}</p>--}}

{{--        <a href="{{ route('dashboard') }}" class="w3-button w3-blue w3-margin-top">--}}
{{--            {{ __('errors.back_to_dashboard') }}--}}
{{--        </a>--}}
{{--    </div>--}}
</div>

</body>
</html>
