<div x-data="{ open: @entangle('isOpen') }" class="w-full h-full">
    <button class="cursor-pointer ml-6 text-sm text-red-500"
            @click="open = true">
        {{ __('Remove') }}
    </button>

    <div
        x-cloak
        x-show="open"
        x-transition:enter="transition-opacity ease-out duration-400"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 flex items-center justify-center z-50 bg-opacity-75 bg-gray-900 dark:bg-opacity-75 dark:bg-gray-800 dark:text-gray-200"
    >
        <div class="bg-white p-4 rounded-sm shadow-lg dark:bg-gray-900 text-left">
            <div class="p-5">
                <x-action-section>
                    <x-slot name="title">
                        {{ __('Remove Team Member') }}
                    </x-slot>
                    <x-slot name="description">
                        {{ __('This allows you to remove a member from the company.') }}
                    </x-slot>

                    <x-slot name="content">
                        {{ __('Are you sure you would like to remove this person from the company?') }}
                    </x-slot>

                    <x-slot name="actions">
                        <x-secondary-button wire:click="confirm" wire:loading.attr="disabled">
                            {{ __('Save') }}
                        </x-secondary-button>

                        <button wire:click="close"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Cancel
                        </button>
                    </x-slot>
                </x-action-section>
            </div>
        </div>
    </div>
</div>
