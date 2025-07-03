@extends('cms-main')
@section('content')
    <div class="w3-container w3-light-grey w3-margin">
        <h2 class="w3-text-dark-grey w3-serif">{{ isset($article) ? 'Edycja arta ID: ' . $article->id :  __('article.add') }}</h2>
            <form method="POST" action="{{ isset($article) ? route('article.update', $article->id) : route('article.store') }}">
                @csrf
                <input type="hidden" id="article_uuid" name="article_uuid" value="{{ old('article_uuid', $article->article_uuid ?? (string) Str::uuid()) }}">

            <label class="w3-text-grey"><b>{{ __('article.create-form.title') }}</b></label>
            <input class="w3-input w3-border w3-round w3-margin-bottom"
                   name="title" type="text" value="{{ old('title', $article->title ?? '') }}" placeholder="{{ __('article.create-form.title-placeholder') }}">

            <label class="w3-text-grey"><b>{{ __('article.create-form.tags') }}</b></label>
            <input class="w3-input w3-border w3-round w3-margin-bottom"
                   name="tags" type="text" value="{{ old('title', $dto->tags ?? '') }}" placeholder="{{ __('article.create-form.tags-placeholder') }}">

                <label class="w3-text-grey">
                    <b>{{ __('article.create-form.category') }}</b>
                </label>

                <label class="w3-text-grey">
                    <b>{{ __('article.create-form.category') }}</b>
                </label>

                <input
                    list="category-options"
                    name="category"
                    class="w3-input w3-border w3-round w3-margin-bottom"
                    placeholder="{{ __('article.create-form.select-category') }}"
                    value="{{ old('category', $dto->category ?? '') }}"
                >

                <datalist id="category-options">
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}">
                    @endforeach
                </datalist>

            <label class="w3-text-grey"><b>{{ __('article.create-form.set-map-location') }}</b></label>
            <div id="map" style="height: 400px; width: 100%;" class="w3-margin-bottom w3-border w3-round"></div>
                <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $article->latitude ?? '52.2297') }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $article->longitude ?? '21.0122') }}">

                <label class="w3-text-grey">
                    <b>{{ __('article.create-form.content') }}</b>
                </label>

                <textarea class="w3-input w3-border w3-round w3-margin-bottom"
                          style="height: 110vh;"
                          id="editor"
                          name="content"
                          rows="10"
                          placeholder="{{ __('article.create-form.content-placeholder') }}"
                >{{ old('content', $article->content ?? '') }}</textarea>

                @if(isset($article) && $article->created_at)
                    <label class="w3-text-grey">
                        <b>{{ __('article.create-form.date_time') }}</b>
                    </label>
                    <input type="datetime-local"
                           id="created_at"
                           name="created_at"
                           class="w3-input w3-border w3-round w3-margin-bottom"
                           value="{{ old('created_at', \Carbon\Carbon::parse($article->created_at)->format('Y-m-d\TH:i')) }}">
                @endif

                <label class="w3-text-grey">
                    <b>{{ __('article.create-form.allow-comments') }}</b>
                </label>

                <select class="w3-select w3-border w3-round w3-margin-bottom" name="allow_comments">
                    <option value="" {{ old('allow_comments', isset($article) ? (int) $article->allow_comments : '') === '' ? 'selected' : '' }}>
                        {{ __('article.create-form.allow-comments-select') }}
                    </option>
                    <option value="1" {{ old('allow_comments', isset($article) ? (int) $article->allow_comments : '') === 1 ? 'selected' : '' }}>
                        {{ __('article.create-form.allow-comments-yes') }}
                    </option>
                    <option value="0" {{ old('allow_comments', isset($article) ? (int) $article->allow_comments : '') === 0 ? 'selected' : '' }}>
                        {{ __('article.create-form.allow-comments-no') }}
                    </option>
                </select>

                <button class="btn btn-primary" type="submit" name="action" value="save">
                    {{ isset($article) ? __('buttons.update') : __('buttons.save') }}
                </button>

                @if (isset($article))
                    <button type="submit" class="btn btn-success" name="action" value="preview" formtarget="_blank">
                        {{ __('buttons.update_and_preview') }}
                    </button>
                @endif
            </form>
    </div>

    @include('cms.article.tinymce-script')
@endsection

@section('scripts')
    @include('cms.article.map-script')
@endsection
