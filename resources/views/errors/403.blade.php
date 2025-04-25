@extends('errors.main')
@section('error-content')
    <div class="w3-container error-message">
        <h1 class="w3-xxxlarge w3-text-light-grey">{{ __('errors.403') }}</h1>
        <h2 class="w3-xlarge">{{ __('errors.403_error') }}</h2>
        <p class="w3-large">{{ __('errors.try_again_later') }}</p>

        <a href="{{ route('dashboard') }}" class="w3-button w3-blue w3-margin-top">
            {{ __('errors.back_to_dashboard') }}
        </a>
    </div>
@endsection
