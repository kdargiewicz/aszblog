@extends('web.template.one.main')
@section('content')
    <div class="w3-display-container w3-content w3-wide w3-padding-top-24" id="home">

        <div class="w3-container w3-padding-64" id="contact">
            <h1>{{ __('blog.contact.title') }}</h1><br>
            <p>{{ __('blog.contact.content') }}</p>
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <p><input class="w3-input w3-padding-16" type="text" name="contact_name" placeholder="{{ __('blog.contact.your_name') }}" required></p>
                <p><input class="w3-input w3-padding-16" type="email" name="contact_email" placeholder="{{ __('blog.contact.your_email') }}"></p>
                <p><textarea class="w3-input w3-padding-16" name="contact_message" placeholder="{{ __('blog.contact.message') }}" required></textarea></p>
                <p><button class="w3-button w3-light-grey w3-section" type="submit">{{ __('blog.contact.send_message') }}</button></p>


                tu dodaj jakies zabezpieczenie przed botami dodawanie czy cos

            </form>
        </div>
    </div>
@endsection
