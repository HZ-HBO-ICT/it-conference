<x-app-layout>
    <div class="relative bg-[#070E1C] overflow-hidden min-h-screen px-4 py-12 flex flex-col items-center">
        <h1 class="font-extrabold text-yellow-400 mb-2 tracking-tight text-left w-full max-w-5xl" style="font-size:5rem; text-shadow: 0 0 13px #fff600;">FAQ</h1>
        <div class="w-full max-w-5xl mb-10">
            <p class="text-lg text-white mb-6">Find answers to common questions about the We Are In IT Together Conference. If you can't find what you're looking for, please <a href="{{ route('contact') }}" class="text-[#7B61FF] font-bold underline hover:text-[#a18aff]">contact us here</a>.</p>
        </div>
        <div class="w-full max-w-5xl flex flex-col gap-8">
            <!-- Registration & Tickets Section -->
            <div class="rounded-xl border border-gray-400 bg-[#0F172A] p-0 overflow-hidden">
                <div class="px-8 py-4 border-b border-gray-400">
                    <span class="text-2xl font-extrabold text-white">Registration & Tickets</span>
                </div>
                <div class="divide-y divide-gray-600">
                    <details class="group">
                        <summary class="px-8 py-4 cursor-pointer text-lg font-semibold text-white group-open:text-[#FFFF3C] transition-colors">How do I register for the conference?</summary>
                        <div class="px-8 py-4 text-gray-200">You can register online via our registration page. Follow the instructions to complete your registration.</div>
                    </details>
                    <details class="group">
                        <summary class="px-8 py-4 cursor-pointer text-lg font-semibold text-white group-open:text-[#FFFF3C] transition-colors">What is included?</summary>
                        <div class="px-8 py-4 text-gray-200">Your ticket includes access to all sessions, workshops, and networking events.</div>
                    </details>
                    <details class="group">
                        <summary class="px-8 py-4 cursor-pointer text-lg font-semibold text-white group-open:text-[#FFFF3C] transition-colors">Is it paid? Do I get a refund if I can't attend?</summary>
                        <div class="px-8 py-4 text-gray-200">Please check our refund policy on the registration page for details about payments and refunds.</div>
                    </details>
                </div>
            </div>
            <!-- Programme & Content Section -->
            <div class="rounded-xl border border-gray-400 bg-[#0F172A] p-0 overflow-hidden">
                <div class="px-8 py-4 border-b border-gray-400">
                    <span class="text-2xl font-extrabold text-white">Programme & Content</span>
                </div>
                <div class="divide-y divide-gray-600">
                    <details class="group">
                        <summary class="px-8 py-4 cursor-pointer text-lg font-semibold text-white group-open:text-[#FFFF3C] transition-colors">How are speakers selected for the conference?</summary>
                        <div class="px-8 py-4 text-gray-200">Speakers are selected by our committee based on their expertise and relevance to the conference themes.</div>
                    </details>
                    <details class="group">
                        <summary class="px-8 py-4 cursor-pointer text-lg font-semibold text-white group-open:text-[#FFFF3C] transition-colors">Will presentations be recorded?</summary>
                        <div class="px-8 py-4 text-gray-200">Some presentations will be recorded and made available after the event.</div>
                    </details>
                    <details class="group">
                        <summary class="px-8 py-4 cursor-pointer text-lg font-semibold text-white group-open:text-[#FFFF3C] transition-colors">Can I suggest a topic or speaker for the conference?</summary>
                        <div class="px-8 py-4 text-gray-200">Yes! Please <a href="{{ route('contact') }}" class="text-[#7B61FF] underline">contact us here</a> with your suggestions.</div>
                    </details>
                </div>
            </div>
        </div>
        <!-- Still have questions section -->
        <div class="w-full max-w-5xl flex flex-col items-center mt-16">
            <h3 class="text-2xl font-extrabold text-white mb-2 text-center">Still have questions?</h3>
            <p class="text-white mb-6 text-center">Contact our support team and we'll get back to you as soon as possible.</p>
            <a href="{{ route('contact') }}" class="bg-[#7B61FF] hover:bg-[#a18aff] text-white font-bold py-3 px-8 rounded-full text-lg transition-colors">Contact Us</a>
        </div>
    </div>
</x-app-layout>
