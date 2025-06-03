@extends('cms-main')

@section('content')
    <div class="w3-container w3-light-grey w3-margin">
        <h2 class="w3-text-dark-grey w3-serif">{{ isset($settings) ? __('settings.user_settings.edit') : __('settings.user_settings.add') }}</h2>

        <form method="POST"
              action="{{ isset($settings) ? route('user_settings.update', $settings->id) : route('user_settings.store') }}"
              enctype="multipart/form-data">
            @csrf

            <label class="w3-text-grey">
                <b>
                    @if(!empty($settings->avatar))
                        {{ __('settings.user_settings.current_avatar') }}
                    @else
                        {{ __('settings.user_settings.avatar') }}
                    @endif
                </b>
            </label>

            @if(!empty($settings->avatar))
                <div class="w3-margin-bottom">
                    <img src="{{ asset($settings->avatar) }}"
                         alt="Avatar"
                         style="height: 150px; width: 150px; object-fit: cover; border-radius: 50%; border: 2px solid #ccc;">
                </div>
            @endif

            <div class="w3-margin-bottom">
                <label for="avatarUpload" class="btn btn-primary">
                    <i class="fa fa-upload"
                       aria-hidden="true"></i> {{ __('settings.user_settings.select_avatar_image') }}
                </label>
                <input id="avatarUpload"
                       type="file"
                       name="avatar"
                       accept="image/*"
                       style="display: none;">
            </div>


            @if($isBlogOwner)
                <label class="w3-text-grey"><b>{{ __('settings.user_settings.main_image') }}</b></label>

                <label class="w3-text-grey">
                    <b>
                        {{ __('settings.user_settings.main_image') ?? __('settings.user_settings.select_main_image') }}
                    </b>
                </label>

                @if(!empty($settings->main_image))
                    <div class="w3-margin-bottom">
                        <img src="{{ asset($settings->main_image) }}"
                             alt="Main Image"
                             style="max-height: 150px; border-radius: 8px;">
                    </div>
                @else
                    <div class="w3-margin-bottom w3-text-grey w3-small">
                        <i class="fa fa-image fa-2x" aria-hidden="true" style="display: block; margin-bottom: 4px;"></i>
                        <i>{{ __('settings.user_settings.no_main_image') }}</i>
                    </div>
                @endif

                <div class="w3-margin-bottom">
                    <label for="mainImageUpload" class="btn btn-primary">
                        <i class="fa fa-upload"
                           aria-hidden="true"></i> {{ __('settings.user_settings.select_main_image') }}
                    </label>
                    <input id="mainImageUpload"
                           type="file"
                           name="main_image"
                           accept="image/*"
                           style="display: none;">
                </div>


                <h4 class="w3-text-dark-grey w3-serif">{{ __('settings.user_settings.about_me_title') }}</h4>

                <label class="w3-text-grey"><b>{{ __('settings.user_settings.about_me_main_image') }}</b></label>

                <label class="w3-text-grey">
                    <b>{{ __('settings.user_settings.about_me_image') ?? 'Zdjęcie autora' }}</b>
                </label>

                @if(!empty($settings->about_me_image))
                    <div class="w3-margin-bottom">
                        <img src="{{ asset($settings->about_me_image) }}"
                             alt="About Me Image"
                             style="max-height: 150px; border-radius: 8px;">
                    </div>
                @else
                    <div class="w3-margin-bottom w3-text-grey w3-small" style="display: flex; align-items: flex-start;">
                        <div style="text-align: center;">
                            <i class="fa fa-user-circle fa-2x" aria-hidden="true" style="display: block;"></i>
                            <span style="display: block; margin-top: 4px;">
                                <i>{{ __('settings.user_settings.no_photo') }}</i>
                            </span>
                        </div>
                    </div>
                @endif

                <div class="w3-margin-bottom">
                    <label for="aboutMeUpload" class="btn btn-primary">
                        <i class="fa fa-upload"
                           aria-hidden="true"></i> {{ __('settings.user_settings.about_me_main_image') }}
                    </label>
                    <input id="aboutMeUpload"
                           type="file"
                           name="about_me_image"
                           accept="image/*"
                           style="display: none;">
                </div>

                <label class="w3-text-grey">
                    <b>{{ __('settings.user_settings.about_me') }}</b>
                </label>

                <textarea id="aboutMeEditor"
                          class="w3-input w3-border w3-round w3-margin-bottom"
                          name="about_me"
                          rows="5"
                          placeholder="{{ __('settings.user_settings.about_me_placeholder') }}">{{ old('about_me', $settings->about_me ?? '') }}</textarea>

                <label class="w3-text-grey"><b>{{ __('settings.user_settings.my_motto') }}</b></label>
                <input class="w3-input w3-border w3-round w3-margin-bottom"
                       type="text"
                       name="my_motto"
                       value="{{ old('my_motto', $settings->my_motto ?? '') }}"
                       placeholder="{{ __('settings.user_settings.my_motto_placeholder') }}">

                <label class="w3-text-grey"><b>{{ __('settings.user_settings.blog_template') }}</b></label>
                <select class="w3-select w3-border w3-round w3-margin-bottom" name="blog_template">
                    <option
                        value="" {{ old('blog_template', $settings->blog_template ?? '') === '' ? 'selected' : '' }}>
                        {{ __('settings.user_settings.blog_template_select') }}
                    </option>
                    <option
                        value="one" {{ old('blog_template', $settings->blog_template ?? '') === 'one' ? 'selected' : '' }}>
                        One
                    </option>
                    <option value="two"
                            {{ old('blog_template', $settings->blog_template ?? '') === 'two' ? 'selected' : '' }} disabled>
                        Two
                    </option>
                    <option value="blogy"
                            {{ old('blog_template', $settings->blog_template ?? '') === 'blogy' ? 'selected' : '' }}>
                        blogy
                    </option>
                    <option value="minimalist"
                            {{ old('blog_template', $settings->blog_template ?? '') === 'minimalist' ? 'selected' : '' }} disabled>
                        Minimalist
                    </option>
                </select>

                <label for="color_topbar">{{ __('settings.user_settings.menu-footer-color') }}</label>
                <input type="color"
                       name="main_colors[topbar-footer]"
                       value="{{ $settings->main_colors['topbar-footer'] ?? '#333333' }}"
                       style="width: 100%; height: 3rem; border: 1px solid #ccc; border-radius: 6px; margin-bottom: 1rem;">

                <label for="color_body">{{ __('settings.user_settings.body-bg-color') }}</label>
                <input type="color"
                       name="main_colors[body]"
                       value="{{ $blogSettings->main_colors['body'] ?? '#ffffff' }}"
                       style="width: 100%; height: 3rem; border: 1px solid #ccc; border-radius: 6px; margin-bottom: 1rem;">

                <label for="color_font">{{ __('settings.user_settings.font-color') }}</label>
                <input type="color"
                       name="main_colors[font-color]"
                       value="{{ $blogSettings->main_colors['font-color'] ?? '#ffffff' }}"
                       style="width: 100%; height: 3rem; border: 1px solid #ccc; border-radius: 6px; margin-bottom: 1rem;">
            @endif

            @if(isset($settings))
                <button type="submit" name="action" value="restore_colors" class="w3-button w3-red w3-round w3-margin-top">
                    {{ __('settings.user_settings.restore_colors_button') }}
                </button>
            @endif

            <button type="submit" class="w3-button w3-blue w3-round w3-margin-top">
                {{ isset($settings) ? __('buttons.update') : __('buttons.save') }}
            </button>

        </form>
    </div>

    @include('web.template.tinymce')

@endsection
