@extends('blog.template.blogy.main')
@section('content')
    <div class="container py-5">
        <div class="comment-form-wrap pt-5">
            <h2>{{ __('privacy_policy.title') }}</h2>

            <p><strong>{{ __('privacy_policy.last_update') }}:</strong> {{ __('privacy_policy.last_update_date') }}</p>

            <h4>{{ __('privacy_policy.section1_title') }}</h4>
            <p>{{ __('privacy_policy.section1_content') }}</p>

            <h4>{{ __('privacy_policy.section2_title') }}</h4>
            <p>{!! __('privacy_policy.section2_content') !!}</p>

            <h4>{{ __('privacy_policy.section3_title') }}</h4>
            <p>{{ __('privacy_policy.section3_content') }}</p>

            <h4>{{ __('privacy_policy.section4_title') }}</h4>
            <p>{{ __('privacy_policy.section4_content') }}</p>

            <h4>{{ __('privacy_policy.section5_title') }}</h4>
            <p>{{ __('privacy_policy.section5_content') }}</p>

            <h4>{{ __('privacy_policy.section6_title') }}</h4>
            <p>{{ __('privacy_policy.section6_content') }}</p>

            <h4>{{ __('privacy_policy.section7_title') }}</h4>
            <p>{!! __('privacy_policy.section7_content') !!}</p>

            <h4>{{ __('privacy_policy.section8_title') }}</h4>
            <p>{!! __('privacy_policy.section8_content') !!}</p>

            <h4>{{ __('privacy_policy.section9_title') }}</h4>
            <p>{!! __('privacy_policy.section9_content') !!}</p>

            <h4>{{ __('privacy_policy.section10_title') }}</h4>
            <p>{{ __('privacy_policy.section10_content') }}</p>
        </div>
    </div>
@endsection
