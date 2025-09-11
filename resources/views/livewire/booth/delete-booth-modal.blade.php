<x-waitt.livewire-modal>
    <x-slot name="title">
        Delete booth
    </x-slot>

    <x-slot name="content">
        <h3 class="font-bold text-red-600">{{ __('WARNING: this action cannot be undone') }}</h3>
        <div class="text-white">
            {{ __('Are you sure you want to delete this booth?') }}
        </div>
    </x-slot>

    <x-slot name="buttons">
        <x-waitt.button wire:click="$dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-waitt.button>

        <form method="POST" action="{{ route('moderator.booths.destroy', $booth) }}" class="pl-2">
            @csrf
            @method('DELETE')
            <x-waitt.button variant="delete" type="submit">
                {{ __('Delete Booth') }}
            </x-waitt.button>
        </form>
    </x-slot>
</x-waitt.livewire-modal>
