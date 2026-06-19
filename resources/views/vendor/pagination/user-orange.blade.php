@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">

        {{-- Mobile --}}
        <div class="flex gap-2 items-center justify-between sm:hidden">

            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-orange-300 bg-white border border-orange-200 cursor-not-allowed leading-5 rounded-md">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-orange-600 bg-white border border-orange-200 rounded-md hover:bg-orange-50 hover:text-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-orange-600 bg-white border border-orange-200 rounded-md hover:bg-orange-50 hover:text-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-orange-300 bg-white border border-orange-200 cursor-not-allowed leading-5 rounded-md">
                    {!! __('pagination.next') !!}
                </span>
            @endif

        </div>

        {{-- Desktop --}}
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">

            <div>
                <p class="text-sm text-orange-600 leading-5">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="inline-flex shadow-sm rounded-md">

                    {{-- Previous --}}
                    @if ($paginator->onFirstPage())
                        <span class="inline-flex items-center px-2 py-2 text-orange-300 bg-white border border-orange-200 rounded-l-md cursor-not-allowed">
                            ‹
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}"
                           class="inline-flex items-center px-2 py-2 text-orange-600 bg-white border border-orange-200 rounded-l-md hover:bg-orange-50 hover:text-orange-700 focus:ring-2 focus:ring-orange-500">
                            ‹
                        </a>
                    @endif

                    {{-- Pages --}}
                    @foreach ($elements as $element)

                        @if (is_string($element))
                            <span class="px-4 py-2 text-orange-400 bg-white border border-orange-200">
                                {{ $element }}
                            </span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)

                                @if ($page == $paginator->currentPage())
                                    <span class="px-4 py-2 text-white bg-orange-600 border border-orange-600 font-semibold">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                       class="px-4 py-2 text-orange-600 bg-white border border-orange-200 hover:bg-orange-50 hover:text-orange-700">
                                        {{ $page }}
                                    </a>
                                @endif

                            @endforeach
                        @endif

                    @endforeach

                    {{-- Next --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}"
                           class="inline-flex items-center px-2 py-2 text-orange-600 bg-white border border-orange-200 rounded-r-md hover:bg-orange-50 hover:text-orange-700 focus:ring-2 focus:ring-orange-500">
                            ›
                        </a>
                    @else
                        <span class="inline-flex items-center px-2 py-2 text-orange-300 bg-white border border-orange-200 rounded-r-md cursor-not-allowed">
                            ›
                        </span>
                    @endif

                </span>
            </div>

        </div>

    </nav>
@endif