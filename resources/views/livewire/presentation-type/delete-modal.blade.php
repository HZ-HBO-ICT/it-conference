<x-livewire-modal form-action="delete">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Delete {{ $presentationType->name }}
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        Are you sure you want to delete the presentation type?
    </x-slot>

    <x-slot name="buttons" class="dark:bg-gray-900">
        <x-secondary-button type="button" wire:click="$dispatch('closeModal')" class="mr-3 hover:cursor-pointer">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-button type="submit" class="bg-red-800 hover:bg-red-700 hover:cursor-pointer">
            Save
        </x-button>
    </x-slot>
</x-livewire-modal>
