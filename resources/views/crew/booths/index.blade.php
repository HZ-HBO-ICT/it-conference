<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Booths') }}
        </h2>
        <div class="pt-5">
            <x-list-section>
                <x-slot name="actions">
                    <x-button-link href="{{route('moderator.booths.create')}}">
                        {{ __('Add a booth for a company') }}
                    </x-button-link>
                </x-slot>
                <x-slot name="content">
                    <table class="min-w-full divide-gray-200 dark:divide-gray-700">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Company Name
                            </th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400 right-0 sticky w-16">
                                Created At
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y-4 divide-white dark:divide-gray-700">
                        @forelse($booths as $index => $booth)
                            <tr class="{{ $booth->is_approved ? 'hover:bg-gray-100 dark:hover:bg-gray-700' : 'bg-apricot-peach-400 bg-opacity-30 dark:bg-opacity-20 hover:bg-apricot-peach-200' }} cursor-pointer"
                                onclick="window.location='{{ route('moderator.booths.show', $booth) }}'">
                                <td class="px-4 py-4 whitespace-nowrap text-gray-700 dark:text-white">
                                    <div class="flex">
                                        <div class="text-gray-700 dark:text-white text-m items-center flex">
                                            <svg
                                                class="shrink-0 w-6 h-6 mr-1.5 block stroke-apricot-peach-400 {{ !$booth->is_approved ? 'stroke-gray-900 dark:stroke-gray-100 hover:stroke-gray-500' : '' }}"
                                                xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none"
                                                aria-hidden="true">
                                                <path
                                                    d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z"></path>
                                            </svg>
                                            <div class="ml-2 flex-grow">
                                                <strong>{{$booth->company->name}}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700 dark:text-white">
                                    <div class="flex items-center">
                                        <svg
                                            class="shrink-0 w-6 h-6 mr-1.5 block stroke-apricot-peach-400 {{ !$booth->is_approved ? 'stroke-gray-900 dark:stroke-white' : '' }}"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23" fill="none"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $booth->created_at->format('d/m/Y') }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-2 text-center text-gray-500 dark:text-gray-300">
                                    There are currently no booths.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="pt-2">
                        {{ $booths->links() }}
                    </div>
                </x-slot>
            </x-list-section>
        </div>
    </div>
</x-hub-layout>
