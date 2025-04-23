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
    <script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.api_key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
    </style>
</head>

@yield('scripts')

<body class="w3-light-grey">

@include('cms-topbar')

@include('cms-sidebar')

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

    <main>
{{--        style="position: relative; height: 100%;">--}}
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="w3-container w3-padding-16 w3-light-grey">
        <h4>FOOTER</h4>
        <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
    </footer>

    <!-- End page content -->
</div>

<script src="{{ asset('cms/js/cms-sidebar.js') }}"></script>

</body>
</html>

{{--<form method="POST" action="{{ route('logout') }}">--}}
{{--    @csrf--}}
{{--    <button type="submit">Wyloguj</button>--}}
{{--</form>--}}

