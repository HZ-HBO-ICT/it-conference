<!-- Icons are used from https://heroicons.com/ -->
<div class="pt-5 pb-12 px-4 rounded-lg overflow-hidden relative bg-white shadow-md">
    <dt>
        <div class="p-3 rounded-md absolute bg-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" aria-hidden="true" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}" />
            </svg>                
        </div>
        <p class="ml-16 font-medium text-sm text-gray-500 overflow-hidden text-ellipsis whitespace-nowrap">
            {{ $label }}
        </p>
    </dt>
    <dd class="pb-6 items-baseline flex ml-16">
        <p class="text-gray-900 font-semibold text-2xl">
            {{ $count }}
        </p>
        <div class="py-4 px-4 bottom-0 inset-x-0 absolute bg-gray-50 border-t">
            <div class="text-sm text-blue-500 hover:text-blue-400">
                <a href="{{ $routeName }}">View all</a>
            </div>
        </div>
    </dd>
</div>