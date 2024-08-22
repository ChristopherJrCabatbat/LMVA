<nav aria-label="Derm Pagination">
    <ul class="pagination justify-content-end">
        {{-- Previous Page Link --}}
        @if ($derms->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link custom-pagination-link" href="{{ $derms->previousPageUrl() }}">Previous</a>
            </li>
        @endif

        {{-- Pagination Links --}}
        @foreach ($derms->links()->elements[0] as $page => $url)
            <li class="page-item {{ $page == $derms->currentPage() ? 'active custom-active' : '' }}">
                <a class="page-link custom-pagination-link" href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach

        {{-- Next Page Link --}}
        @if ($derms->hasMorePages())
            <li class="page-item">
                <a class="page-link custom-pagination-link" href="{{ $derms->nextPageUrl() }}">Next</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Next</span>
            </li>
        @endif
    </ul>
</nav>
