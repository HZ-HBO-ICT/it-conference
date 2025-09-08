<div {{ $attributes->merge(['class' => '']) }}>
    @if (isset($actions))
        <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
            {{ $actions }}
        </div>
    @endif
    <div class="mt-5 md:mt-0">
        <div class="mt-5 bg-waitt-dark/30 backdrop-blur-md shadow-sm sm:rounded-md">
            <ul role="list">
                {{ $content }}
            </ul>
        </div>
    </div>
</div>
