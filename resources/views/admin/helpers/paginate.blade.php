@if ($paginator->hasPages())
    <ul class="pagination pagination-flat align-self-center" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled previous_item" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">
                    {{-- ← &nbsp; Previous --}}
                    Trước
                </span>
            </li>
        @else
            <li class="page-item previous_item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    {{-- ← &nbsp; Previous --}}
                    Trước
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
        {{--{{dd($paginator)}}--}}
        {{--{{dd($elements)}}--}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 1) || $page == $paginator->lastPage())
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @elseif (($page == $paginator->currentPage() - 1 || $page == $paginator->currentPage() - 1) || $page == $paginator->lastPage())
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @elseif ($page == $paginator->lastPage() - 1)
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ '...' }}</span></li>
                    @elseif($page == 2 && $paginator->currentPage() >= 4)
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ '...' }}</span></li>
                    @elseif($page == 1 )
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item shadow-sm shadow-1 next_item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    {{-- Next &nbsp; → --}}
                    Sau
                </a>
            </li>
        @else
            <li class="page-item disabled next_item" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">
                    {{-- Next &nbsp; → --}}
                    Sau
                </span>
            </li>
        @endif
    </ul>
@endif

