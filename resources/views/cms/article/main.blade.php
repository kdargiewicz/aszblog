@extends('cms-main')
@section('content')
    <div class="w3-container w3-light-grey w3-margin">
        <h2 class="w3-text-dark-grey w3-serif">{{ isset($article) ? 'Edycja arta ID: ' . $article->id :  __('article.add') }}</h2>

        <div class="w3-bar w3-border-bottom w3-light-grey">
            <button class="w3-bar-item w3-button tablink" data-tab="general">{{ __('article.tab-link.general') }}</button>
            <button class="w3-bar-item w3-button tablink" data-tab="map-content">{{ __('article.tab-link.map') }}</button>
            <button class="w3-bar-item w3-button tablink" data-tab="content">{{ __('article.tab-link.contents') }}</button>
            @if(isset($article))
                <button class="w3-bar-item w3-button tablink" data-tab="gallery">{{ __('article.tab-link.gallery') }}</button>
            @endif
            <button class="w3-bar-item w3-button tablink" data-tab="settings">{{ __('article.tab-link.settings') }}</button>
            <button class="w3-bar-item w3-button tablink" data-tab="saved-versions">{{ __('article.tab-link.saved-versions') }}</button>
        </div>

        <form method="POST" action="{{ isset($article) ? route('article.update', $article->id) : route('article.store') }}">
            @csrf
            <input type="hidden" id="article_uuid" name="article_uuid" value="{{ old('article_uuid', $article->article_uuid ?? (string) Str::uuid()) }}">

            <div id="general" class="tabcontent" style="display:block">
                <label class="w3-text-grey"><b>{{ __('article.create-form.title') }}</b></label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" name="title" type="text" value="{{ old('title', $article->title ?? '') }}" placeholder="{{ __('article.create-form.title-placeholder') }}">

                <label class="w3-text-grey"><b>{{ __('article.create-form.tags') }}</b></label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" name="tags" type="text" value="{{ old('title', $dto->tags ?? '') }}" placeholder="{{ __('article.create-form.tags-placeholder') }}">

                <label class="w3-text-grey"><b>{{ __('article.create-form.category') }}</b></label>
                <input list="category-options" name="category" class="w3-input w3-border w3-round w3-margin-bottom" placeholder="{{ __('article.create-form.select-category') }}" value="{{ old('category', $dto->category ?? '') }}">
                <datalist id="category-options">
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}">
                    @endforeach
                </datalist>
            </div>

            <div id="map-content" class="tabcontent" style="display:none">
                <label class="w3-text-grey"><b>{{ __('article.create-form.set-map-location') }}</b></label>
                    <div id="map" style="height: 400px; width: 100%;" class="w3-margin-bottom w3-border w3-round"></div>
                        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $article->latitude ?? '52.2297') }}">
                        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $article->longitude ?? '21.0122') }}">
            </div>

            <div id="content" class="tabcontent" style="display:none">
                <label class="w3-text-grey"><b>{{ __('article.create-form.content') }}</b></label>
                <textarea class="w3-input w3-border w3-round w3-margin-bottom" style="height: 210vh;" id="editor" name="content" rows="50" placeholder="{{ __('article.create-form.content-placeholder') }}">{{ old('content', $article->content ?? '') }}</textarea>
            </div>

            <div id="gallery" class="tabcontent" style="display:none">
                <div class="w3-row">
                    @if(isset($imagesListFromArticle))
                        @foreach($imagesListFromArticle as $image)
                            <div class="w3-col m3 w3-padding">
                                <div class="w3-white w3-padding-small" style="height: 100%; display: flex; flex-direction: column; align-items: stretch; gap: 10px; border: 1px solid #ccc;">
                                    @if (!empty($image->imageUrl))
                                        <img src="{{ asset($image->imageUrl) }}"
                                             class="w3-image"
                                             style="max-width: 100%; height: auto; max-height: 160px; object-fit: cover;"
                                             alt="{{ $image->imageAlt ?? 'zdjęcie' }}">
                                    @else
                                        <div class="w3-text-red w3-small"
                                             style="min-height: 160px; display: flex; align-items: center; justify-content: center; text-align: center; padding: 8px; background: #f3f3f3;">
                                            {{ __('article.article_action.no_image') }}
                                        </div>
                                    @endif

                                    <div class="w3-small" style="text-align: left;">
                                        <label>
                                            <input type="radio" name="main_image[{{ $article->id }}]"
                                                   value="{{ $image->imageId }}" {{ $image->is_main_photo ? 'checked' : '' }}>
                                            {{ __('article.article_action.main_image') }}
                                        </label>
                                    </div>

                                    <div class="w3-small" style="text-align: left;">
                                        <label>
                                            <input type="checkbox" name="show_in_gallery[{{ $image->imageId }}]"
                                                   value="1" {{ $image->show_in_gallery ? 'checked' : '' }}>
                                            {{ __('article.article_action.show_in_gallery') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>

            <div id="settings" class="tabcontent" style="display:none">
                <label class="w3-text-grey"><b>{{ __('article.create-form.use_system_image_layout') }}</b></label>
                <select class="w3-select w3-border w3-round w3-margin-bottom" name="use_system_image_layout" disabled>
                    <option value="" {{ old('use_system_image_layout', isset($article) ? (int) $article->use_system_image_layout : '') === '' ? 'selected' : '' }}>{{ __('article.create-form.allow-comments-select') }}</option>
                    <option value="1" {{ old('use_system_image_layout', isset($article) ? (int) $article->use_system_image_layout : '') === 1 ? 'selected' : '' }}>{{ __('article.create-form.allow-comments-yes') }}</option>
                    <option value="0" {{ old('use_system_image_layout', isset($article) ? (int) $article->use_system_image_layout : '') === 0 ? 'selected' : '' }}>{{ __('article.create-form.allow-comments-no') }}</option>
                </select>

                @if(isset($article) && $article->created_at)
                    <label class="w3-text-grey"><b>{{ __('article.create-form.date_time') }}</b></label>
                    <input type="datetime-local" id="created_at" name="created_at" class="w3-input w3-border w3-round w3-margin-bottom" value="{{ old('created_at', \Carbon\Carbon::parse($article->created_at)->format('Y-m-d\TH:i')) }}">
                @endif

                <label class="w3-text-grey"><b>{{ __('article.create-form.allow-comments') }}</b></label>
                <select class="w3-select w3-border w3-round w3-margin-bottom" name="allow_comments">
                    <option value="" {{ old('allow_comments', isset($article) ? (int) $article->allow_comments : '') === '' ? 'selected' : '' }}>{{ __('article.create-form.allow-comments-select') }}</option>
                    <option value="1" {{ old('allow_comments', isset($article) ? (int) $article->allow_comments : '') === 1 ? 'selected' : '' }}>{{ __('article.create-form.allow-comments-yes') }}</option>
                    <option value="0" {{ old('allow_comments', isset($article) ? (int) $article->allow_comments : '') === 0 ? 'selected' : '' }}>{{ __('article.create-form.allow-comments-no') }}</option>
                </select>
            </div>

            <div id="saved-versions" class="tabcontent" style="display:none">
                <label class="w3-text-grey"><b>{{ __('article.create-form.saved-versions') }}</b></label>
                <div id="saved-versions" style="height: 400px; width: 100%;" class="w3-margin-bottom w3-border w3-round">
                    <h3>tu wyswietlam zapisane auto wersje arta z podgladem w modalu i mozliwoscia wczytania wersji</h3>
                </div>
            </div>

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
    @include('cms.article.autosave-js-script')
@endsection

@section('scripts')
    @include('cms.article.map-script')
@endsection
