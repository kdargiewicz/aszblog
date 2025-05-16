<!DOCTYPE html>
<html>
<head>
    <title>Aszblog-beta</title>
    @include('favicon')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Bad+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
    <script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.api_key') }}/tinymce/7/tinymce.min.js"
            referrerpolicy="origin"></script>
    <link rel="stylesheet" href={{ asset('web/css/one-main.css') }}>
</head>
<body>

@include('web.template.one.topbar')

@include('web.template.one.flash')


{{--TU PROTEZA DO PREVIEW BLOGA KOLO MANOLO--}}
@if(isset($article) || isset($images) || Route::currentRouteName() === 'about-me' || Route::currentRouteName() === 'contact' || Route::currentRouteName() === 'blog.map')
{{--    @yield('content')--}}
<div class="page-content">
    <!-- header, content, itp. -->
    <div class="main-content">
        @yield('content')
    </div>
</div>
@else
    <!-- Header -->
    <header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">


{{--        {{ dd($blogSettings) }} //jesli mi to zwraca to mam ustawienia swojego bloga--}}

        @if($blogSettings && $blogSettings->main_image)
            <img class="w3-image" src='{{ asset($blogSettings->main_image) }}' width="1600" height="800">
        @else
            <img class="w3-image" src="https://www.w3schools.com/w3images/hamburger.jpg" alt="Hamburger Catering" width="1600" height="800">
        @endif
        <div class="w3-display-bottomleft w3-padding-large w3-opacity">
            <h1 class="w3-xxlarge">ASZBLOG</h1>
        </div>
    </header>

    <!-- Page content -->
    <div class="w3-content" style="max-width:1100px">

        @foreach($articles as $article)
            <div class="w3-row w3-padding-64 article-preview-block clickable-article"
            data-href="{{ route('article.preview', $article->id) }}"
            id="about">
                <div class="w3-col m6 w3-padding-large w3-hide-small">
                    <img src="{{ asset($article->preview_url) }}" class="w3-round-large w3-image" alt="Table Setting" width="600" height="750">
                </div>

                <div class="w3-col m6 w3-padding-large">
                    <h1 class="w3-center">{{ $article->title }}</h1><br>
                    <h5 class="w3-center">{{ $article->category_name }}</h5>
                    <p class="w3-large" style="text-align: justify;">{!! \Illuminate\Support\Str::limit(strip_tags($article->content), 540) !!}</p>
                </div>
            </div>
            @if (! $loop->last)
                <hr class="comments-separator">
            @endif
        @endforeach
    </div>
@endif

@include('web.template.one.footer')


{{--TO NALEZY DODAC DO JAKIEGOS SKRYPTU REJCZEL :P BO TO DZIAŁAAAAA ! ! ! ! ! PRZEKIEROWUJE DO DANEGO ARTYKUŁA :P --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.clickable-article').forEach(function (el) {
            el.style.cursor = 'pointer';
            el.addEventListener('click', function () {
                window.location.href = el.getAttribute('data-href');
            });
        });
    });
</script>


</body>
</html>
