@extends('blog.template.blogy.main')
@section('content')
    <div class="section">
        <div class="container">
            <div class="about-me-block clearfix shadow-box custom-user-color">
                <img src="{{ asset($blogSettings->about_me_image ?? 'web/theme/blogy/images/img_7_sq.jpg') }}"
                     alt="About Me"
                     class="about-me-image img-fluid rounded">

                <div class="about-me-text custom-font-color">
                    {!! $blogSettings->about_me ?? __('blog.about_me_text') !!}
                </div>
            </div>
        </div>
    </div>

@endsection
