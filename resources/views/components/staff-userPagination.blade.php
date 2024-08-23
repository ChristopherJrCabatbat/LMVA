<nav aria-label="Pagination">
    <ul class="pagination justify-content-end mb-1">
        {{-- Previous Page Link --}}
        @if ($items->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link custom-pagination-link" href="{{ $items->previousPageUrl() }}">Previous</a>
            </li>
        @endif

        {{-- Pagination Links --}}
        @foreach ($items->links()->elements[0] as $page => $url)
            <li class="page-item {{ $page == $items->currentPage() ? 'active custom-active' : '' }}">
                <a class="page-link custom-pagination-link" href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach

        {{-- Next Page Link --}}
        @if ($items->hasMorePages())
            <li class="page-item">
                <a class="page-link custom-pagination-link" href="{{ $items->nextPageUrl() }}">Next</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Next</span>
            </li>
        @endif
    </ul>
</nav>