@extends('web.template.one.main')
@section('content')
    <div class="w3-display-container w3-content w3-wide header-image" id="home">
        @if($article && $article->firstImageFromArticle)
            <img class="w3-image" src='{{ asset($article->firstImageFromArticle) }}' width="1600" height="800" alt="firstImageFromArticle">
        @else
            <img class="w3-image" src="https://www.w3schools.com/w3images/hamburger.jpg" alt="Hamburger Catering"
                 width="1600" height="800">
        @endif
        <div class="w3-display-bottomleft w3-padding-large w3-opacity">
            <h1 class="w3-xxlarge w3-text-white">{{ $article->category }}</h1>
        </div>
    </div>

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
                        {{ $article->created_at ? \Carbon\Carbon::parse($article->created_at)->format('Y-m-d') : '' }}
                    </p>
                @endif

                <div
                    class="article-content w3-container w3-margin-top w3-white w3-padding w3-round w3-card custom-article-text">
                    {!! $article->content !!}
                </div>
            </div>
        </div>

        @if($article->allow_comments)
            <div class="w3-content w3-padding-64 comments-section">
                {{--                <hr class="comments-separator">--}}

                {{--                <h3 class="comments-header">{{ __('comments.comments') }}</h3>--}}
                <p class="comments-subtitle">{{ __('comments.would_be_happy_if_you_leave_a_comment') }}</p>

                <form method="POST" action="{{ route('comment.store') }}">
                    <input type="hidden" name="article_id" value="{{ $article->article_id }}">
                    @csrf
                    <p><input class="w3-input w3-padding-16" type="text" placeholder="{{ __('comments.nick') }}"
                              required name="author"></p>
                    <p><input class="w3-input w3-padding-16" type="text" placeholder="{{ __('comments.content') }}"
                              required name="content"></p>
                    <p>
                        <button class="w3-button w3-light-grey w3-section"
                                type="submit">{{ __('comments.send') }}</button>
                    </p>
                </form>

                <div class="comments-list">
                    @if(count($article->comments) > 0)
                        <h3 class="comments-header">{{ __('comments.comments') }}</h3>
                        @foreach($article->comments as $comment)
                            <div class="comment-header">
                                <h5 class="comments-header"><strong>{{ $comment->author }}</strong></h5>
                            </div>
                            <div class="comment-body comments-subtitle">
                                {!! nl2br(e($comment->content)) !!}
                                <p class="comment-date">{{ $comment->add_date }}</p>
                            </div>
                            @if (! $loop->last)
                                <hr class="comments-separator">
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        @endif
    </div>
    @include('web.template.image-modal.modal')
@endsection

