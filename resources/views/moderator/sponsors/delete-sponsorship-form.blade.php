<x-action-section>
    <x-slot name="title">
        {{ __('Delete This Sponsorship') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently remove the sponsorship status from this company') }}
    </x-slot>

    <x-slot name="content">
        {{ __('When deleted the company will no longer appear as a sponsor. However, the company representative is allowed to apply for another sponsorship') }}
        <!-- Delete User Confirmation Modal -->
            <x-dialog-modal wire:model="confirmingDeletion">
                <x-slot name="title">
                    {{ __('Delete Sponsorship') }}
                </x-slot>

                <x-slot name="content">
                    <h3 class="font-bold text-red-600">{{ __('WARNING: this action cannot be undone') }}</h3>
                    {{ __('Are you sure you want to delete this sponsorship?') }}
                </x-slot>

                <x-slot name="footer">
                    <x-secondary-button wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <form method="POST" action="{{ route('moderator.sponsors.destroy', $team) }}" class="pl-2">
                        @csrf
                        @method('DELETE')
                        <x-danger-button class="ml-3" type="submit">
                            {{ __('Delete Sponsorship') }}
                        </x-danger-button>
                    </form>
                </x-slot>
            </x-dialog-modal>
    </x-slot>

    <x-slot name="actions">
        <x-danger-button wire:click="confirmDeletion" wire:loading.attr="disabled">
            {{ __('Delete Sponsorship') }}
        </x-danger-button>
    </x-slot>

</x-action-section>
