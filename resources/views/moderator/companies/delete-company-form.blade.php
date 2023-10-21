<x-action-section>
    <x-slot name="title">
        {{ __('Delete This Company') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently remove this company') }}
    </x-slot>

    <x-slot name="content">
        <div class="text-gray-800 dark:text-gray-200">
            {{ __('When deleted the company will no longer exist and all data related to it as well - all presentations
               will be removed, booth as well. Company members will just be participants ') }}
        </div>
        <!-- Delete Company Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingDeletion">
            <x-slot name="title">
                {{ __('Delete Company') }}
            </x-slot>

            <x-slot name="content">
                <h3 class="font-bold text-red-600">{{ __('WARNING: this action cannot be undone') }}</h3>
                {{ __('Are you sure you want to delete this company?') }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <form method="POST" action="{{ route('moderator.companies.destroy', $company) }}" class="pl-2">
                    @csrf
                    @method('DELETE')
                    <x-danger-button class="ml-3" type="submit">
                        {{ __('Delete Company') }}
                    </x-danger-button>
                </form>
            </x-slot>
        </x-dialog-modal>
    </x-slot>

    <x-slot name="actions">
        <x-danger-button wire:click="confirmDeletion" wire:loading.attr="disabled">
            {{ __('Delete Company') }}
        </x-danger-button>
    </x-slot>

</x-action-section>
