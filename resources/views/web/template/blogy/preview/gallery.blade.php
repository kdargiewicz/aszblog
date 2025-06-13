@extends('web.template.blogy.main')
@section('content')

    <div class="container py-5">
        <h3 class="gallery-title">Galeria</h3>

{{--        ignoruj images, phpstorm sobie z tym nie radzi--}}
        @php
            $shuffledImages = $images;
            shuffle($shuffledImages);
        @endphp


        <div class="gallery-grid">
            @foreach($shuffledImages as $image)
                <div class="gallery-item">
                    <img src="{{ asset($image['url']) }}"
                         alt="Obrazek"
                         loading="lazy"
                         onclick="openModal('{{ asset($image['url']) }}', '{{ route('article.preview', $image['article_id']) }}')">
                </div>
            @endforeach
        </div>
    </div>


    {{--    <div class="container py-5">--}}
{{--        <h3 class="gallery-title">Galeria</h3>--}}
{{--        <div class="gallery-grid">--}}
{{--            @foreach($images as $image)--}}
{{--                <div class="gallery-item">--}}
{{--                    --}}{{--                <img src="{{ asset($image['url']) }}" alt="Obrazek" loading="lazy" onclick="openModal('{{ asset($image['url']) }}', '{{ route('article.show', $image['article_id']) }}')">--}}
{{--                    <img src="{{ asset($image['url']) }}" alt="Obrazek" loading="lazy" onclick="openModal('{{ asset($image['url']) }}', '{{ route('article.preview', $image['article_id']) }}')">--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}



    <!-- Modal -->
    <div id="imageModal" class="modal">
{{--        <span class="close" onclick="closeModal()">&times;</span>--}}
        <img class="modal-content" id="modalImage">
        <div id="caption">
            <a href="#" id="articleLink" target="_blank" class="button-link">Zobacz powiązany artykuł</a>
        </div>

    </div>

    <script>

        function openModal(imageSrc, articleUrl) {
            const modal = document.getElementById("imageModal");
            const modalImg = document.getElementById("modalImage");
            const articleLink = document.getElementById("articleLink");

            modal.style.display = "block";
            modalImg.src = imageSrc;
            articleLink.href = articleUrl;
        }

        // zamykanie przez kliknięcie w tło
        document.getElementById("imageModal").addEventListener("click", function (event) {
            // jeśli kliknięto w sam modal (czyli tło), a nie np. obrazek lub przycisk – zamknij
            if (event.target.id === "imageModal") {
                closeModal();
            }
        });

        function closeModal() {
            document.getElementById("imageModal").style.display = "none";
        }


        // function openModal(imageSrc, articleUrl) {
        //     const modal = document.getElementById("imageModal");
        //     const modalImg = document.getElementById("modalImage");
        //     const articleLink = document.getElementById("articleLink");
        //
        //     modal.style.display = "block";
        //     modalImg.src = imageSrc;
        //     articleLink.href = articleUrl;
        // }
        //
        // function closeModal() {
        //     document.getElementById("imageModal").style.display = "none";
        // }

        // function openModal(imageSrc, articleUrl) {
        //     const modal = document.getElementById("imageModal");
        //     const modalImg = document.getElementById("modalImage");
        //     const articleLink = document.getElementById("articleLink");
        //
        //     modal.style.display = "block";
        //     modalImg.src = imageSrc;
        //     articleLink.href = articleUrl;
        // }
        //
        // function closeModal() {
        //     document.getElementById("imageModal").style.display = "none";
        // }

    </script>

@endsection
