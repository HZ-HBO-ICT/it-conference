@php
    use App\Models\Sponsorship;
@endphp
<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Sponsorships') }}
        </h2>

        @if(Sponsorship::canAddSponsor())
            @can('create', Sponsorship::class)
                <x-waitt.button-link href="{{ route('moderator.sponsorships.create') }}">
                    {{ __('Create a new sponsor') }}
                </x-waitt.button-link>
            @endcan
        @endif
    </div>

    <div class="pt-5">
        <x-waitt.list-section>
            <x-slot name="content">
                <table class="w-full divide-gray-200 dark:divide-gray-700 text-left">
                    <thead class="bg-white/5 rounded">
                    <tr>
                        <th class="rounded-tl-md px-4 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider dark:text-gray-400">
                            Company Name
                        </th>
                        <th class="py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-300">
                            Approval status
                        </th>
                        <th class="rounded-tr-md px-4 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider dark:text-gray-400 right-0 sticky w-16">
                            Created At
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-700/10">
                        @forelse($companies as $index => $company)
                            <tr class="hover:cursor-pointer hover:bg-white/5 transition-all"
                                onclick="window.location='{{ route('moderator.sponsorships.show', $company) }}'">
                                <td class="px-4 py-4 whitespace-nowrap text-gray-200">
                                    <div class="flex">
                                        <div class="text-gray-200 text-sm items-center flex">
                                            @if($company->logo_path)
                                                <img class="w-6 h-6 mx-auto my-auto max-w-full block dark:text-white"
                                                     src="{{ url('storage/'. $company->logo_path) }}"
                                                     alt="Logo of {{$company->name}}">
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1"
                                                     stroke="gray" aria-hidden="true" class="w-6 h-6 stroke-waitt-pink">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                                                </svg>
                                            @endif
                                            <div class="ml-2 grow">
                                                <strong>{{$company->name}}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <x-waitt.tag :uppercase="false" :textSize="'text-xs'" :title="ucfirst(str_replace('_', ' ', $company->sponsorship_approval_status))"/>
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
                                        {{ $company->created_at->format('d/m/Y') }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-2 text-center text-gray-500 dark:text-gray-300">
                                    There are currently no sponsorships.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="pt-2">
                        {{ $companies->links() }}
                    </div>
                </x-slot>
            </x-waitt.list-section>
        </div>
</x-crew-colorful-layout>
