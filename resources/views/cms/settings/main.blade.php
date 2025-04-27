@extends('cms-main')

@section('content')
    <div class="w3-container w3-light-grey w3-margin">
        <h2 class="w3-text-blue">{{ isset($settings) ? __('settings.user_settings.edit') : __('settings.user_settings.add') }}</h2>

        <form method="POST" action="{{ isset($settings) ? route('user_settings.update', $settings->id) : route('user_settings.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Avatar --}}
            <label class="w3-text-grey"><b>@if(!empty($settings->avatar)) {{ __('settings.user_settings.current_avatar') }} @else {{ __('settings.user_settings.avatar') }} @endif</b></label>
            @if(!empty($settings->avatar))
                <div class="w3-margin-bottom">
                    <img src="{{ asset($settings->avatar) }}"
                         alt="Avatar"
                         style="height: 150px; width: 150px; object-fit: cover; border-radius: 50%; border: 2px solid #ccc;">
                </div>
            @endif
            <input class="w3-input w3-border w3-round w3-margin-bottom"
                   type="file"
                   name="avatar"
                   accept="image/*">

            {{-- Main Image --}}
            <label class="w3-text-grey"><b>{{ __('settings.user_settings.main_image') }}</b></label>

            @if(!empty($settings->main_image))
                <div class="w3-margin-bottom">
                    <img src="{{ asset($settings->main_image) }}" alt="Main Image" style="max-height: 150px; border-radius: 8px;">
                </div>
            @endif

            <input class="w3-input w3-border w3-round w3-margin-bottom"
                   type="file"
                   name="main_image"
                   accept="image/*">

            {{-- About Me --}}
            <label class="w3-text-grey"><b>{{ __('settings.user_settings.about_me') }}</b></label>
            <textarea class="w3-input w3-border w3-round w3-margin-bottom"
                      name="about_me"
                      rows="5"
                      placeholder="{{ __('settings.user_settings.about_me_placeholder') }}">{{ old('about_me', $settings->about_me ?? '') }}</textarea>

            {{-- My Motto --}}
            <label class="w3-text-grey"><b>{{ __('settings.user_settings.my_motto') }}</b></label>
            <input class="w3-input w3-border w3-round w3-margin-bottom"
                   type="text"
                   name="my_motto"
                   value="{{ old('my_motto', $settings->my_motto ?? '') }}"
                   placeholder="{{ __('settings.user_settings.my_motto_placeholder') }}">

            {{-- Blog Template --}}
            <label class="w3-text-grey"><b>{{ __('settings.user_settings.blog_template') }}</b></label>
            <select class="w3-select w3-border w3-round w3-margin-bottom" name="blog_template">
                <option value="" {{ old('blog_template', $settings->blog_template ?? '') === '' ? 'selected' : '' }}>
                    {{ __('settings.user_settings.blog_template_select') }}
                </option>
                <option value="one" {{ old('blog_template', $settings->blog_template ?? '') === 'one' ? 'selected' : '' }}>
                    One
                </option>
                <option value="two" {{ old('blog_template', $settings->blog_template ?? '') === 'two' ? 'selected' : '' }}>
                    Two
                </option>
                <option value="minimalist" {{ old('blog_template', $settings->blog_template ?? '') === 'minimalist' ? 'selected' : '' }} disabled>
                    Minimalist
                </option>
                {{-- Dodaj więcej szablonów jak będziesz miał --}}
            </select>

            <button type="submit" class="w3-button w3-blue w3-round w3-margin-top">
                {{ isset($settings) ? __('buttons.update') : __('buttons.save') }}
            </button>

        </form>
    </div>
@endsection
