@if ($paginator->hasPages())
    <ul class="pagination pagination-sm no-margin pull-right">
        @if($paginator -> lastPage() > 5 && $paginator -> currentPage() >= 4)
            <li><a href="{{ $paginator -> url(1) }}" rel="prev">首页</a></li>
        @endif
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif
        {{-- Pagination Elements --}}
        @if($paginator -> lastPage() > 5)
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @php($displayLastPage = min(($paginator -> currentPage() + 2), $paginator -> lastPage()))
                    @php($displayStartPage = min(($paginator -> currentPage() - 2), ($paginator -> lastPage() - 4)))
                    @if($paginator -> currentPage() >= 4)
                        {{-- "Three Dots" Separator --}}
                        <li><a href="{{ $paginator -> url($displayStartPage - 1) }}">...</a></li>
                        @for($i = $displayStartPage; $i <= $displayLastPage; $i++)
                            @if ($i == $paginator->currentPage())
                                <li class="active"><span>{{ $i }}</span></li>
                            @else
                                <li><a href="{{ $element[$i] }}">{{ $i }}</a></li>
                            @endif
                        @endfor
                    @else
                        @for($i = 1; $i <= 5; $i++)
                            @if ($i == $paginator->currentPage())
                                <li class="active"><span>{{ $i }}</span></li>
                            @else
                                <li><a href="{{ $element[$i] }}">{{ $i }}</a></li>
                            @endif
                        @endfor
                    @endif

                    @if($paginator -> lastPage() - $paginator -> currentPage() > 2)
                        {{-- "Three Dots" Separator --}}
                        <li><a href="{{ $paginator -> url(max(5, $displayLastPage) + 1) }}">...</a></li>
                    @endif
                    {{--@foreach ($element as $page => $url)--}}
                        {{--@if ($page == $paginator->currentPage())--}}
                            {{--<li class="active"><span>{{ $page }}</span></li>--}}
                        {{--@else--}}
                            {{--<li><a href="{{ $url }}">{{ $page }}</a></li>--}}
                        {{--@endif--}}
                    {{--@endforeach--}}
                @endif
            @endforeach
        @else
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        @endif
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
            @if($paginator -> lastPage() - $paginator -> currentPage() > 2 && $paginator -> lastPage() > 5)
                <li><a href="{{ $paginator -> url($paginator -> lastPage()) }}" rel="next">末页</a></li>
            @endif
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
@endif
