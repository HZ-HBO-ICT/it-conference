<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Companies') }}
        </h2>
        <div class="pt-5">
            <x-list-section>

                <x-slot name="actions">
                    <x-button-link href="{{route('moderator.companies.create')}}">
                        {{ __('Invite a company') }}
                    </x-button-link>
                </x-slot>

                <x-slot name="content">
                    <table class="min-w-full divide-gray-200 dark:divide-gray-700">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Company Name
                            </th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Company Representative
                            </th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400 right-0 sticky w-16">
                                Created At
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y-4 divide-white dark:divide-gray-700">
                        @forelse($companies as $index => $company)
                            <tr class="{{ $company->is_approved ? 'hover:bg-gray-100 dark:hover:bg-gray-700' : 'bg-apricot-peach-400 bg-opacity-30 dark:bg-opacity-20 hover:bg-apricot-peach-200' }} cursor-pointer"
                                onclick="window.location='{{ route('moderator.companies.show', $company) }}'">
                                <td class="px-4 py-4 whitespace-nowrap text-gray-700 dark:text-white">
                                    <div class="flex">
                                        <div class="text-gray-700 dark:text-white text-m items-center flex">
                                            @if($company->logo_path)
                                                <img class="w-6 h-6 mx-auto my-auto max-w-full block dark:text-white"
                                                     src="{{ url('storage/'. $company->logo_path) }}"
                                                     alt="Logo of {{$company->name}}">
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1"
                                                     stroke="gray" aria-hidden="true"
                                                     class="w-6 h-6 {{ !$company->is_approved ? 'stroke-gray-900 dark:stroke-white' : 'stroke-apricot-peach-300' }}">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                                                </svg>
                                            @endif
                                            <div class="ml-2 flex-grow">
                                                <strong>{{$company->name}}</strong>
                                                <br/>
                                                <span class="text-sm text-gray-500">{{ $company->speakernames }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ optional($company->representative)->name }}
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700 dark:text-white">
                                    <div class="flex items-center">
                                        <svg
                                            class="shrink-0 w-6 h-6 mr-1.5 block stroke-apricot-peach-400 {{ !$company->is_approved ? 'stroke-gray-900 dark:stroke-white' : '' }}"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23" fill="none"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $company->created_at->format('d/m/Y') }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-2 text-center text-gray-500 dark:text-gray-300">
                                    There are currently no companies.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="pt-2">
                        {{ $companies->links() }}
                    </div>
                </x-slot>
            </x-list-section>
        </div>
    </div>
</x-hub-layout>
