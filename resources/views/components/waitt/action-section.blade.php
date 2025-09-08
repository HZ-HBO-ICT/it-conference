<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-waitt.section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-waitt.section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        @if(isset($content))
            <div class="bg-waitt-dark/70 backdrop-blur-sm p-8 border border-slate-900 {{ isset($actions) ? 'sm:rounded-tl-2xl sm:rounded-tr-2xl' : 'sm:rounded-2xl' }}">
                {{ $content }}
            </div>
        @endif

        @if (isset($actions))
                <div class="flex items-center justify-end px-4 py-3 bg-waitt-dark border-l border-r border-b border-slate-900 backdrop-blur-sm text-right sm:px-6 shadow-sm sm:rounded-bl-md sm:rounded-br-md">
                {{ $actions }}
            </div>
        @endif
    </div>
</div>
