@extends('web.template.one.main')
@section('content')
    <div class="w3-top">
        <div class="w3-bar w3-white w3-padding w3-card article-title">
            <a href="#home" class="w3-bar-item w3-button">
                @if($article->title)
                    {{ $article->title }}
                @else
                    <span class="title-span">
                        {{ __('errors.no_title_article') }}
                    </span>
                @endif
            </a>

            <div class="w3-right w3-hide-small">
                <a href="#about" class="w3-bar-item w3-button">About</a>
                <a href="#menu" class="w3-bar-item w3-button">Menu</a>
                <a href="#contact" class="w3-bar-item w3-button">Contact</a>
            </div>
        </div>
    </div>

    <header class="w3-display-container w3-content w3-wide header-image" id="home">
        @if($article && $article->firstImageFromArticle)
            <img class="w3-image" src='{{ asset($article->firstImageFromArticle) }}' width="1600" height="800">
        @else
            <img class="w3-image" src="https://www.w3schools.com/w3images/hamburger.jpg" alt="Hamburger Catering"
                 width="1600" height="800">
        @endif
        <div class="w3-display-bottomleft w3-padding-large w3-opacity">
            <h1 class="w3-xxlarge w3-text-white">{{ $article->category }}</h1>
        </div>
    </header>

    <div class="w3-content w3-content-width">


        <div class="w3-row w3-padding-64" id="about">
            <div class="w3-container w3-padding-large" style="max-width: 900px; margin: 0 auto;">
                <h1 class="title w3-center">
                    {{ $article->title ?? __('article.article_list.no_title') }}
                </h1>
                @if(!empty($article->category) || !empty($article->created_at))
                    <p class="w3-center" style="font-style: italic; color: #555;">
                        {{ $article->category ?? '' }}
                        @if(!empty($article->category) && !empty($article->created_at))
                            &nbsp;&bull;&nbsp;
                        @endif
                        {{ $article->created_at ?? '' }}
                    </p>
                @endif

                <div
                    class="article-content w3-container w3-margin-top w3-white w3-padding w3-round w3-card custom-article-text">
                    {!! $article->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection
