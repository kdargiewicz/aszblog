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
                                    {{--                                    {!! $article->content !!}--}}
                                    <div class="tinymce-content">
                                        {!! $article->content !!}
                                    </div>

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

                                    @include('web.template.blogy.preview.comments')

                                </div>
                            </div>

                            @include('web.template.blogy.sidebar')

                        </div>
                    </div>
                </section>

        @include('web.template.image-modal.modal')
        @endsection
