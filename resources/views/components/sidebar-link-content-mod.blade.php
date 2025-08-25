@props([
    'badgeText' => 0
])

@php
    $isCurrentRoute = empty($param) ? request()->routeIs($route) : (request()->routeIs($route) && request()->route()->parameters['type'] == $param);
@endphp
    <!-- Leave this to fool Tailwind compilation, otherwise it will delete dynamic styles. There is a better fix! -->
<!-- Potential dynamic classes: text-crew-400 text-participant-400 text-partner-400 stroke-crew-400 stroke-participant-400 stroke-partner-400 -->
<!-- dark:text-crew dark:text-participant dark:text-partner hover:text-crew hover:text-participant hover:text-partner dark:hover:text-crew dark:hover:text-participant dark:hover:text-partner-->


<li class="my-1">
    <a href="{{ empty($param) ? route($route) : route($route, $param) }}" wire:navigate.hover
       class="relative flex items-center gap-2 sm:gap-3 px-2 sm:px-3 py-2 rounded-lg transition-all font-medium text-sm group
       {{ $isCurrentRoute ? 'bg-waitt-pink-600 text-white shadow-md' : 'text-waitt-pink-400 hover:bg-waitt-pink-500 hover:text-white active:bg-waitt-pink-700' }}">
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" aria-hidden="true"
                 class="w-4 h-4 sm:w-5 sm:h-5 {{ $isCurrentRoute ? 'stroke-white' : 'stroke-current' }}">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}" />
                @if($label == 'Edit profile')
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                @endif
                @if($label == 'Rooms')
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                @endif
                @if($label == 'Scan tickets')
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                @endif
            </svg>
            @if($badgeText != 0)
                <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full shadow">{{ $badgeText }}</span>
            @endif
        </div>
        <span class="hidden md:block">{{$label}}</span>
    </a>
</li>
