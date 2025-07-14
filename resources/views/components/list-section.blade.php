<div {{ $attributes->merge(['class' => 'relative min-h-screen overflow-hidden bg-waitt-dark']) }}>
    <!-- Decorative Blobs Background -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-32 left-[-120px] w-96 h-96 bg-blue-500 opacity-25 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-1/3 right-[-100px] w-80 h-80 bg-yellow-300 opacity-20 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-32 left-1/3 w-72 h-72 bg-purple-500 opacity-30 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-10 right-40 w-80 h-80 bg-pink-400 opacity-20 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-green-400 opacity-25 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-1/2 left-1/5 w-64 h-64 bg-red-400 opacity-35 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-indigo-400 opacity-30 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-40 right-1/3 w-80 h-80 bg-teal-400 opacity-20 rounded-full blur-3xl z-0"></div>
    </div>
    <div class="relative z-10">
        @if (isset($actions))
            <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
                {{ $actions }}
            </div>
        @endif
        <div class="mt-5 md:mt-0">
            <div class="px-4 py-5 sm:p-6 bg-white/5 backdrop-blur-md shadow-sm sm:rounded-md">
                <ul role="list">
                    {{ $content }}
                </ul>
            </div>
        </div>
    </div>
</div>
