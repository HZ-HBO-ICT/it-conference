<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        @if(isset($content))
            <div class="px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow-sm {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                {{ $content }}
            </div>
        @endif

        @if (isset($actions))
            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800 text-right sm:px-6 shadow-sm {{isset($content) ? 'sm:rounded-bl-md sm:rounded-br-md' : 'sm:rounded-md sm:rounded-md'}}">
                {{ $actions }}
            </div>
        @endif
    </div>
</div>
