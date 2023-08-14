<li>
    <a href="@if(empty($param)){{route($route)}}@else{{route($route, $param)}}@endif"
       class="flex items-center p-2 text-gray-800 rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 group
       @if(request()->routeIs($route)) bg-gray-200 dark:bg-gray-700 @endif">
        <span class="ml-3">{{$label}}</span>
    </a>
</li>
