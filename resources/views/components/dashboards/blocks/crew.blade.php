<!-- Icons are used from https://heroicons.com/ -->
<!-- Leave this to fool Tailwind compilation, otherwise it will delete dynamic styles. There is a better fix! -->
<!-- Potential dynamic classes: text-crew-500 text-participant-500 text-partner-500 stroke-crew stroke-participant stroke-partner bg-crew-500 bg-participant-500 bg-partner-500 -->
<!-- dark:text-crew-500 dark:text-participant-500 dark:text-partner-500 hover:text-crew-400 hover:text-participant-400 hover:text-partner-400 dark:hover:text-crew-300 dark:hover:text-participant-300 dark:hover:text-partner-300 -->

@props([
    'label',
    'count',
    'route',
    'icon',
    'roleColour',
    'styleMode' => 'default'
])

@php
    $styles = [
        'default' => [
            'bgColor' => 'bg-white',
            'textColor' => 'text-gray-900',
            'iconColor' => 'text-' . $roleColour . '-500',
            'viewAllBgColor' => 'bg-' . $roleColour . '-500',
            'viewAllTextColor' => 'text-white',
            'viewAllBgDark' => 'bg-' . $roleColour . '-500',
            'darkMode' => 'dark:bg-gray-800',
            'darkModeText' => 'dark:text-white'
        ],
        'alternate' => [
            'bgColor' => 'bg-' . $roleColour . '-500',
            'textColor' => 'text-white',
            'iconColor' => '',
            'viewAllBgColor' => 'bg-white',
            'viewAllTextColor' => 'text-' . $roleColour . '-500',
            'viewAllBgDark' => 'dark:bg-gray-800',
            'darkMode' => 'dark: bg-' . $roleColour . '-500',
            'darkModeText' => 'dark:white',
        ]
    ];

    $selectedStyle = $styles[$styleMode];
@endphp

<div class="{{ $selectedStyle['bgColor'] }} {{ $selectedStyle['darkMode'] }} rounded-lg overflow-hidden relative shadow-md">
    <dt class="flex flex-col-2 justify-between items-center pt-5 px-7 {{ $selectedStyle['textColor'] }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-16 h-16 {{ $selectedStyle['iconColor'] }}">
            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/>
        </svg>
        <p class="font-semibold text-2xl {{ $selectedStyle['iconColor'] }}">
            {{ $count }}
        </p>
    </dt>
    <dd class="mt-4 text-center text-sm font-medium overflow-hidden {{ $selectedStyle['textColor'] }} {{ $selectedStyle['darkModeText'] }}">
        {{ $label }}
    </dd>
    <dd class="{{ $selectedStyle['viewAllBgColor'] }} {{ $selectedStyle['viewAllTextColor'] }} {{ $selectedStyle['viewAllBgDark'] }} w-full py-4 rounded-b-lg mt-4 font-bold text-sm">
        <a href="{{ empty($param) ? route($route) : route($route, $param) }}" class="text-center block">
            View all
        </a>
    </dd>
</div>
