<x-livewire-modal>
    <x-slot name="title">
        Delete FAQ
    </x-slot>

    <x-slot name="content">
        <h3 class="font-bold text-red-600">{{ __('WARNING: this action cannot be undone') }}</h3>
        {{ __('Are you sure you want to delete this FAQ?') }}
    </x-slot>

    <x-slot name="buttons">
        <x-secondary-button wire:click="$dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <form method="POST" action="{{ route('moderator.faqs.destroy', $faq) }}" class="pl-2">
            @csrf
            @method('DELETE')
            <x-danger-button class="ml-3" type="submit">
                {{ __('Delete FAQ') }}
            </x-danger-button>
        </form>
    </x-slot>
</x-livewire-modal>
