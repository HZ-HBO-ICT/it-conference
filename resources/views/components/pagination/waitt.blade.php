@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
    <div class="flex justify-end items-center space-x-2 py-4 text-white">
        {{-- Previous Page --}}
        @if ($paginator->onFirstPage())
            <span class="px-2 py-1 rounded bg-white/10 border border-white/20 text-sm text-gray-400 cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
        @else
            <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
               class="px-2 py-1 rounded bg-white/10 border border-white/20 text-sm hover:cursor-pointer hover:bg-white/20 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
        @endif

        {{-- Current Page --}}
        <span class="px-3 text-sm tracking-widest opacity-60">
            {{ $paginator->currentPage() }}
        </span>

        {{-- Next Page --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
               class="px-2 py-1 rounded bg-white/10 border border-white/20 text-sm hover:cursor-pointer hover:bg-white/20 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        @else
            <span class="px-2 py-1 rounded bg-white/10 border border-white/20 text-sm text-gray-400 cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </span>
        @endif
    </div>
    </nav>
@endif
