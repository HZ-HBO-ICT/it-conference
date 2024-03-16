<div class="mx-20 my-10 p-8 rounded-md bg-white dark:bg-slate-700">
    <div class="px-4 sm:px-0">
        <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">{{ $title }}</h3>
    </div>
    <div class="mt-6 border-t border-gray-100">
        <dl class="divide-y divide-gray-100 dark:divide-gray-800">
            {{ $slot }}
        </dl>
    </div>
</div>
