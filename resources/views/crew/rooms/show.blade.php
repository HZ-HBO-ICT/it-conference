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
                    <x-details-list-item label="Room name">
                        {{ $room->name }}
                    </x-details-list-item>
                    <x-details-list-item label="Room maximum capacity/participants">
                        {{ $room->max_participants }}
                    </x-details-list-item>
                </x-slot>

                @can('update', \App\Models\Room::class)
                    <x-slot name="actions">
                        <x-button
                            onclick="Livewire.dispatch('openModal', { component: 'room.edit-room-modal', arguments: {room: {{$room}}} })">
                            {{ __('Edit details') }}
                        </x-button>
                    </x-slot>
                @endcan
            </x-action-section>
        </div>

        <x-section-border/>

        @can('delete', $room)
            <x-action-section>
                <x-slot name="title">
                    {{ __('Delete Room') }}
                </x-slot>

                <x-slot name="description">
                    You can remove the room
                </x-slot>

                <x-slot name="actions">
                    <x-danger-button
                        onclick="Livewire.dispatch('openModal', { component: 'room.delete-room-modal', arguments: {room: {{$room}}} })">
                        {{ __('Delete Room') }}
                    </x-danger-button>
                </x-slot>
            </x-action-section>
        @endcan
    </div>
</x-hub-layout>
