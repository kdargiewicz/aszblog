@if ($paginator->hasPages())
    <div class="w3-bar w3-center w3-margin-top">
        @if ($paginator->onFirstPage())
            <span class="w3-button w3-disabled">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="w3-button">&laquo;</a>
        @endif

        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            @if ($page == $paginator->currentPage())
                <span class="w3-button w3-blue">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="w3-button">{{ $page }}</a>
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="w3-button">&raquo;</a>
        @else
            <span class="w3-button w3-disabled">&raquo;</span>
        @endif
    </div>
@endif

