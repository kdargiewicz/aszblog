@extends('web.template.one.main')
@section('content')
    <div class="w3-padding-top-48">
        <div class="w3-display-container w3-content w3-wide w3-padding-top-48" id="home">
            <div class="w3-margin-top" id="blog-map"></div>
        </div>
    </div>
    @include('web.template.google-map-script')
@endsection
