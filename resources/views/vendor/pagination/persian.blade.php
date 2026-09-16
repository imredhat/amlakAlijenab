@if ($paginator->hasPages())
    <nav class="border-top pb-md-4 pt-4 mt-2" aria-label="Pagination">
        <ul class="pagination mb-1">
            {{-- Mobile: prev + page X of Y + next --}}
            <li class="page-item d-sm-none {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                @if ($paginator->onFirstPage())
                    <span class="page-link"><i class="fi-chevron-right"></i></span>
                @else
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="fi-chevron-right"></i></a>
                @endif
            </li>
            <li class="page-item d-sm-none">
                <span class="page-link page-link-static">{{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}</span>
            </li>
            <li class="page-item d-sm-none {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                @if ($paginator->hasMorePages())
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="fi-chevron-left"></i></a>
                @else
                    <span class="page-link"><i class="fi-chevron-left"></i></span>
                @endif
            </li>

            {{-- Desktop: prev --}}
            <li class="page-item d-none d-sm-block {{ $paginator->onFirstPage() ? 'disabled' : '' }}" aria-disabled="{{ $paginator->onFirstPage() ? 'true' : 'false' }}">
                @if ($paginator->onFirstPage())
                    <span class="page-link"><i class="fi-chevron-right"></i></span>
                @else
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fi-chevron-right"></i></a>
                @endif
            </li>

            {{-- Desktop: page numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled d-none d-sm-block" aria-disabled="true">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active d-none d-sm-block" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item d-none d-sm-block">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Desktop: next --}}
            <li class="page-item d-none d-sm-block {{ $paginator->hasMorePages() ? '' : 'disabled' }}" aria-disabled="{{ $paginator->hasMorePages() ? 'false' : 'true' }}">
                @if ($paginator->hasMorePages())
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fi-chevron-left"></i></a>
                @else
                    <span class="page-link"><i class="fi-chevron-left"></i></span>
                @endif
            </li>
        </ul>
    </nav>
@endif
