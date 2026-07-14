<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Presentations') }}
        </h2>

        <x-waitt.button-link href="{{ route('moderator.presentations.create') }}">
            {{ __('Create a new presentation') }}
        </x-waitt.button-link>
    </div>

    <div class="pt-5">
        <x-waitt.list-section>
            <x-slot name="content">
                <table class="w-full divide-gray-200 dark:divide-gray-700 text-left">
                    <thead class="bg-white/5 rounded">
                    <tr>
                        <th class="rounded-tl-md px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-300">
                            Presentation Name
                        </th>
                        <th class="rounded-tl-md px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-300">
                            Participants
                        </th>
                        <th class="py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-300">
                            Approval status
                        </th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-300">
                            Company
                        </th>
                        <th class="rounded-tr-md px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-300 right-0 sticky w-16">
                            Created At
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-700/10">
                    @forelse($presentations as $index => $presentation)
                        <tr class="hover:cursor-pointer hover:bg-white/5 transition-all"
                            onclick="window.location='{{ route('moderator.presentations.show', $presentation) }}'">
                            <td class="px-4 py-4 whitespace-nowrap text-gray-200">
                                <div class="flex items-center">
                                    <svg
                                        class="shrink-0 w-6 h-6 mr-1.5 block stroke-apricot-peach-300 stroke-waitt-pink"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23" fill="none"
                                        aria-hidden="true">
                                        <path
                                            d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"></path>
                                    </svg>
                                    <div class="ml-2 text-sm">
                                        <strong>{{ $presentation->name }}</strong>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-200">
                                @if($presentation->room)
                                    {{$presentation->participants->count()}}/{{ min($presentation->room->max_participants, $presentation->max_participants) }}
                                @else
                                    N/a
                                @endif
                            </td>
                            <td>
                                <x-waitt.tag :uppercase="false" :textSize="'text-xs'" :title="ucfirst(str_replace('_', ' ', $presentation->approval_status))"/>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-200">
                                {{ optional($presentation->company)->name }}
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-200">
                                <div class="flex items-center">
                                    <svg
                                        class="shrink-0 w-5 h-5 mr-1.5 block stroke-apricot-peach-400 stroke-waitt-pink"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23" fill="none"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $presentation->created_at->format('d/m/Y') }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center text-gray-500 dark:text-gray-300">
                                There are currently no new presentations waiting on approval.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="pt-2">
                    {{ $presentations->links() }}
                </div>
            </x-slot>
        </x-waitt.list-section>
    </div>
</x-crew-colorful-layout>
