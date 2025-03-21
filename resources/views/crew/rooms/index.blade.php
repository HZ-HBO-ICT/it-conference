<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Rooms') }}
        </h2>
        <div class="pt-5">
            <x-list-section>
                @can('create', \App\Models\Room::class)
                    <x-slot name="actions">
                        <x-button-link href="{{route('moderator.rooms.create')}}">
                            {{ __('Add a new room') }}
                        </x-button-link>
                    </x-slot>
                @endcan
                <x-slot name="content">
                    <table class="table-fixed min-w-full divide-gray-200 dark:divide-gray-700">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Room Name
                            </th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider right-0 sticky w-16 dark:text-gray-400">
                                Created At
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y-4 divide-white dark:divide-gray-700">
                        @forelse($rooms as $index => $room)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                                onclick="window.location='{{ route('moderator.rooms.show', $room) }}'">
                                <td class="px-4 py-4 whitespace-nowrap text-gray-700 dark:text-white">
                                    <div class="flex">
                                        <div class="flex">
                                            <div class="text-gray-700 dark:text-white text-m items-center flex">
                                                <svg
                                                    class="shrink-0 w-6 h-6 mr-1.5 block stroke-apricot-peach-400"
                                                    xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none"
                                                    aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                                    <path
                                                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                <div class="ml-2 grow">
                                                    <strong>{{$room->name}}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700 dark:text-white right-0 sticky ">
                                    <div class="flex items-center">
                                        <svg
                                            class="shrink-0 w-6 h-6 mr-1.5 block stroke-apricot-peach-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23" fill="none"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $room->created_at->format('d/m/Y') }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-2 text-center text-gray-500 dark:text-gray-300">
                                    There are currently no rooms.
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
