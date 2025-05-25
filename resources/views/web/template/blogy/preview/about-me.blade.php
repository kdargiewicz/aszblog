@extends('web.template.blogy.main')
@section('content')
    <div class="section">
        <div class="container">
            <div class="about-me-block clearfix">
                <img src="{{ asset($blogSettings->about_me_image ?? 'web/theme/blogy/images/img_7_sq.jpg') }}"
                     alt="About Me"
                     class="about-me-image img-fluid rounded">

                <div class="about-me-text">
                    {!! $blogSettings->about_me ?? __('blog.about_me_text') !!}
                </div>
            </div>
        </div>
    </div>

    {{--    <div class="section">--}}
{{--        <div class="container">--}}
{{--            <div class="row justify-content-between">--}}
{{--                @if($blogSettings && $blogSettings->about_me_image)--}}
{{--                    <div class="col-lg-7 mb-4 mb-lg-0">--}}
{{--                        <img src="{{ asset($blogSettings->about_me_image) }}" alt="Image" class="img-fluid rounded--}}
{{--                        ">--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="col-lg-7 mb-4 mb-lg-0">--}}
{{--                        <img src="{{ asset('web/theme/blogy/images/img_7_sq.jpg') }}" alt="Image" class="img-fluid rounded--}}
{{--                        ">--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                <div class="col-lg-4 ps-lg-2">--}}
{{--                    <div class="mb-5">--}}
{{--                        <div style="font-size: 1.1em; line-height: 1.8; text-align: justify;">--}}
{{--                            @if($blogSettings && $blogSettings->about_me)--}}
{{--                                {!! $blogSettings->about_me !!}--}}
{{--                            @else--}}
{{--                                {!! __('blog.about_me_text') !!}--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
