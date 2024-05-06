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
                            {{ __('Add a room to be used in this conference') }}
                        </x-button-link>
                    </x-slot>
                @endcan
                <x-slot name="content">
                    @forelse($rooms as $room)
                        <x-list-section-item :url="route('moderator.rooms.show', $room)">
                            <div class="justify-between flex mt-2">
                                <div class="flex">
                                    <div class="text-gray-700 dark:text-white text-m items-center flex">
                                        <svg class="shrink-0 w-6 h-6 mr-1.5 block stroke-crew-400 " xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none" aria-hidden="true">
                                            <path d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z"></path>
                                        </svg>
                                        <div class="ml-2 flex-grow">
                                            <strong>{{$room->name}}</strong><br>
                                            <span class="text-sm text-gray-500">Max. {{ $room->max_participants }} participants</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-sm items-center flex ml-2 dark:text-white">
                                    <svg class="shrink-0 w-6 h-6 mr-1.5 block stroke-crew-400" xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{$room->created_at->format('d/m/Y')}}
                                </div>
                            </div>

                        </x-list-section-item>

                    @empty
                        <p class="text-crew-400 text-lg justify-center flex m-12">
                            There are currently no rooms added to this conference.
                            Click 'Add a new room' to add.
                        </p>
                    @endforelse
                </x-slot>
            </x-list-section>
        </div>
    </div>
</x-hub-layout>
