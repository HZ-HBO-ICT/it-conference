<x-waitt.livewire-modal>
    <x-slot name="title">
        {{$title}}?
    </x-slot>

    <x-slot name="content">
        <h3 class="font-bold text-red-600">{{ __('WARNING: this action cannot be undone') }}</h3>
    </x-slot>

    <x-slot name="buttons">
        <x-waitt.button wire:click="$dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-waitt.button>

        <form method="POST" action="{{ $route }}" class="pl-2">
            @csrf
            @method($method)
            @if($isApproved)
                <x-waitt.button variant="save" type="submit">
                    {{ $callToAction ?? $title }}
                </x-waitt.button>
            @else
                <x-waitt.button variant="delete" class="ml-3" type="submit">
                    {{ $callToAction ?? $title }}
                </x-waitt.button>
            @endif
        </form>
    </x-slot>
</x-waitt.livewire-modal>
