<x-app-layout>
    <div class="relative bg-cover overflow-hidden min-h-screen">
{{--        <div--}}
{{--            class="before:absolute before:bg-gradient-to-br before:from-gradient-yellow before:via-gradient-pink before:via-gradient-purple before:to-gradient-blue before:opacity-70 before:w-full before:h-full"></div>--}}

        <div class="isolate px-6 py-6 max-w-7xl mx-auto my-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center max-w-2xl mx-auto">
                <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">Frequently Asked Questions</h2>
                <p class="leading-7 text-base dark:text-gray-200">
                    Have a different question and can’t find the answer you’re looking for? Reach out to our support team by emailing
                    <a class="text-blue-600 hover:text-blue-400 visited:text-purple-600" href="mailto: info@weareinittogether.nl">info@weareinittogether.nl</a>
                    and we’ll get back to you as soon as we can.
                </p>
            </div>
            <div class="m-5 md:m-20">
                <dl class="grid-cols-1 gap-y-5 md:gap-x-10 md:gap-y-16 md:grid-cols-2 grid">
                    @foreach(\App\Models\FrequentQuestion::all() as $faq)
                        <div class="border rounded border-gray-300 shadow p-4 dark:bg-gray-800 dark:border-gray-700">
                            <dt class="leading-7 font-semibold text-base dark:text-white">{{$faq->question}}</dt>
                            <dd class="leading-7 mt-2 dark:text-gray-200">
                                <x-markdown-viewer :content="$faq->answer" />
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
