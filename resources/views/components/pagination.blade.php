@if ($paginator->hasPages())
    <nav class="flex justify-center -space-x-px rounded-md" role="navigation" aria-label="Pagination">
{{--         Previous Page Link --}}
        <a class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 {{ $paginator->onFirstPage() ? 'opacity-50 cursor-not-allowed' : ''}}"
            href="{{ $paginator->previousPageUrl() }}">
            <span class="sr-only">@lang('pagination.previous')</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
            </svg>
        </a>

{{--         Pagination Elements --}}
            @foreach ($elements as $element)
{{--                 "Three Dots" Separator--}}
                @if (is_string($element))
                    <li>
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">{{ $element }}</span>
                    </li>
                @endif

{{--                 Array Of Links--}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <a href="{{ $url }}" aria-label="Goto page {{ $page }}"
                           class="{{ $page == $paginator->currentPage() ? 'relative z-10 inline-flex items-center bg-crew-400 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-crew-700' : 'relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0' }} ">
                            {{ $page }}
                        </a>
                    @endforeach
                @endif
            @endforeach

{{--         Next Page Link --}}
        <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
            <span class="sr-only">@lang('pagination.next')</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
            </svg>
        </a>
    </nav>
@endif
