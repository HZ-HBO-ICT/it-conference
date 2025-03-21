<x-livewire-modal>
    <x-slot name="title">
        Delete edition
    </x-slot>

    <x-slot name="content">
        <h3 class="font-bold text-red-600">{{ __('WARNING: this action cannot be undone') }}</h3>
        {{ __('Are you sure you want to delete this edition?') }}
    </x-slot>

    <x-slot name="buttons">
        <x-secondary-button wire:click="$dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <form method="POST"
              action="{{ Auth::user()->hasRole('event organizer')
                                ? route('moderator.editions.destroy', $edition)
                                : ''}}">
            @csrf
            @method('DELETE')
            <x-danger-button class="ml-3" type="submit">
                {{ __('Delete Edition') }}
            </x-danger-button>
        </form>
    </x-slot>
</x-livewire-modal>
