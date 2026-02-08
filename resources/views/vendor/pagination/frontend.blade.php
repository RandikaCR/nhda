@if ($paginator->hasPages())
    <div class="my-5 d-flex justify-content-center">
        <div class="th-pagination ">
            <ul>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li><a href="javascript:void(0);" aria-disabled="true" aria-label="@lang('pagination.previous')"><i class="far fa-arrow-left"></i></a></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-disabled="true" aria-label="@lang('pagination.previous')"><i class="far fa-arrow-left"></i></a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><a href="javascript:void(0);">{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page"><a class="active" href="javascript:void(0);">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="far fa-arrow-right"></i></a></li>
            @else
               <li><a href="javascript:void(0);" aria-disabled="true" aria-label="@lang('pagination.next')"><i class="far fa-arrow-right"></i></a></li>
            @endif
            </ul>
        </div>
    </div>
@endif

