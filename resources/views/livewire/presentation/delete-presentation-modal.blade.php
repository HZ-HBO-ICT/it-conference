<x-waitt.livewire-modal>
    <x-slot name="title">
        Delete presentation
    </x-slot>

    <x-slot name="content">
        <h3 class="font-bold text-red-600">{{ __('WARNING: this action cannot be undone') }}</h3>
        <div class="text-white">
            {{ __('Are you sure you want to delete this presentation?') }}
        </div>
    </x-slot>

    <x-slot name="buttons">
        <x-waitt.button wire:click="$dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-waitt.button>

        <form method="POST"
              action="{{ Auth::user()->hasRole('content moderator')
                                ? route('moderator.presentations.destroy', $presentation)
                                : /*route('presentations.destroy', $presentation)*/ ''}}">
            @csrf
            @method('DELETE')
            <x-waitt.button variant="delete" type="submit">
                {{ __('Delete Presentation') }}
            </x-waitt.button>
        </form>
    </x-slot>
</x-waitt.livewire-modal>
