@php
    $isCurrentRoute = empty($param) ? request()->routeIs($route) : (
        request()->routeIs($route) &&
        (request()->route()->parameter('type') == $param || request()->route()->parameter('team') == $param)
    );

    $accentColor = \Illuminate\Support\Facades\Auth::user()->current_team_id ? 'purple' : 'orange';
    $bgColorClass = $isCurrentRoute ? "bg-gray-200 text-{$accentColor}-500 dark:bg-gray-700" : '';

@endphp

<li class="m-1">
    <a href="{{ empty($param) ? route($route) : route($route, $param) }}"
       class="leading-6 font-semibold text-sm p-2 rounded-md gap-x-3 flex hover:bg-gray-200 dark:hover:bg-gray-700 hover:text-{{$accentColor}}-500 dark:hover:text-{{$accentColor}}-500 dark:text-white {{ $bgColorClass }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" aria-hidden="true" class="w-6 h-6 stroke-purple-500">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="{{ $icon }}">
            </path>
            @if($label == 'Edit profile')
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            @endif
        </svg>
        <span>{{$label}}</span>
    </a>
</li>
