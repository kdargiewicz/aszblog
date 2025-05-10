@extends('web.template.one.main')
@section('content')
    <div class="w3-content w3-padding-64 w3-margin-top">
        <h1 class="title w3-center">
            {{ __('blog.about_me') }}
        </h1>

        <div class="w3-center">
            <img src="{{ asset('img/about_me.jpeg') }}"
                 alt="about-me"
                 class="w3-image"
                 style="max-width: 300px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);">
        </div>

        <div class="w3-row-padding w3-margin-top">
            <div class="w3-container w3-padding-large" style="max-width: 900px; margin: 0 auto;">
                <p style="font-size: 1.1em; line-height: 1.8;">
                    {!! __('blog.about_me_text') !!}
                </p>
            </div>
        </div>
    </div>

@endsection

