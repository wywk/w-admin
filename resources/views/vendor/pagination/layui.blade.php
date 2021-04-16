@if ($paginator->hasPages())
    <div class="page">
        <div>
            @if ($paginator->onFirstPage())
            @else
                <a class="prev" href="{{ $paginator->previousPageUrl() }}">&lt;&lt;</a>
            @endif

                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="current">{{ $page }}</span>
                            @else
                                <a class="num" href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @if ($paginator->hasMorePages())
                    <a class="next" href="{{ $paginator->nextPageUrl() }}">&gt;&gt;</a>
                @else
                @endif
        </div>
    </div>
@endif
