@extends('blog.template.blogy.main')
@section('content')

    <div class="container py-5">
        <h3 class="gallery-title">Mapa</h3>
        <div id="blog-map"></div>
    </div>

    @include('blog.template.blogy.google-map-script')
@endsection
