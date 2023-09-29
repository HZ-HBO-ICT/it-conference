@props([
    'badgeText' => 0
])

@php
    $isCurrentRoute = empty($param) ? request()->routeIs($route) : (request()->routeIs($route) && request()->route()->parameters['type'] == $param);
    $bgColorClass = $isCurrentRoute ? 'bg-gray-100 text-' . $roleColour . '-400 dark:bg-gray-700 dark:text-' . $roleColour . '-400' : '';
@endphp
<!-- Leave this to fool Tailwind compilation, otherwise it will delete dynamic styles. There is a better fix! -->
<!-- Potential dynamic classes: text-crew-400 text-participant-400 text-partner-400 stroke-crew-400 stroke-participant-400 stroke-partner-400 -->
<!-- dark:text-crew dark:text-participant dark:text-partner hover:text-crew hover:text-participant hover:text-partner dark:hover:text-crew dark:hover:text-participant dark:hover:text-partner-->


<li class="m-1">
        <a href="{{ empty($param) ? route($route) : route($route, $param) }}"
       class="relative leading-6 font-semibold text-sm p-2 rounded-md gap-x-3 flex hover:bg-gray-200 dark:hover:bg-gray-600 hover:text-{{ $roleColour }}-400 dark:hover:text-{{ $roleColour }}-400 dark:text-white {{ $bgColorClass }}">
            @if($badgeText != 0)
                <div
                    class="absolute bottom-auto left-0 right-auto top-0 z-10 inline-block -translate-y-1/2 -translate-x-2/4 rotate-0 skew-x-0 skew-y-0 scale-x-100 scale-y-100 whitespace-nowrap rounded-full bg-red-600 px-2.5 py-1 text-center align-baseline text-xs font-bold leading-none text-white">
                    {{ $badgeText }}
                </div>
            @endif
       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" aria-hidden="true" class="w-6 h-6 stroke-{{ $roleColour }}-400">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="{{ $icon }}">
        </path>
        @if($label == 'Edit profile')
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        @endif
        </svg>

       <span>
           {{$label}}
        </span>
</span>
    </a>
</li>
