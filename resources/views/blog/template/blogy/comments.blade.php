@if($article->allow_comments)
    <hr>
    @php
        $commentsCount = count($article->comments);
        if ($commentsCount === 1) {
            $label = __('comments.comment');
        } elseif ($commentsCount % 10 >= 2 && $commentsCount % 10 <= 4 && ($commentsCount % 100 < 10 || $commentsCount % 100 >= 20)) {
            $label = __('comments.comments');
        } else {
            $label = __('comments.many_comments');
        }
    @endphp

    @if($commentsCount !== 0)
        <h3 class="mb-4">{{ $commentsCount }} {{ $label }}</h3>
    @endif

    @if(count($article->comments) > 0)
        <div class="mt-5">
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
