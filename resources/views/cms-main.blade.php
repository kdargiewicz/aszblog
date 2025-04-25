<!DOCTYPE html>
<html>
<head>
    <title>W3.CSS Template</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href={{ asset('cms/css/w3.css') }}>
    <link rel="stylesheet" href={{ asset('cms/css/fonts.css') }}>
    <link rel="stylesheet" href={{ asset('cms/css/cms-main.css') }}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.api_key') }}/tinymce/7/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        html, body, h1, h2, h3, h4, h5 {
            font-family: "Raleway", sans-serif
        }
    </style>
</head>

@yield('scripts')
    <body class="w3-light-grey" style="min-height: 100vh; display: flex; flex-direction: column;">

    @include('cms-topbar')
    @include('cms-sidebar')

    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer"
         title="close side menu" id="myOverlay"></div>

    <div style="flex: 1; display: flex; flex-direction: column; margin-left:300px; margin-top:43px;">
        <div class="w3-main" style="flex: 1 0 auto;">
            @include('alerts')
            <main>
                @yield('content')
            </main>
        </div>
        @include('cms.cms-footer')
    </div>
        <script src="{{ asset('cms/js/cms-sidebar.js') }}"></script>
    </body>
</html>

