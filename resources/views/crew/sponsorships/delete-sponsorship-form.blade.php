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

    </x-slot>

    <x-slot name="actions">
        <x-danger-button wire:click="confirmDeletion" wire:loading.attr="disabled">
            {{ __('Delete Sponsorship') }}
        </x-danger-button>
    </x-slot>

</x-action-section>
