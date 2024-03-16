<x-action-section>
    <x-slot name="title">
        {{ __('Delete This User') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently remove the user from the system') }}
    </x-slot>

    <x-slot name="content">
        {{ __('If you delete the user every data connected with them will be wiped out: If they are presenting,
            their presentation is gone; if they are company representative, the company including sponsorship, booths,
            all presentations and all members will be only participants') }}
        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingDeletion">
            <x-slot name="title">
                {{ __('Delete User') }}
            </x-slot>

            <x-slot name="content">
                <h3 class="font-bold text-red-600">{{ __('WARNING: this action cannot be undone') }}</h3>
                {{ __('Are you sure you want to delete this user?') }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <form method="POST" action="{{ route('moderator.users.destroy', $user) }}" class="pl-2">
                    @csrf
                    @method('DELETE')
                    <x-danger-button class="ml-3" type="submit">
                        {{ __('Delete User') }}
                    </x-danger-button>
                </form>
            </x-slot>
        </x-dialog-modal>
    </x-slot>

    <x-slot name="actions">
        <x-danger-button wire:click="confirmDeletion" wire:loading.attr="disabled">
            {{ __('Delete User') }}
        </x-danger-button>
    </x-slot>

</x-action-section>
