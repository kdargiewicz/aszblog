@extends('web.template.one.main')
@section('content')
    @php
        $a = rand(1, 9);
        $b = rand(1, 9);
        session(['captcha_sum' => $a + $b]);
    @endphp

    <div class="w3-display-container w3-content w3-wide w3-padding-top-24" id="home">

        <div class="w3-container w3-padding-64" id="contact">
            <h1>{{ __('blog.contact.title') }}</h1><br>
            <p>{{ __('blog.contact.content') }}</p>
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <p><input class="w3-input w3-padding-16" type="text" name="contact_name"
                          placeholder="{{ __('blog.contact.your_name') }}" required></p>
                <p><input class="w3-input w3-padding-16" type="email" name="contact_email"
                          placeholder="{{ __('blog.contact.your_email') }}"></p>
                <p><textarea class="w3-input w3-padding-16" name="contact_message"
                             placeholder="{{ __('blog.contact.message') }}" required></textarea></p>

                <p><label for="captcha" style="font-size: 14px; color: #999; display: block; margin-bottom: 6px;">
                        {{ __('blog.contact.math_question', ['a' => $a, 'b' => $b]) }}
                    </label>
                    <input class="w3-input w3-padding-16" type="text" name="captcha" required
                           placeholder="{{ __('blog.contact.enter_result') }}"></p>
                <p>
                    <button class="w3-button w3-light-grey w3-section"
                            type="submit">{{ __('blog.contact.send_message') }}</button>
                </p>
            </form>
        </div>
    </div>
@endsection
