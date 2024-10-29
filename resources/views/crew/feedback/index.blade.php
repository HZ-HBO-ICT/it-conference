<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Received feedback') }}
        </h2>
        <div class="pt-5">
            <x-list-section>
                <x-slot name="content">
                    <table class="table-fixed min-w-full divide-gray-200 dark:divide-gray-700">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Title
                            </th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Type
                            </th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400 right-0 sticky w-16">
                                Created At
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y-4 divide-white dark:divide-gray-700">
                        @forelse($feedbackReports as $index => $feedback)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                                onclick="window.location='{{ route('moderator.feedback.show', $feedback) }}'">
                                <td class="px-4 py-4 whitespace-nowrap text-gray-700 dark:text-white">
                                    <div class="flex">
                                        <div class="flex">
                                            <div class="text-gray-700 dark:text-white text-m items-center flex">
                                                <svg class="shrink-0 w-6 h-6 mr-1.5 block stroke-apricot-peach-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                                </svg>
                                                <div class="ml-2 flex-grow">
                                                    <strong>{{$feedback->title}}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ ucfirst($feedback->type) }}
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700 dark:text-white">
                                    <div class="flex items-center">
                                        <svg
                                            class="shrink-0 w-6 h-6 mr-1.5 block stroke-apricot-peach-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23" fill="none"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $feedback->created_at->format('d/m/Y') }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-2 text-center text-gray-500 dark:text-gray-300">
                                    There is currently no feedback submitted.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </x-slot>
            </x-list-section>
        </div>
    </div>
</x-hub-layout>
