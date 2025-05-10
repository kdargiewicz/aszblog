@extends('web.template.one.main')
@section('content')
    <div class="w3-content w3-padding-64 w3-margin-top">
        <h1 class="title w3-center">
            {{ __('blog.about_me') }}
        </h1>

        <div class="w3-center">
            @if($blogSettings && $blogSettings->about_me_image)
                <img src="{{ asset($blogSettings->about_me_image) }}"
                     alt="about-me"
                     class="w3-image about_me_image">
            @else
                <img src="{{ asset('img/about_me.jpeg') }}"
                     alt="about-me"
                     class="w3-image about_me_image">
            @endif
        </div>

        <div class="w3-row-padding w3-margin-top">
            <div class="w3-container w3-padding-large" style="max-width: 900px; margin: 0 auto;">
                <p style="font-size: 1.1em; line-height: 1.8;">
                    @if($blogSettings && $blogSettings->about_me)
                        {!! $blogSettings->about_me !!}
                    @else
                        {!! __('blog.about_me_text') !!}
                    @endif
                </p>
            </div>
        </div>
    </div>

@endsection

