<x-waitt.livewire-modal>
    <x-slot name="title">
        Activate edition
    </x-slot>

    <x-slot name="content">
        <h3 class="font-bold text-red-600">{{ __('WARNING: this action will result in major changes in the application') }}</h3>
        <div class="text-white">
            {{ __('Are you sure you want to activate this edition?') }}
        </div>
    </x-slot>

    <x-slot name="buttons">
        <x-waitt.button wire:click="$dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-waitt.button>

        <form method="POST"
              action="{{ Auth::user()->hasRole('event organizer')
                                ? route('moderator.editions.activate', $edition)
                                : ''}}">
            @csrf
            @method('POST')
            <x-waitt.button variant="delete" class="ml-3" type="submit">
                {{ __('Activate Edition') }}
            </x-waitt.button>
        </form>
    </x-slot>
</x-waitt.livewire-modal>
