<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>{{ __('auth.login') }}</title>
    @include('favicon')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('auth/css/main.css') }}>
</head>
<body>

<div class="container">
    <div class="form-section">
        @yield('content')
    </div>

    <div class="image-section"></div>
</div>

</body>
</html>
