<div {{ $attributes->merge(['class' => '']) }}>
    @if (isset($actions))
        <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
            {{ $actions }}
        </div>
    @endif
    <div class="mt-5 md:mt-0">
        <div class="px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-md">
            <ul role="list">
                {{ $content }}
            </ul>
        </div>
    </div>
</div>
