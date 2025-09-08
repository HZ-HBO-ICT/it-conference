<x-waitt.livewire-modal>
    <x-slot name="title">
        Delete FAQ
    </x-slot>

    <x-slot name="content">
        <h3 class="font-bold text-red-600">{{ __('WARNING: this action cannot be undone') }}</h3>
        <div class="text-white">
            {{ __('Are you sure you want to delete this FAQ?') }}
        </div>
    </x-slot>

    <x-slot name="buttons">
        <x-waitt.button wire:click="$dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-waitt.button>

        <form method="POST" action="{{ route('moderator.faqs.destroy', $faq) }}" class="pl-2">
            @csrf
            @method('DELETE')
            <x-waitt.button variant="delete" class="ml-3" type="submit">
                {{ __('Delete FAQ') }}
            </x-waitt.button>
        </form>
    </x-slot>
</x-waitt.livewire-modal>
