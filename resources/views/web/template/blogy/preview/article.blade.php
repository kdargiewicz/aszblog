@extends('web.template.blogy.main')
@section('content')

    @if($article && $article->firstImageFromArticle)
        <div class="site-cover site-cover-sm same-height overlay single-page"
             style="background-image: url('{{ asset($article->firstImageFromArticle) }}');">
            @else
                <div class="site-cover site-cover-sm same-height overlay single-page"
                     style="background-image: url('{{ asset('web/theme/blogy/images/hero_5.jpg') }}');">
                    @endif

                    <div class="container">
                        <div class="row same-height justify-content-center">
                            <div class="col-md-6">
                                <div class="post-entry text-center">
                                    <h1 class="mb-4 article-title">{{ $article->title ?? __('article.article_list.no_title') }}</h1>
                                    <div class="post-meta align-items-center text-center">
                                        {{--                            <figure class="author-figure mb-0 me-3 d-inline-block rounded-circle">--}}
                                        {{--                                <img src="{{ asset($userAvatar) }}" alt="Image" class="img-fluid rounded-circle">--}}
                                        {{--                            </figure>--}}
                                        <span class="d-inline-block mt-1">
                                @if(!empty($article->category) || !empty($article->created_at))
                                                <p class="meta-serif text-white">
                                        {{ $article->category ?? '' }}
                                                    @if(!empty($article->category) && !empty($article->created_at))
                                                        &nbsp;&bull;&nbsp;
                                                    @endif
                                                    {{ $article->created_at ? \Carbon\Carbon::parse($article->created_at)->format('Y-m-d') : '' }}
                                    </p>
                                            @endif
                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="container">

                        <div class="row blog-entries element-animate">

                            <div class="col-md-12 col-lg-8 main-content">
                                <div class="post-content-body shadow-box custom-user-color custom-font-color">
                                    <h1 class="text-center article-title">
                                        {{ $article->title ?? __('article.article_list.no_title') }}
                                    </h1>
                                    @if(!empty($article->category) || !empty($article->created_at))
                                        <p class="meta-serif text-center text-black">
                                            {{ $article->category ?? '' }}
                                            @if(!empty($article->category) && !empty($article->created_at))
                                                &nbsp;&bull;&nbsp;
                                            @endif
                                            {{ $article->created_at ? \Carbon\Carbon::parse($article->created_at)->format('Y-m-d') : '' }}
                                        </p>
                                    @endif
                                    {!! $article->content !!}

                                    <p>{{ __('article.create-form.category') }}: <a
                                            href="#">{{ $article->category }}</a>, {{ __('article.create-form.tags') }}:
                                        @foreach ($article->tags as $tag)
                                            {{--                                tu trzeba uzupełnić route żeby klikająć w taga kierować do tej przestrzeni tagów--}}
                                            {{--                                <a href="{{ route('tag.show', ['id' => $tag->id]) }}">#{{ $tag->name }}</a>@if (!$loop->last), @endif--}}
                                            <a href="">#{{ $tag->name }}</a>@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </p>

                                    @if($article->allow_comments)
                                        <hr>
                                        <h3 class="mb-4">6 Comments</h3>

                                        @if(count($article->comments) > 0)
                                            <div class="mt-5">
                                                <h4>{{ __('comments.comments') }}</h4>

                                                @foreach($article->comments as $comment)
                                                    <div class="mt-4 p-3">
                                                        <h5 class="mb-1"><b>{{ $comment->author }}</b></h5>
                                                        <p class="mb-2">{!! nl2br(e($comment->content)) !!}</p>
                                                        <p class="text-muted mb-0" style="font-size: 0.9em;">
                                                            <em>{{ $comment->add_date }}</em></p>
                                                    </div>

                                                    @if (! $loop->last)
                                                        <hr>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="container my-4">
                                            <p class="text-muted custom-font-color">{{ __('comments.would_be_happy_if_you_leave_a_comment') }}</p>

                                            <form method="POST" action="{{ route('comment.store') }}">
                                                @csrf
                                                <input type="hidden" name="article_id"
                                                       value="{{ $article->article_id }}">

                                                <div class="mb-3">
                                                    <label for="author"
                                                           class="form-label">{{ __('comments.nick') }}</label>
                                                    <input type="text" class="form-control" id="author" name="author"
                                                           placeholder="{{ __('comments.nick') }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="content"
                                                           class="form-label">{{ __('comments.content') }}</label>
                                                    <textarea class="form-control" id="content" name="content"
                                                              placeholder="{{ __('comments.content') }}"
                                                              required></textarea>
                                                </div>

                                                <button type="submit"
                                                        class="btn btn-secondary">{{ __('comments.send') }}</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @include('web.template.blogy.sidebar')

                        </div>
                    </div>
                </section>

    @include('web.template.image-modal.modal')
@endsection
