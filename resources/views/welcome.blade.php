<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>aszblog-beta</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image: url('{{ asset('img/aszblog_main.jpeg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: sans-serif;
        }

        .auth-container {
            background-color: rgba(0, 0, 0, 0.35); /* subtelniejsze tło */
            padding: 1px 1px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15); /* łagodny cień */
        }

        .auth-container a {
            display: inline-block;
            margin: 10px;
            padding: 12px 24px;
            text-decoration: none;
            background-color: rgba(255, 255, 255, 0.6); /* 60% opacity */
            color: #000;
            border-radius: 6px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .auth-container a:hover {
            background-color: rgba(255, 255, 255, 0.8);
            transform: scale(1.05);
        }
    </style>

</head>
<body>
<div class="auth-container">
    @auth
        <a href="{{ url('/dashboard') }}">CMS</a>
    @else
        <a href="{{ route('login') }}">Log in</a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
        @endif
    @endauth
</div>
</body>
</html>
