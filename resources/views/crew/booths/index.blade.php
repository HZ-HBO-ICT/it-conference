<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Booths') }}
        </h2>

        <x-waitt.button-link href="{{ route('moderator.booths.create') }}">
            {{ __('Create a new booth') }}
        </x-waitt.button-link>
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
                    @forelse($booths as $index => $booth)
                        <tr class="hover:cursor-pointer hover:bg-white/5 transition-all"
                            onclick="window.location='{{ route('moderator.booths.show', $booth) }}'">
                            <td class="px-4 py-4 whitespace-nowrap text-gray-200">
                                <div class="flex">
                                    <div class="text-gray-200 text-sm items-center flex">
                                        <svg
                                            class="shrink-0 w-6 h-6 mr-1.5 block stroke-waitt-pink"
                                            xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none"
                                            aria-hidden="true">
                                            <path
                                                d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z"></path>
                                        </svg>
                                        <div class="ml-2 grow">
                                            <strong>{{$booth->company->name}}</strong>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <x-waitt.tag :uppercase="false" :textSize="'text-xs'" :title="ucfirst(str_replace('_', ' ', $booth->approval_status))"/>
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
        </x-waitt.list-section>
    </div>
</x-crew-colorful-layout>
