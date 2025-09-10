<x-waitt.livewire-modal form-action="delete">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Delete {{ $presentationType->name }}
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="text-gray-100">
            Are you sure you want to delete the presentation type?
        </div>
    </x-slot>

    <x-slot name="buttons" class="dark:bg-gray-900">
        <x-waitt.button type="button" wire:click="$dispatch('closeModal')" class="mr-3 hover:cursor-pointer">
            {{ __('Cancel') }}
        </x-waitt.button>
        <x-waitt.button variant="delete" type="submit">
            Delete
        </x-waitt.button>
    </x-slot>
</x-waitt.livewire-modal>
