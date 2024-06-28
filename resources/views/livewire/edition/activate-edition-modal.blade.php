<x-livewire-modal>
    <x-slot name="title">
        Activate edition
    </x-slot>

    <x-slot name="content">
        <h3 class="font-bold text-red-600">{{ __('WARNING: this action will result in major changes in the application') }}</h3>
        {{ __('Are you sure you want to activate this edition?') }}
    </x-slot>

    <x-slot name="buttons">
        <x-secondary-button wire:click="$dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <form method="POST"
              action="{{ Auth::user()->hasRole('content moderator')
                                ? route('moderator.editions.activate', $edition)
                                : ''}}">
            @csrf
            @method('POST')
            <x-button class="ml-3" type="submit">
                {{ __('Activate Edition') }}
            </x-button>
        </form>
    </x-slot>
</x-livewire-modal>
