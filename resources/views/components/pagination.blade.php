@if ($paginator->hasPages())
    <nav class="pagination flex justify-center" role="navigation" aria-label="pagination">
        {{-- Previous Page Link --}}
        <a class="pagination-previous mr-2 {{ $paginator->onFirstPage() ? 'opacity-50 cursor-not-allowed' : 'bg-white dark:bg-gray-700 text-indigo-700 dark:text-gray-200 hover:text-gray-500 hover:bg-gray-100 dark:hover:text-gray-200 dark:hover:bg-gray-900' }} px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 text-gray-700"
           href="{{ $paginator->previousPageUrl() }}">
            @lang('pagination.previous')
        </a>

        {{-- Pagination Elements --}}
        <ul class="pagination-list flex space-x-2 mt-2">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li>
                        <span class="pagination-ellipsis">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li>
                            <a class="pagination-link py-2.5 {{ $page == $paginator->currentPage() ? 'bg-violet-500 dark:bg-violet-500 text-white' : 'bg-white dark:bg-gray-700 text-indigo-700 dark:text-gray-200 hover:text-gray-500 hover:bg-gray-100 dark:hover:text-gray-200 dark:hover:bg-gray-900' }} px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 text-gray-700"
                               href="{{ $url }}" aria-label="Goto page {{ $page }}">{{ $page }}</a>
                        </li>
                    @endforeach
                @endif
            @endforeach
        </ul>

        {{-- Next Page Link --}}
        <a class="pagination-next ml-2 {{ $paginator->hasMorePages() ? 'bg-white dark:bg-gray-700 text-indigo-700 dark:text-gray-200 hover:text-gray-500 hover:bg-gray-100 dark:hover:text-gray-200 dark:hover:bg-gray-900' : 'opacity-50 cursor-not-allowed'  }} px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 text-gray-700"
           href="{{ $paginator->nextPageUrl() }}">
            @lang('pagination.next')
        </a>

    </nav>
@endif
