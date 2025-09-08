@props([
    'badgeText' => 0
])

@php
    $isCurrentRoute = empty($param) ? request()->routeIs($route) : (request()->routeIs($route) && request()->route()->parameters['type'] == $param);
    $bgColorClass = $isCurrentRoute ? 'bg-slate-600/10 text-waitt-pink stroke-waitt-pink' : 'text-gray-100 hover:text-waitt-pink stroke-waitt-yellow hover:stroke-waitt-pink';
@endphp
    <!-- Leave this to fool Tailwind compilation, otherwise it will delete dynamic styles. There is a better fix! -->
<!-- Potential dynamic classes: text-crew-400 text-participant-400 text-partner-400 stroke-crew-400 stroke-participant-400 stroke-partner-400 -->
<!-- dark:text-crew dark:text-participant dark:text-partner hover:text-crew hover:text-participant hover:text-partner dark:hover:text-crew dark:hover:text-participant dark:hover:text-partner-->


<li class="m-1">
    <a href="{{ empty($param) ? route($route) : route($route, $param) }}" wire:navigate.hover
       class="relative leading-6 font-semibold text-sm p-2 rounded-md gap-x-3 flex dark:text-white {{ $bgColorClass }}">
        @if($badgeText != 0)
            <div
                class="absolute bottom-auto left-0 right-auto top-0 z-10 inline-block -translate-y-1/2 -translate-x-2/4 rotate-0 skew-x-0 skew-y-0 scale-x-100 scale-y-100 whitespace-nowrap rounded-full bg-red-600 px-2.5 py-1 text-center align-baseline text-xs font-bold leading-none text-white">
                {{ $badgeText }}
            </div>
        @endif
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" aria-hidden="true"
             class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="{{ $icon }}">
            </path>
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

        <span class="hidden lg:block">
           {{$label}}
        </span>
    </a>
</li>
