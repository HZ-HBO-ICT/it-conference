<!-- Icons are used from https://heroicons.com/ -->
<!-- Leave this to fool Tailwind compilation, otherwise it will delete dynamic styles. There is a better fix! -->
<!-- Potential dynamic classes: text-crew-500 text-participant-500 text-partner-500 stroke-crew stroke-participant stroke-partner bg-crew-500 bg-participant-500 bg-partner-500 -->
<!-- dark:text-crew-500 dark:text-participant-500 dark:text-partner-500 hover:text-crew-400 hover:text-participant-400 hover:text-partner-400 dark:hover:text-crew-300 dark:hover:text-participant-300 dark:hover:text-partner-300 -->

<div class="pt-5 pb-12 px-4 rounded-lg overflow-hidden relative bg-white dark:bg-gray-800 shadow-md dark:shadow-md dark:">
    <dt>
        <div class="p-3 rounded-md absolute bg-{{ $roleColour }}-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" aria-hidden="true" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}" />
            </svg>
        </div>
        <p class="ml-16 font-medium text-sm text-gray-500 dark:text-gray-100 overflow-hidden text-ellipsis whitespace-nowrap">
            {{ $label }}
        </p>
    </dt>
    <dd class="pb-6 items-baseline flex ml-16">
        <p class="text-gray-900 font-semibold text-2xl dark:text-white">
            {{ $count }}
        </p>
        <div class="py-4 px-4 bottom-0 inset-x-0 absolute bg-gray-50 dark:bg-gray-700 border-t dark:border-t-gray-600">
            <div class="text-base font-semibold text-{{ $roleColour }}-500 hover:text-{{ $roleColour }}-400 dark:text-{{ $roleColour }}-500 dark:hover:text-{{ $roleColour }}-300">
                <a href="{{ empty($param) ? route($route) : route($route, $param) }}">View all</a>
            </div>
        </div>
    </dd>
</div>
