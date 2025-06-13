@extends('web.template.blogy.main')

@section('content')
    @php
        $a = rand(1, 9);
        $b = rand(1, 9);
        session(['captcha_sum' => $a + $b]);
    @endphp

    <div class="container py-5">
        <div class="comment-form-wrap pt-5">
            <form class="p-5 contact-form-custom" action="{{ route('contact.send') }}" method="POST">
                @csrf

                <h3 class="mb-4 gallery-title">{{ __('blog.contact.title') }}</h3>
                <p class="mb-4">{{ __('blog.contact.content') }}</p>

                <div class="form-group">
                    <label for="contact_name">{{ __('blog.contact.your_name') }}</label>
                    <input type="text" id="contact_name" name="contact_name">
                </div>

                <div class="form-group">
                    <label for="contact_email">{{ __('blog.contact.your_email') }}</label>
                    <input type="email" id="contact_email" name="contact_email">
                </div>

                <div class="form-group">
                    <label for="contact_message">{{ __('blog.contact.message') }}</label>
                    <textarea id="contact_message" name="contact_message" cols="30" rows="6"></textarea>
                </div>

                <div class="form-group">
                    <label for="captcha">
                        {{ __('blog.contact.math_question', ['a' => $a, 'b' => $b]) }}
                    </label>
                    <input type="text"
                           id="captcha"
                           name="captcha"
                           required
                           placeholder="{{ __('blog.contact.captcha_placeholder') }}">
                </div>

                <br>
                <div class="form-group">
                    <input type="submit" value="{{ __('blog.contact.send_message') }}" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection


{{--@extends('web.template.blogy.main')--}}
{{--@section('content')--}}
{{--    @php--}}
{{--        $a = rand(1, 9);--}}
{{--        $b = rand(1, 9);--}}
{{--        session(['captcha_sum' => $a + $b]);--}}
{{--    @endphp--}}

{{--    <div class="container py-5">--}}
{{--        <div class="comment-form-wrap pt-5">--}}
{{--            <form class="p-5 bg-light" action="{{ route('contact.send') }}" method="POST">--}}
{{--                @csrf--}}

{{--                <h3 class="mb-4">{{ __('blog.contact.title') }}</h3>--}}
{{--                <p class="mb-4">{{ __('blog.contact.content') }}</p>--}}

{{--                <div class="form-group">--}}
{{--                    <label for="contact_name">{{ __('blog.contact.your_name') }}</label>--}}
{{--                    <input type="text" class="form-control" id="contact_name" name="contact_name">--}}
{{--                </div>--}}

{{--                <div class="form-group">--}}
{{--                    <label for="contact_email">{{ __('blog.contact.your_email') }}</label>--}}
{{--                    <input type="email" class="form-control" id="contact_email" name="contact_email">--}}
{{--                </div>--}}

{{--                <div class="form-group">--}}
{{--                    <label for="contact_message">{{ __('blog.contact.message') }}</label>--}}
{{--                    <textarea id="contact_message" name="contact_message" cols="30" rows="10" class="form-control"></textarea>--}}
{{--                </div>--}}

{{--                <div class="form-group">--}}
{{--                    <label for="captcha">--}}
{{--                        {{ __('blog.contact.math_question', ['a' => $a, 'b' => $b]) }}--}}
{{--                    </label>--}}
{{--                    <input type="text"--}}
{{--                           id="captcha"--}}
{{--                           name="captcha"--}}
{{--                           class="form-control placeholder-soft"--}}
{{--                           required--}}
{{--                           placeholder="{{ __('blog.contact.captcha_placeholder') }}">--}}
{{--                </div>--}}

{{--                <div class="form-group">--}}
{{--                    <input type="submit" value="{{ __('blog.contact.send_message') }}" class="btn btn-primary">--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
