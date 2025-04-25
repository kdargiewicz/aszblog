@extends('cms-main')
@section('content')
    <div class="w3-container w3-light-grey w3-margin">
        <h2 class="w3-text-blue">{{ isset($article) ? 'Edycja arta ID: ' . $article->id :  __('article.add') }}</h2>
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
                          style="height: 50vh;"
                          id="editor"
                          name="content"
                          rows="10"
                          placeholder="{{ __('article.create-form.content-placeholder') }}"
                >{{ old('content', $article->content ?? '') }}</textarea>

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

                <button class="w3-button w3-blue w3-round w3-margin-top" type="submit">
                    {{ isset($article) ? __('buttons.update') : __('buttons.save') }}
                </button>

            </form>

        @if(Auth::user()->is_admin)
            </br></br></br></br>
        TO ZOSTAJE DO TESTOW ! ! !

        <h2>Upload zdjęcia testowego</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            <p><strong>Wersja max:</strong> <a href="{{ session('max') }}" target="_blank">{{ session('max') }}</a></p>
            <p><strong>Wersja min:</strong> <a href="{{ session('min') }}" target="_blank">{{ session('min') }}</a></p>
            <img src="{{ session('min') }}" style="max-width: 200px; margin-top: 10px;">
        @endif

        <form method="POST" action="{{ route('image.upload') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="image" class="form-label">Wybierz zdjęcie:</label>
                <input type="file" class="form-control" id="image" name="image" required accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Wyślij</button>
        </form>
        @endif

    </div>

    @include('cms.article.tinymce-script')
@endsection

@section('scripts')
    @include('cms.article.map-script')
@endsection
