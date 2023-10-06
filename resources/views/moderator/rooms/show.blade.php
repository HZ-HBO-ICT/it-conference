<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Room details') }}
        </h2>
        <div class="pt-5">
            <x-action-section>
                <x-slot name="title">
                    {{ __('Room Information') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('The room basic information.') }}
                </x-slot>

                <x-slot name="content">
                    <div class="pr-5">
                        <form method="POST" action="{{route('moderator.rooms.update', $room)}}">
                            @csrf
                            @method('PUT')
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="name" value="Room name"/>
                                <x-input id="name" name="name" type="text" value="{{$room->name}}" class="mt-1 block w-full"
                                         disabled/>
                                <x-input-error for="name" class="mt-2"/>
                            </div>
                            <div class="col-span-6 sm:col-span-4 py-4">
                                <x-label for="max_participants" value="Maximum capacity of the room"/>
                                <x-input id="name" name="max_participants" type="number" value="{{$room->max_participants}}"
                                         class="mt-1 block w-full"/>
                                <x-input-error for="max_participants" class="mt-2"/>
                            </div>
                            <x-button
                                class="mt-5 dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                                Save
                            </x-button>
                        </form>
                    </div>
                </x-slot>
            </x-action-section>

            <x-section-border/>

            <x-action-section>
                <x-slot name="title">
                    {{ __('Delete This Booth') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Permanently delete this booth and related data') }}
                </x-slot>

                <x-slot name="content">
                    <form id="destroy" method="POST" action="{{ route('moderator.rooms.destroy', $room) }}" class="pl-2">
                        @csrf
                        @method('DELETE')
                        WARNING: this action cannot be undone
                    </form>
                </x-slot>

                <x-slot name="actions">
                    <x-danger-button type=submit form="destroy">Remove this room</x-danger-button>
                </x-slot>
            </x-action-section>
        </div>
    </div>
</x-hub-layout>
