@if ($paginator->hasPages())
    <div class="pagination-row row">
        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}">
                <button class="pagination-btn pagination-nav-btn">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </a>
        @endif
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <button class="pagination-btn pagination-number-btn active active-page">{{ $page }}</button>
                    @else
                             <a href="{{ $url }}">
                                <button class="pagination-btn pagination-number-btn">{{ $page }}</button>
                             </a>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <button class="pagination-btn pagination-nav-btn">
                <i class="fas fa-chevron-right"></i>
            </button>
        @endif
    </div>
@endif
