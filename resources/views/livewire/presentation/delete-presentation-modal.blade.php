<x-livewire-modal>
    <x-slot name="title">
        Delete presentation
    </x-slot>

    <x-slot name="content">
        <h3 class="font-bold text-red-600">{{ __('WARNING: this action cannot be undone') }}</h3>
        {{ __('Are you sure you want to delete this presentation?') }}
    </x-slot>

    <x-slot name="buttons">
        <x-secondary-button wire:click="$dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <form method="POST"
              action="{{ Auth::user()->hasRole('content moderator')
                                ? route('moderator.presentations.destroy', $presentation)
                                : /*route('presentations.destroy', $presentation)*/ ''}}">
            @csrf
            @method('DELETE')
            <x-danger-button class="ml-3" type="submit">
                {{ __('Delete Presentation') }}
            </x-danger-button>
        </form>
    </x-slot>
</x-livewire-modal>