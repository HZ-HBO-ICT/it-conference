<x-action-section>
    <x-slot name="title">
        {{ __('Delete This Room') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete this room and related data') }}
    </x-slot>

    <x-slot name="content">
        @if(!$room->can_be_deleted)
            {{ __('This room cannot be deleted') }}
        @else
            @if($room->presentations->count() == 0)
                {{ __('There are no presentations scheduled in this room') }}
            @else
                {{ __('There are presentations scheduled in this room. Deleting this room will make these presentations no longer to be scheduled, and would need a new room and timeslot:') }}
                <ul>
                @foreach($room->presentations as $presentation)
                    <li>
                        {{ $presentation->name }}
                        @if($presentation->timeslot)
                            ( {{ __('start') }}: {{ $presentation->timeslot->start }}
                            | {{ $presentation->timeslot->duration }} {{ _('minutes') }})
                        @endif
                    </li>
                @endforeach
                </ul>
            @endif
            <!-- Delete User Confirmation Modal -->
            <x-dialog-modal wire:model="confirmingRoomDeletion">
                <x-slot name="title">
                    {{ __('Delete Room') }}
                </x-slot>

                <x-slot name="content">
                    <h3 class="font-bold text-red-600">{{ __('WARNING: this action cannot be undone') }}</h3>
                    {{ __('Are you sure you want to delete this room? Once this is deleted, all of its resources and data will be permanently deleted.') }}
                </x-slot>

                <x-slot name="footer">
                    <x-secondary-button wire:click="$toggle('confirmingRoomDeletion')" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <form method="POST" action="{{ route('moderator.rooms.destroy', $room) }}" class="pl-2">
                        @csrf
                        @method('DELETE')
                        <x-danger-button class="ml-3" type="submit">
                            {{ __('Delete Room') }}
                        </x-danger-button>
                    </form>
                </x-slot>
            </x-dialog-modal>
        @endif
    </x-slot>

    <x-slot name="actions">
        @if($room->can_be_deleted)
            <x-danger-button wire:click="confirmRoomDeletion" wire:loading.attr="disabled">
                {{ __('Delete Room') }}
            </x-danger-button>
        @endif
    </x-slot>

</x-action-section>
