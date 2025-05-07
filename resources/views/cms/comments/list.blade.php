@extends('cms-main')
@section('content')
    <div class="w3-container w3-light-grey w3-margin">
        <h2 class="w3-text-dark-grey w3-serif">{{ __('comments.list') }}</h2>

        @forelse($comments as $comment)
            <div class="w3-card w3-white w3-margin-bottom w3-padding w3-round">
                <div class="w3-row" style="display: flex; flex-direction: column; gap: 8px;">

                    <div>
                        <strong>{{ __('comments.author') }}:</strong>
                        {{ $comment->author ?? __('comments.no_author') }}
                    </div>

                    <div>
                        <strong>{{ __('comments.content') }}:</strong>
                        <span class="w3-text-grey">{{ $comment->content }}</span>
                    </div>

                    <div>
                        <strong>{{ __('comments.accepted') }}:</strong>
                        @if($comment->accepted)
                            <span onclick="openAcceptModal({{ $comment->id }}, false)"
                                  class="w3-tag w3-green w3-small w3-round-small w3-hover-shadow"
                                  style="cursor: pointer;">
                                {{ __('comments.accepted_true') }}
                            </span>
                        @else
                            <span onclick="openAcceptModal({{ $comment->id }}, true)"
                                  class="w3-tag w3-red w3-small w3-round-small w3-hover-shadow"
                                  style="cursor: pointer;">
                                {{ __('comments.accepted_false') }}
                            </span>
                        @endif
                    </div>

                    <div>
                        <strong>{{ __('comments.article') }}:</strong>
                        @if(!empty($comment->article_title))
                            <a href="{{ route('article.preview', $comment->article_id) }}" target="_blank">
                                {{ $comment->article_title }}
                            </a>
                        @else
                            <span class="w3-text-red">{{ __('article.article_list.no_title') }}</span>
                        @endif
                    </div>

                    <div class="w3-text-gray w3-small">
                        {{ __('comments.added_on') }} {{ \Carbon\Carbon::parse($comment->add_date)->format('Y-m-d H:i') }}
                    </div>

                </div>
            </div>
        @empty
            <div class="w3-panel w3-pale-yellow w3-border">
                <p>{{ __('comments.empty_list') }}</p>
            </div>
        @endforelse

{{--        <div class="w3-center w3-margin-top w3-margin-bottom">--}}
{{--            @include('pagination', ['paginator' => $comments])--}}
{{--        </div>--}}
    </div>
    @include('cms.modals.accept-comments-modal')
@endsection
