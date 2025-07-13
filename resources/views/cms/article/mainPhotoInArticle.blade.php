@extends('cms-main')

@section('content')
    <div class="w3-container w3-light-grey w3-margin">
        <h2 class="w3-text-dark-grey w3-serif">{{ __('article.article_list.choose_main_image_for_articles') }}</h2>

        <form method="POST" action="{{ route('store-main-photos-in-articles') }}">
            @csrf

            @foreach($articleImagesList as $articleId => $images)
                <div class="w3-card w3-paper w3-margin-bottom w3-padding w3-round">
                    <h4>
                        {!! __('article.article_list.article_heading', [
                            'id' => $articleId,
                            'title' => $images[0]->article_title
                                ? $images[0]->article_title
                                : '<span style="color: red; font-weight: bold;">' . __('article.article_list.no_title') . '</span>'
                        ]) !!}

                        <span class="w3-tag
                             {{ $images[0]->article_is_published == \App\Constants\Constants::PUBLISHED
                                    ? 'w3-green'
                                    : ($images[0]->article_is_published == \App\Constants\Constants::TEST_PUBLISHED
                                        ? 'w3-yellow'
                                        : 'w3-red') }}
                             w3-small w3-round-small w3-hover-shadow"
                              style="cursor: pointer;">

                            @if($images[0]->article_is_published == \App\Constants\Constants::PUBLISHED)
                                {{ __('article.article_action.published') }}
                            @elseif($images[0]->article_is_published == \App\Constants\Constants::TEST_PUBLISHED)
                                {{ __('article.article_action.test-published') }}
                            @else
                                {{ __('article.article_action.not-published') }}
                            @endif
                        </span>
                    </h4>

                    <div class="w3-row">
                        @foreach($images as $image)
                            <div class="w3-col m3 w3-center w3-padding">
                                <label>
                                    <img src="{{ asset($image->imageUrl) }}" class="w3-image" style="max-width: 200px;">
                                    <br>

                                    {{-- Checkbox: główne zdjęcie --}}
                                    <input type="radio" name="main_image[{{ $articleId }}]"
                                           value="{{ $image->imageId }}" {{ $image->is_main_photo ? 'checked' : '' }}>
                                    {{ __('article.article_action.main_image') }}
                                    <br>

                                    {{-- Checkbox: pokazuj w galerii --}}
                                    <input type="checkbox" name="show_in_gallery[{{ $image->imageId }}]"
                                           value="1" {{ $image->show_in_gallery ? 'checked' : '' }}>
                                    {{ __('article.article_action.show_in_gallery') }}
                                </label>
                            </div>

                            {{--                            <div class="w3-col m3 w3-center w3-padding">--}}
{{--                                <label>--}}
{{--                                    <img src="{{ asset($image->imageUrl) }}" class="w3-image" style="max-width: 200px;">--}}
{{--                                    <br>--}}
{{--                                    <input type="radio" name="main_image[{{ $articleId }}]"--}}
{{--                                           value="{{ $image->imageId }}" {{ $image->is_main_photo ? 'checked' : '' }}>--}}
{{--                                    {{ __('article.article_action.main_image') }}--}}
{{--                                </label>--}}
{{--                            </div>--}}
                        @endforeach
                    </div>
                </div>
            @endforeach

            <button class="w3-button w3-blue w3-margin-top" type="submit">Zapisz</button>
        </form>
    </div>
@endsection

