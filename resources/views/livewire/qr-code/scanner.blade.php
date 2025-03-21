<x-livewire-modal>
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        <p id="errorMessage"></p>
    </x-slot>

    <x-slot name="content">
        <div id="qr-reader-modal"></div>
    </x-slot>

    <x-slot name="buttons">
        <x-secondary-button wire:click="$dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-secondary-button>
    </x-slot>
</x-livewire-modal>
