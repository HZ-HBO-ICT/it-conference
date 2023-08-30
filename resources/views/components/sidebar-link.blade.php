@php
    $isCurrentRoute = empty($param) ? request()->routeIs($route) : (request()->routeIs($route) && request()->route()->parameters['type'] == $param);
    $bgColorClass = $isCurrentRoute ? 'bg-gray-200 dark:bg-gray-700' : '';
@endphp

<li>
    <a href="{{ empty($param) ? route($route) : route($route, $param) }}"
       class="flex items-center p-2 text-gray-800 rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $bgColorClass }}">
        <span class="ml-3">{{ $label }}</span>
    </a>
</li>
