@extends('cms-main')

@section('content')
    <div class="w3-container w3-light-grey w3-margin">
        <h2 class="w3-text-blue">{{ __('article.error_detail') }}</h2>

        <div class="w3-card w3-white w3-padding">
            <div class="w3-margin-bottom"><b>ID:</b> {{ $error->id }}</div>
            <div class="w3-margin-bottom"><b>Level:</b> {{ $error->level }}</div>
            <div class="w3-margin-bottom"><b>Code:</b> {{ $error->code ?? '-' }}</div>
            <div class="w3-margin-bottom"><b>Message:</b> {{ $error->message ?? '-' }}</div>
            <div class="w3-margin-bottom"><b>URL:</b> {{ $error->url ?? '-' }}</div>
            <div class="w3-margin-bottom"><b>File:</b> {{ $error->file ?? '-' }}</div>
            <div class="w3-margin-bottom"><b>Line:</b> {{ $error->line ?? '-' }}</div>
            <div class="w3-margin-bottom"><b>Created at:</b>
                {{ $error->created_at ? \Illuminate\Support\Carbon::make($error->created_at)?->format('Y-m-d H:i:s') : '-' }}
            </div>
            <div class="w3-margin-bottom"><b>Updated at:</b>
                {{ $error->updated_at ? \Illuminate\Support\Carbon::make($error->updated_at)?->format('Y-m-d H:i:s') : '-' }}
            </div>
            <div class="w3-margin-bottom"><b>Trace:</b><br>
                <pre class="w3-small">{{ $error->trace ?? '-' }}</pre>
            </div>
            <div class="w3-margin-bottom"><b>Context:</b><br>
                <pre class="w3-small">{{ $error->context ?? '-' }}</pre>
            </div>

            <div class="w3-margin-top">
                <a href="{{ route('errors.log') }}" class="w3-button w3-grey w3-round">
                    {{ __('article.error_back_to_list') }}
                </a>
            </div>
        </div>
    </div>
@endsection
