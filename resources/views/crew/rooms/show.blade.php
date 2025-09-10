<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Company details') }}
        </h2>
    </div>
    <div class="py-5">
            <x-waitt.action-section>
                <x-slot name="title">
                    {{ __('Room Information') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('The room basic information.') }}
                </x-slot>


                <x-slot name="content">
                    <x-waitt.details-list-item label="Room name">
                        {{ $room->name }}
                    </x-waitt.details-list-item>
                    <x-waitt.details-list-item label="Room maximum capacity/participants">
                        {{ $room->max_participants }}
                    </x-waitt.details-list-item>
                </x-slot>

                @can('update', \App\Models\Room::class)
                    <x-slot name="actions">
                        <x-waitt.button variant="edit"
                            onclick="Livewire.dispatch('openModal', { component: 'room.edit-room-modal', arguments: {room: {{$room}}} })">
                            {{ __('Edit details') }}
                        </x-waitt.button>
                    </x-slot>
                @endcan
            </x-waitt.action-section>
        </div>


        @can('delete', $room)
        <x-waitt.section-border/>

        <x-waitt.action-section>
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
            </x-waitt.action-section>
        @endcan
</x-crew-colorful-layout>
