@php
    $isCurrentRoute = empty($param) ? request()->routeIs($route) : (request()->routeIs($route) && request()->route()->parameters['type'] == $param);
    $bgColorClass = $isCurrentRoute ? 'bg-gray-200 text-blue-400 dark:bg-gray-700' : '';
@endphp

<li class="m-1">
    <a href="{{ empty($param) ? route($route) : route($route, $param) }}"
       class="leading-6 font-semibold text-sm p-2 rounded-md gap-x-3 flex hover:bg-gray-100 hover:text-blue-400 {{ $bgColorClass }}">
       <span>{{$label}}</span>
    </a>
</li>
