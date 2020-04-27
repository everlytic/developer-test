@if ($paginator->hasPages())
    <div class="pagination text-align-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="disabled btn">@lang('pagination.previous')</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn-black btn text-white">@lang('pagination.previous')</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn-black btn text-white">@lang('pagination.next')</a>
        @else
            <span class="disabled btn">@lang('pagination.next')</span></li>
        @endif
    </ul>
@endif
