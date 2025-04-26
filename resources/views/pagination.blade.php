@if ($errors->hasPages())
    <div class="w3-bar w3-center w3-margin-top">
        @if ($errors->onFirstPage())
            <span class="w3-button w3-disabled">&laquo;</span>
        @else
            <a href="{{ $errors->previousPageUrl() }}" class="w3-button">&laquo;</a>
        @endif

        @foreach ($errors->getUrlRange(1, $errors->lastPage()) as $page => $url)
            @if ($page == $errors->currentPage())
                <span class="w3-button w3-blue">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="w3-button">{{ $page }}</a>
            @endif
        @endforeach

        @if ($errors->hasMorePages())
            <a href="{{ $errors->nextPageUrl() }}" class="w3-button">&raquo;</a>
        @else
            <span class="w3-button w3-disabled">&raquo;</span>
        @endif
    </div>
@endif
