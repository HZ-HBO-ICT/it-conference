<x-livewire-modal>
    <x-slot name="title">
        Delete company
    </x-slot>

    <x-slot name="content">
        <h3 class="font-bold text-red-600">{{ __('WARNING: this action cannot be undone') }}</h3>
        {{ __('Are you sure you want to delete this company?') }}
    </x-slot>

    <x-slot name="buttons">
        <x-secondary-button wire:click="$dispatch('closeModal')">
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
</x-livewire-modal>
