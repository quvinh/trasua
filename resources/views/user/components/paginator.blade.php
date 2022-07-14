@if ($paginator->hasPages())
<!-- Pagination -->
<nav aria-label="Page navigation example" class="d-flex justify-content-center">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled"><a href="#" aria-label="Previous" class="page-link"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
        @else
        <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" aria-label="Previous" class="page-link"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
        @endif
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item active"><a href="#" class="page-link">{{ $page }}</a></li>
        @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page ==
        $paginator->lastPage())
        <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
        @elseif ($page == $paginator->lastPage() - 1)
        <li class="page-item disabled"><span><i class="fa fa-ellipsis-h"></i></span></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" aria-label="Next" class="page-link"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
        @else
        <li class="page-item disabled"><a href="#" aria-label="Next" class="page-link"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
        @endif
    </ul>
</nav>
<!-- Pagination -->
@endif