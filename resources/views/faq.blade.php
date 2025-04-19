<x-app-layout>
    <div class="min-h-screen bg-[#0B1221] relative overflow-hidden">
        <!-- Background gradient effects -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 left-0 w-1/3 h-1/3 bg-gradient-to-br from-blue-400/20 to-transparent rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute top-0 right-0 w-1/3 h-1/3 bg-gradient-to-bl from-purple-400/20 to-transparent rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 left-1/2 w-1/2 h-1/2 bg-gradient-to-t from-blue-500/20 to-transparent rounded-full blur-3xl transform -translate-x-1/2"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 py-24">
            <!-- Title -->
            <h1 class="text-[#E2FF32] text-7xl font-bold mb-8 text-center">FAQ</h1>

            <!-- Description -->
            <p class="text-white text-xl text-center mb-16 max-w-4xl mx-auto">
                Find answers to common questions about the We Are In IT Together Conference. If you can't find what you're looking for, please contact us at <a href="mailto:info@waitt.com" class="text-[#9333EA] hover:text-[#A855F7]">info@waitt.com</a>.
            </p>

            <!-- FAQ Sections -->
            <div class="space-y-12">
                <!-- Registration & Tickets Section -->
                <div class="bg-[#0B1221]/40 backdrop-blur-sm rounded-2xl overflow-hidden border border-white/10 p-8">
                    <h2 class="text-white text-3xl font-bold mb-6">Registration & Tickets</h2>
                    
                    @foreach(\App\Models\FrequentQuestion::where('category', 'registration')->get() as $faq)
                    <div x-data="{ open: false }" class="border-b border-white/10 last:border-0">
                        <button @click="open = !open" class="w-full py-6 flex items-center justify-between text-left">
                            <span class="text-white text-lg">{{ $faq->question }}</span>
                            <svg class="w-6 h-6 text-white transform transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-collapse class="pb-6">
                            <div class="text-gray-300 prose prose-invert max-w-none">
                                <x-markdown-viewer :content="$faq->answer" />
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Programme & Content Section -->
                <div class="bg-[#0B1221]/40 backdrop-blur-sm rounded-2xl overflow-hidden border border-white/10 p-8">
                    <h2 class="text-white text-3xl font-bold mb-6">Programme & Content</h2>
                    
                    @foreach(\App\Models\FrequentQuestion::where('category', 'programme')->get() as $faq)
                    <div x-data="{ open: false }" class="border-b border-white/10 last:border-0">
                        <button @click="open = !open" class="w-full py-6 flex items-center justify-between text-left">
                            <span class="text-white text-lg">{{ $faq->question }}</span>
                            <svg class="w-6 h-6 text-white transform transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-collapse class="pb-6">
                            <div class="text-gray-300 prose prose-invert max-w-none">
                                <x-markdown-viewer :content="$faq->answer" />
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Contact Section -->
            <div class="mt-24 text-center">
                <h2 class="text-white text-3xl font-bold mb-4">Still have questions?</h2>
                <p class="text-gray-300 mb-8">Contact our support team and we'll get back to you as soon as possible.</p>
                <a href="{{ route('contact') }}" class="inline-block px-8 py-4 bg-[#9333EA] text-white rounded-lg text-lg font-semibold hover:bg-[#A855F7] transition-colors">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
