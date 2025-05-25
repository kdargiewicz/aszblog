@extends('web.template.blogy.main')
@section('content')
    <div class="container py-5">
        <div class="masonry-grid">
            @foreach($articles as $article)
                <a href="{{ route('article.preview', $article->id) }}"
                   class="masonry-item {{ $article->tall ? 'tall' : '' }}"
                   style="background-image: url('{{ asset($article->preview_image) }}');">
                    <div class="overlay-text">
                        <span class="date">{{ Str::lower(\Carbon\Carbon::parse($article->created_at)->translatedFormat('j F Y')) }}</span>
                        <h2>{{ $article->title }}</h2>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
