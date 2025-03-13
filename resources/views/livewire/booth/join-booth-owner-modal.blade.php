<x-livewire-modal form-action="save">
    <x-slot name="title">
        Join the booth owners?
    </x-slot>

    <x-slot name="content">
        <h3 class="font-bold text-partner-700">{{ __('WARNING: this action cannot be undone') }}</h3>
        {{ __('Are you sure you want to become a booth owner? You can stay as a company member (accompanying the company
        but having no special role or to become a speaker (responsible for the company presentation)') }}
    </x-slot>

    <x-slot name="buttons" class="dark:bg-gray-900">
        <x-secondary-button type="button" wire:click="$dispatch('closeModal')" class="mr-3">
            {{ __('Cancel') }}
        </x-secondary-button>

        <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            Become a booth owner
        </button>
    </x-slot>
</x-livewire-modal>
