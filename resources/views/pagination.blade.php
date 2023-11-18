<div class="col-md-12">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            @if ($bookData->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $bookData->previousPageUrl() }}" rel="prev">&laquo;</a>
                </li>
            @endif

            @foreach ($bookData->getUrlRange(1, $bookData->lastPage()) as $page => $url)
                <li class="page-item {{ ($page == $bookData->currentPage()) ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            @if ($bookData->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $bookData->nextPageUrl() }}" rel="next">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
</div>