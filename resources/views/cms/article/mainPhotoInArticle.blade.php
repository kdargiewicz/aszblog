@extends('cms-main')

@section('content')
    <div class="w3-container w3-light-grey w3-margin">
        <h2 class="w3-text-dark-grey w3-serif">{{ __('article.article_list.choose_main_image_for_articles') }}</h2>

        <form method="POST" action="{{ route('store-main-photos-in-articles') }}">
            @csrf

            @foreach($articleImagesList as $articleId => $images)
                <div class="w3-panel w3-border w3-white w3-padding">
                    <h4>{{ __('article.article_list.article_heading', ['id' => $articleId, 'title' => $images[0]->article_title]) }} @if($images[0]->article_is_published == 0 ) {{ __('article.article_action.not-published') }} @elseif($images[0]->article_is_published == 1) {{ __('article.article_action.test-published') }} @elseif($images[0]->article_is_published == 2) {{ __('article.article_action.published') }} @endif</h4>
                    
                    <div class="w3-row">
                        @foreach($images as $image)
                            <div class="w3-col m3 w3-center w3-padding">
                                <label>
                                    <img src="{{ asset($image->imageUrl) }}" class="w3-image" style="max-width: 200px;">
                                    <br>
                                    <input type="radio" name="main_image[{{ $articleId }}]" value="{{ $image->imageId }}" {{ $image->is_main_photo ? 'checked' : '' }}>
                                    {{ __('article.article_action.main_image') }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <button class="w3-button w3-blue w3-margin-top" type="submit">Zapisz</button>
        </form>
    </div>
@endsection

