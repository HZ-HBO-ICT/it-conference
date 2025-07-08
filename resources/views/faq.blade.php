<x-app-layout>
    <div class="relative max-w-7xl mx-auto px-4 pt-14 pb-24">
       <!-- Decorative Blobs -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute top-32 left-10 w-40 h-40 rounded-full bg-waitt-cyan opacity-30 blur-2xl"></div>
            <div class="absolute top-20 right-20 w-56 h-56 rounded-full bg-waitt-yellow opacity-20 blur-2xl"></div>
            <div class="absolute top-1/2 left-1/2 w-32 h-32 rounded-full bg-waitt-pink opacity-35 blur-2xl"></div>
            <div class="absolute top-40 right-32 w-32 h-32 rounded-full bg-waitt-cyan opacity-15 blur-2xl"></div>
            <div class="absolute top-64 left-1/4 w-28 h-28 rounded-full bg-waitt-yellow opacity-15 blur-2xl"></div>
            <div class="absolute top-3/4 left-3/4 w-36 h-36 rounded-full bg-waitt-pink opacity-10 blur-2xl"></div>
        </div>
        <h1 class="text-6xl font-extrabold text-left mb-12 uppercase tracking-wide text-waitt-yellow max-sm:text-center">
            FAQ
        </h1>
        <div class="relative max-w-7xl mx-auto px-4">
            <p class="text-lg text-white mx-auto mb-7">Find answers to common questions about the "We are in IT Together" Conference. If you can't find what you're looking for, please <a href="{{ route('contact') }}" class="text-waitt-pink font-bold underline hover:text-pink-600">contact us here</a>.</p>
        </div>
        <div class="w-full flex flex-col gap-8">
            <div class="space-y-4 w-full" x-data="{ selected: null }">
                @foreach($faqs as $index => $faq)
                    <div class="rounded-xl overflow-hidden w-full bg-waitt-dark/70 backdrop-blur-sm border-slate-900 transition-colors hover:bg-waitt-dark/70">
                        <button
                            @click="selected !== {{ $index }} ? selected = {{ $index }} : selected = null"
                            class="hover:cursor-pointer flex items-center justify-between w-full px-6 py-4 text-left text-lg font-semibold hover:text-waitt-yellow transition-colors"
                            :class="selected === {{ $index }} ? 'text-waitt-yellow' : 'text-white '"
                        >
                            {{ $faq->question }}
                            <svg
                                class="w-5 h-5 transform transition-transform duration-300"
                                :class="selected === {{ $index }} ? 'rotate-180 text-waitt-yellow' : 'rotate-0 text-gray-400'"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div
                            x-show="selected === {{ $index }}"
                            x-collapse.duration.300ms
                            class="px-6 w-full border-t border-gray-700"
                        >
                            <div class="prose prose-invert text-gray-200 w-full max-w-none py-4 !mt-0">
                                {!! Str::markdown($faq->answer) !!}
                            </div>
                        </div>


                    </div>
                @endforeach
            </div>

        </div>
        <!-- Still have questions section -->
        <div class="w-full max-w-7xl mx-auto flex flex-col px-4 items-start mt-16">
            <h3 class="text-2xl font-extrabold text-white mb-2">Still have questions?</h3>
            <p class="text-white mb-6">Contact our support team and we'll get back to you as soon as possible.</p>
            <a href="{{ route('contact') }}" class="px-8 py-4 bg-waitt-pink transition-colors hover:bg-pink-600 text-primary-dark rounded-xl text-xl font-semibold hover:bg-opacity-90 transition-all">
                Contact Us
            </a>
        </div>
    </div>
</x-app-layout>
