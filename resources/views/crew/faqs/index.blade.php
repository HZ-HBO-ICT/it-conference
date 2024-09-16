<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Frequently Asked Questions (FAQs)') }}
        </h2>
        <div class="pt-5">
            <x-list-section>
                @can('create', \App\Models\Room::class)
                    <x-slot name="actions">
                        <x-button-link href="{{route('moderator.faqs.create')}}">
                            {{ __('Add a new FAQ') }}
                        </x-button-link>
                    </x-slot>
                @endcan
                <x-slot name="content">
                    @forelse($faqs as $index => $faq)
                        <x-list-section-item
                            class="border-transparent hover:bg-gray-100 border-l-4"
                            :url="route('moderator.faqs.show', $faq)">
                            <div class="justify-between flex mt-2">
                                <div class="flex">
                                    <div class="text-gray-700 dark:text-white text-m items-center flex">
                                        <svg class="shrink-0 w-6 h-6 mr-1.5 block stroke-apricot-peach-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                        </svg>
                                        <div class="ml-2 flex-grow">
                                            <strong>{{$faq->question}}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-sm items-center flex ml-2 dark:text-white">
                                    <svg
                                        class="shrink-0 w-6 h-6 mr-1.5 block stroke-apricot-peach-400"
                                        xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{$faq->created_at->format('d/m/Y')}}
                                </div>
                            </div>
                        </x-list-section-item>
                    @empty
                        <p class="text-crew-400 text-lg justify-center flex m-12">There are currently no FAQs</p>
                    @endforelse
                </x-slot>
            </x-list-section>
        </div>
    </div>
</x-hub-layout>
