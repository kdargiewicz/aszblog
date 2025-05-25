@extends('cms-main')
@section('content')
    <div class="w3-container w3-light-grey w3-margin">
        <h2 class="w3-text-dark-grey w3-serif">{{ __('article.list') }}</h2>

        @forelse($articleList as $article)
            <div class="w3-card w3-paper w3-margin-bottom w3-padding w3-round">
                <div class="w3-row" style="display: flex; align-items: center; gap: 16px;">
                    {{-- Obrazek --}}
                    <div style="flex-shrink: 0;">
                        <img class="w3-round" src="{{ asset($article->preview_image ?? 'img/aszblog_main.jpeg') }}"
                             alt="Preview"
                             style="width: 200px;">
                    </div>

                    <div style="flex-grow: 1;">
                        <h4 class="w3-text-dark-grey" style="margin-top: 0; margin-bottom: 4px;">
                            @if($article->title)
                                {{ $article->title }}
                            @else
                                <span class="w3-text-red">{{ __('article.article_list.no_title') }}</span>
                            @endif
                        </h4>

                        <div class="w3-margin-bottom">

                            <span onclick="openStatusModal({{ $article->id }}, {{ $article->is_published }})"
                                  class="w3-tag {{ $article->is_published === 2 ? 'w3-green' : ($article->is_published === \App\Constants\Constants::TEST_PUBLISHED ? 'w3-yellow' : 'w3-red') }} w3-small w3-round-small w3-hover-shadow"
                                  style="cursor: pointer;">
                                @if($article->is_published === \App\Constants\Constants::PUBLISHED)
                                    {{ __('article.article_action.published') }}
                                @elseif($article->is_published === \App\Constants\Constants::TEST_PUBLISHED)
                                    {{ __('article.article_action.test-published') }}
                                @else
                                    {{ __('article.article_action.not-published') }}
                                @endif
                            </span>

                            @if(!$article->allow_comments)
                                <span class="w3-tag w3-deep-orange w3-small w3-round-small">
                                    {{ __('article.article_action.not_allow_comments') }}
                                </span>
                            @else
                                <span class="w3-tag w3-light-green w3-small w3-round-small">
                                    {{ __('article.article_action.allow_comments') }}
                                </span>
                            @endif
                        </div>

                        <p class="w3-text-grey w3-small" style="margin-top: 4px;">
                            @if(!empty(trim(strip_tags($article->content))))
                                {!! \Illuminate\Support\Str::limit(strip_tags($article->content), 150) !!}
                            @else
                                <span class="w3-text-red">{{ __('article.article_list.no_content') }}</span>
                            @endif
                        </p>

                        <p class="w3-text-gray w3-small" style="margin-top: 4px;">
                            {{ __('article.article_list.add_date') }} {{ \Carbon\Carbon::parse($article->created_at)->format('Y-m-d H:i') }}
                        </p>
                    </div>

                    <div style="display: flex; flex-direction: column; justify-content: center; gap: 6px;">
                        <a href="{{ route('article.edit', $article->article_uuid) }}"
                           type="button" class="btn btn-primary btn-custom">
                            {{ __('article.article_action.article-edit') }}
                        </a>
                        <a href="{{ route('article.preview', $article->id) }}"
                           target="_blank"
                           type="button" class="btn btn-success btn-custom">
                            {{ __('article.article_action.article-preview') }}
                        </a>
                        <button onclick="openDeleteModal('{{ route('article.delete', $article->id) }}')"
                                type="button" class="btn btn-danger btn-custom">
                            {{ __('article.article_action.article-delete') }}
                        </button>
                    </div>
                </div>
            </div>

        @empty
            <div class="w3-panel w3-pale-yellow w3-border">
                <p>{{ __('article.empty_list') }}</p>
            </div>
        @endforelse

        <div class="w3-center w3-margin-top w3-margin-bottom">
            @include('pagination', ['paginator' => $articleList])
        </div>
    </div>

    @include('cms.modals.article-delete-modal')
    @include('cms.modals.published-status-modal')
    @include('cms.modals.script')
@endsection
