<div class="px-4 py-4 my-3 bg-waitt-dark/80 rounded-lg border border-slate-950 shadow-xs">
    <p class="text-gray-300 font-medium text-lg">
        {{$activity->description}}
    </p>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
        Logged at: {{$activity->created_at->format('M d, Y H:i:s')}}
    </p>
    <p class="text-sm text-blue-500 dark:text-blue-400 mt-2">
        @if($route != "#")
            <a href="{{ $route }}" class="hover:underline">
                View Details
            </a>
        @endif
    </p>
</div>
