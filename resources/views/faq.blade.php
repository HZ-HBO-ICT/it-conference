<x-app-layout>
    <div class="relative bg-conference-dark overflow-hidden min-h-screen px-4 py-12 flex flex-col items-center">
        <h1 class="text-8xl font-bold text-left mb-20" style="color: #E2FF32; text-shadow: 0 0 30px rgba(226, 255, 50, 0.9), 0 0 50px rgba(226, 255, 50, 0.7), 0 0 70px rgba(226, 255, 50, 0.5);">FAQ</h1>
        <div class="w-full max-w-5xl mb-10">
            <p class="text-lg text-white mb-6">Find answers to common questions about the "We are in IT Together" Conference. If you can't find what you're looking for, please <a href="{{ route('contact') }}" class="text-[#7B61FF] font-bold underline hover:text-[#a18aff]">contact us here</a>.</p>
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
