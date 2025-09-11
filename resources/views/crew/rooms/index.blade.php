<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Rooms') }}
        </h2>

        @can('create', \App\Models\Room::class)
        <x-waitt.button-link href="{{ route('moderator.rooms.create') }}">
            {{ __('Create a new room') }}
        </x-waitt.button-link>
        @endcan
    </div>

    <div class="pt-5">
        <x-waitt.list-section>
            <x-slot name="content">
                <table class="w-full divide-gray-200 dark:divide-gray-700 text-left">
                    <thead class="bg-white/5 rounded">
                        <tr>
                            <th class="rounded-tl-md px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-300">
                                Room Name
                            </th>
                            <th class="rounded-tr-md px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-300 right-0 sticky w-16">
                                Created At
                            </th>
                        </tr>
                        </thead>
                    <tbody class="divide-y-2 divide-gray-700/10">
                        @forelse($rooms as $index => $room)
                            <tr class="hover:cursor-pointer hover:bg-white/5 transition-all"
                                onclick="window.location='{{ route('moderator.rooms.show', $room) }}'">
                                <td class="px-4 py-4 whitespace-nowrap text-gray-200">
                                    <div class="flex">
                                        <div class="text-gray-200 text-sm items-center flex">
                                                <svg
                                                    class="shrink-0 w-5 h-5 mr-1.5 block stroke-waitt-pink"
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
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-200">
                                    <div class="flex items-center">
                                        <svg
                                            class="shrink-0 w-6 h-6 mr-1.5 block stroke-waitt-pink"
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
            </x-waitt.list-section>
        </div>
</x-crew-colorful-layout>
