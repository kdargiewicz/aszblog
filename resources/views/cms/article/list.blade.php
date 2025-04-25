@extends('cms-main')
@section('content')
    <div class="w3-container w3-light-grey w3-margin">
        <h2 class="w3-text-blue">{{ __('article.list') }}</h2>

        @forelse($articleList as $article)
            <div class="w3-card w3-white w3-margin-bottom w3-padding">
                <div class="w3-row">
                    <div class="w3-col s12 m9">
                        <h4 class="w3-text-dark-grey">
                            {{ $article->title }}
                            @if(!$article->is_published)
                                <span class="w3-tag w3-yellow w3-small w3-margin-left">{{ __('article.article_action.not-published') }}</span>
                            @else
                                <span class="w3-tag w3-green w3-small w3-margin-left">{{ __('article.article_action.published') }}</span>
                            @endif
                        </h4>
                        <p class="w3-text-grey w3-small">
                            {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}
                        </p>
                        <p class="w3-text-gray w3-small">
                            {{ \Carbon\Carbon::parse($article->created_at)->format('Y-m-d H:i') }}
                        </p>
                    </div>

                    <div class="w3-col s12 m3 w3-right-align w3-margin-top">
                        <a href="{{ route('article.edit', $article->article_uuid) }}" class="w3-button w3-blue w3-small w3-margin-bottom">
                            {{ __('article.article_action.article-edit') }}
                        </a>
{{--                        <a href="{{ route('article.show', $article->id) }}" target="_blank" class="w3-button w3-light-grey w3-small">--}}
                        <a href="" target="_blank" class="w3-button w3-light-grey w3-small">
                            {{ __('article.article_action.article-preview') }}
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="w3-panel w3-pale-yellow w3-border">
                <p>{{ __('article.empty_list') }}</p>
            </div>
        @endforelse
        {{-- Paginacja --}}
        <div class="w3-center w3-margin-top w3-margin-bottom">
            {{ $articleList->links() }}
        </div>
    </div>
@endsection

