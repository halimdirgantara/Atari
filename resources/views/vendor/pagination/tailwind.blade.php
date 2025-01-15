@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gradient-to-r from-gray-800 to-gray-700 border-2 border-gray-600 cursor-default leading-5 rounded-lg shadow-lg transform transition-all duration-300 dark:from-gray-700 dark:to-gray-600">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-500 border-2 border-blue-400 leading-5 rounded-lg shadow-lg hover:shadow-xl hover:scale-105 focus:outline-none focus:ring-2 ring-blue-400 focus:border-blue-500 active:from-blue-700 active:to-blue-600 transform transition-all duration-300 dark:from-blue-500 dark:to-blue-400">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-500 border-2 border-blue-400 leading-5 rounded-lg shadow-lg hover:shadow-xl hover:scale-105 focus:outline-none focus:ring-2 ring-blue-400 focus:border-blue-500 active:from-blue-700 active:to-blue-600 transform transition-all duration-300 dark:from-blue-500 dark:to-blue-400">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-400 bg-gradient-to-r from-gray-800 to-gray-700 border-2 border-gray-600 cursor-default leading-5 rounded-lg shadow-lg transform transition-all duration-300 dark:from-gray-700 dark:to-gray-600">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 leading-5 dark:text-gray-300">
                    <span class="font-semibold">{!! __('Showing') !!}</span>
                    @if ($paginator->firstItem())
                        <span class="font-bold text-blue-600 dark:text-blue-400">{{ $paginator->firstItem() }}</span>
                        <span class="font-semibold">{!! __('to') !!}</span>
                        <span class="font-bold text-blue-600 dark:text-blue-400">{{ $paginator->lastItem() }}</span>
                    @else
                        <span class="font-bold text-blue-600 dark:text-blue-400">{{ $paginator->count() }}</span>
                    @endif
                    <span class="font-semibold">{!! __('of') !!}</span>
                    <span class="font-bold text-blue-600 dark:text-blue-400">{{ $paginator->total() }}</span>
                    <span class="font-semibold">{!! __('results') !!}</span>
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-lg rounded-lg overflow-hidden">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gradient-to-r from-gray-800 to-gray-700 border-r border-gray-600 cursor-default leading-5 transition-colors duration-300 dark:from-gray-700 dark:to-gray-600" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-500 border-r border-blue-400 leading-5 hover:from-blue-700 hover:to-blue-600 focus:z-10 focus:outline-none focus:ring-2 ring-blue-400 focus:border-blue-500 active:bg-blue-700 transition-all duration-300 dark:from-blue-500 dark:to-blue-400" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-400 bg-gradient-to-r from-gray-800 to-gray-700 border-x border-gray-600 cursor-default leading-5 transition-colors duration-300 dark:from-gray-700 dark:to-gray-600">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-gradient-to-r from-blue-700 to-blue-600 border-x border-blue-400 cursor-default leading-5 transition-colors duration-300 dark:from-blue-600 dark:to-blue-500">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-200 bg-gradient-to-r from-gray-800 to-gray-700 border-x border-gray-600 leading-5 hover:from-blue-600 hover:to-blue-500 hover:text-white focus:z-10 focus:outline-none focus:ring-2 ring-blue-400 active:from-blue-700 active:to-blue-600 transition-all duration-300 dark:from-gray-700 dark:to-gray-600" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-500 border-l border-blue-400 leading-5 hover:from-blue-700 hover:to-blue-600 focus:z-10 focus:outline-none focus:ring-2 ring-blue-400 focus:border-blue-500 active:bg-blue-700 transition-all duration-300 dark:from-blue-500 dark:to-blue-400" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-gray-400 bg-gradient-to-r from-gray-800 to-gray-700 border-l border-gray-600 cursor-default leading-5 transition-colors duration-300 dark:from-gray-700 dark:to-gray-600" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
