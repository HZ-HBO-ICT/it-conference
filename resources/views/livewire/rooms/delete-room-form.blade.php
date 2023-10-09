<x-action-section>
    <x-slot name="title">
        {{ __('Delete This Room') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete this room and related data') }}
    </x-slot>

    <x-slot name="content">
        {{ __('The following related resources will be deleted:') }}
        <br>
        @TODO: list all scheduled presentations in this room

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingRoomDeletion">
            <x-slot name="title">
                {{ __('Delete Room') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete this room? Once this is deleted, all of its resources and data will be permanently deleted.') }}

                <form id="destroy" method="POST" action="{{ route('moderator.rooms.destroy', $room) }}" class="pl-2">
                    @csrf
                    @method('DELETE')
                    WARNING: this action cannot be undone
                </form>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingRoomDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3" type=submit form="destroy">
                    {{ __('Delete Room') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>

    <x-slot name="actions">
        <x-danger-button wire:click="confirmRoomDeletion" wire:loading.attr="disabled">
            {{ __('Delete Room') }}
        </x-danger-button>
    </x-slot>

</x-action-section>
