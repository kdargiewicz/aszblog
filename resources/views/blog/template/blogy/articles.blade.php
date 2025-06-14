@extends('web.template.blogy.main')
@section('content')
    <div class="container py-5">
        <div class="masonry-grid">
            @foreach($articles as $article)
                <a href="{{ route('blog.article', $article->id) }}"
                   class="masonry-item {{ $article->tall ? 'tall' : '' }}"
                   style="background-image: url('{{ asset($article->preview_image_max) }}');">
                    <div class="overlay-text">
                        <span class="date meta-serif">{{ $article->category_name }}, {{ Str::lower(\Carbon\Carbon::parse($article->created_at)->translatedFormat('j F Y')) }}</span>
                        <h2 class="article-title">{{ $article->title }}</h2>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
