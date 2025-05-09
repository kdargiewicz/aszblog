@extends('web.template.one.main')
@section('content')
    <div class="w3-content w3-padding-64">
        <h2 class="w3-center w3-padding-top-48">{{ __('blog.gallery') }}</h2>
        <div class="w3-row-padding w3-margin-top">
            @foreach($images as $image)
                <div class="w3-quarter w3-container w3-margin-bottom w3-padding-top-24">
                    <div class="image-box" onclick="openModal('{{ asset($image['url']) }}', '{{ $image['article_id'] }}')">
                        <img src="{{ asset($image['url']) }}" class="gallery-image" alt="">
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div id="imageModal" class="w3-modal" onclick="closeModal(event)">
        <div class="w3-modal-content w3-animate-zoom w3-center w3-padding-large w3-white" style="max-width: 90%; position: relative;">
            <span onclick="closeModal()" class="w3-button w3-display-topright w3-large">&times;</span>
            <img id="modalImage" src="" style="width: 100%; height: auto; border-radius: 6px;" alt="error">
            <p id="modalCaption" class="w3-small w3-padding-top"></p>

            <a href="{{ route('article.preview', $image['article_id']) }}"
               class="w3-button w3-teal w3-margin-top"
               id="modalLink"
               target="_blank">
                {{ __('blog.go_to_article') }}
            </a>
        </div>
    </div>

    <script>
        function openModal(src, articleId) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').style.display = 'block';
            document.getElementById('modalLink').href = `{{ url('/article-preview') }}/${articleId}`;
        }

        function closeModal(event) {
            if (event.target.id === 'imageModal') {
                document.getElementById('imageModal').style.display = 'none';
            }
        }
    </script>
@endsection

