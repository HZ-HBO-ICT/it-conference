<x-app-layout>
    <div class="relative bg-conference-dark overflow-hidden min-h-screen px-4 py-12 flex flex-col items-center">
        <!-- Decorative Blobs -->
        <div class="absolute inset-0 pointer-events-none z-0">
            <div class="absolute top-10 left-10 w-40 h-40 rounded-full bg-accent-cyan opacity-30 blur-2xl"></div>
            <div class="absolute bottom-20 right-20 w-56 h-56 rounded-full bg-accent-yellow opacity-20 blur-2xl"></div>
            <div class="absolute top-1/2 left-1/2 w-32 h-32 rounded-full bg-accent-pink opacity-25 blur-2xl"></div>
            <div class="absolute top-24 right-32 w-32 h-32 rounded-full bg-accent-cyan opacity-15 blur-2xl"></div>
            <div class="absolute bottom-32 left-1/4 w-28 h-28 rounded-full bg-accent-yellow opacity-15 blur-2xl"></div>
            <div class="absolute top-3/4 left-3/4 w-36 h-36 rounded-full bg-accent-pink opacity-10 blur-2xl"></div>
        </div>
        <h1 class="text-6xl font-extrabold text-center mb-4 uppercase"
            style="color: #ffe600; text-shadow: 0 0 2px #ffe600, 0 0 4px #ffe600; letter-spacing: 2px;">
            FAQ
        </h1>
        <div class="w-full max-w-5xl mb-10">
            <p class="text-lg text-white mb-6">Find answers to common questions about the "We are in IT Together" Conference. If you can't find what you're looking for, please <a href="{{ route('contact') }}" class="text-accent-purple font-bold underline hover:text-accent-purple-hover">contact us here</a>.</p>
        </div>
        <div class="w-full max-w-5xl flex flex-col gap-8">
            @foreach($faqs as $faq)
                <div class="rounded-xl border border-gray-400 bg-[#0F172A] p-0 overflow-hidden">
                    <details class="group">
                        <summary class="px-8 py-4 cursor-pointer text-lg font-semibold text-white group-open:text-[#FFFF3C] transition-colors">{{ $faq->question }}</summary>
                        <div class="px-8 py-4 prose prose-invert">{!! Str::markdown($faq->answer) !!}</div>
                    </details>
                </div>
            @endforeach
        </div>
        <!-- Still have questions section -->
        <div class="w-full max-w-5xl flex flex-col items-start mt-16">
            <h3 class="text-2xl font-extrabold text-white mb-2">Still have questions?</h3>
            <p class="text-white mb-6">Contact our support team and we'll get back to you as soon as possible.</p>
            <a href="{{ route('contact') }}" class="bg-[#7B61FF] hover:bg-[#a18aff] text-white font-bold py-3 px-8 rounded-full text-lg transition-colors">Contact Us</a>
        </div>
    </div>
</x-app-layout>
