<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Frequently asked questions (FAQ)') }}
        </h2>

        <x-waitt.button-link href="{{ route('moderator.faqs.create') }}">
            {{ __('Create a new FAQ') }}
        </x-waitt.button-link>
    </div>

    <div class="pt-5">
        <x-waitt.list-section>
            <x-slot name="content">
                <table class="w-full divide-gray-200 dark:divide-gray-700 text-left">
                    <thead class="bg-white/5 rounded">
                    <tr>
                        <th class="rounded-tl-md px-4 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider dark:text-gray-400">
                            Frequently Asked Question
                        </th>
                        <th class="rounded-tr-md px-4 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider dark:text-gray-400 right-0 sticky w-16">
                            Created At
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-700/10">
                    @forelse($faqs as $index => $faq)
                        <tr class="hover:cursor-pointer hover:bg-white/5 transition-all"
                            onclick="window.location='{{ route('moderator.faqs.show', $faq) }}'">
                            <td class="px-4 py-4 whitespace-nowrap text-gray-200">
                                <div class="flex">
                                    <div class="text-gray-200 text-sm items-center flex">
                                        <svg class="shrink-0 w-6 h-6 mr-1.5 block stroke-waitt-pink"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/>
                                        </svg>
                                        <div class="ml-2 grow">
                                            <strong>{{$faq->question}}</strong>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-200">
                                <div class="flex items-center">
                                    <svg
                                        class="shrink-0 w-5 h-5 mr-1.5 block stroke-waitt-pink"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23" fill="none"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $faq->created_at->format('d/m/Y') }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center text-gray-500 dark:text-gray-300">
                                There are currently no FAQs.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </x-slot>
        </x-waitt.list-section>
    </div>
</x-crew-colorful-layout>
