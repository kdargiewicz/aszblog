@ -0,0 +1,43 @@
@extends('cms-main')
@section('content')
    <div class="w3-container w3-light-grey w3-margin">
        <h2 class="w3-text-blue">{{ __('article.error') }}</h2>
        <div class="w3-card w3-white w3-margin-bottom w3-padding">
            <div class="w3-row">
                <div class="w3-responsive">
                    <div class="w3-row w3-border-bottom w3-padding w3-light-grey w3-hide-small w3-hide-medium">
                        <div class="w3-col l1"><b>ID</b></div>
                        <div class="w3-col l1"><b>Level</b></div>
                        <div class="w3-col l1"><b>Code</b></div>
                        <div class="w3-col l1"><b>Line</b></div>
                        <div class="w3-col l1"><b>Created</b></div>
                        <div class="w3-col l2"><b>Message</b></div>
                        <div class="w3-col l2"><b>URL</b></div>
                        <div class="w3-col l3"><b>File</b></div>
                    </div>
                    @foreach($errors as $error)
                        <a href="{{ route('error.show', $error->id) }}"
                           class="w3-row w3-border-bottom w3-padding w3-hover-light-grey"
                           style="text-decoration: none; color: inherit; display: block; cursor: pointer;">

                            <div class="w3-col l1">{{ $error->id }}</div>
                            <div class="w3-col l1">{{ $error->level }}</div>
                            <div class="w3-col l1">{{ $error->code ?? '-' }}</div>
                            <div class="w3-col l1 w3-small">{{ Str::limit($error->line ?? '-', 10) }}</div>
                            <div class="w3-col l1 w3-tiny">
                                {{ $error->created_at ? \Illuminate\Support\Carbon::make($error->created_at)?->format('Y-m-d') : '-' }}
                            </div>
                            <div class="w3-col l2 w3-small">{{ Str::limit($error->message, 50) }}</div>
                            <div class="w3-col l2 w3-small" style="word-wrap: break-word; overflow-wrap: break-word;">
                                {{ Str::limit($error->url, 50) }}
                            </div>
                            <div class="w3-col l3 w3-small" style="word-wrap: break-word; overflow-wrap: break-word;">
                                {{ Str::limit(str_replace(base_path() . '/', '', $error->file), 100) }}
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="w3-center w3-margin-top">
                    @include('pagination', ['paginator' => $errors])
                </div>
            </div>
        </div>
    </div>
@endsection
