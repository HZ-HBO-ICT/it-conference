<x-livewire-modal>
    <x-slot name="title">
        {{$title}}?
    </x-slot>

    <x-slot name="content">
        <h3 class="font-bold text-red-600">{{ __('WARNING: this action cannot be undone') }}</h3>
    </x-slot>

    <x-slot name="buttons">
        <x-secondary-button wire:click="$dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <form method="POST" action="{{ $route }}" class="pl-2">
            @csrf
            @method($method)
            @if($isApproved)
                <x-button class="dark:bg-green-500 bg-green-500 hover:bg-green-600 dark:hover:bg-green-600 active:bg-green-600 dark:active:bg-green-600 ml-3" type="submit">
                    {{ $callToAction ?? $title }}
                </x-button>
            @else
                <x-danger-button class="ml-3" type="submit">
                    {{ $callToAction ?? $title }}
                </x-danger-button>
            @endif
        </form>
    </x-slot>
</x-livewire-modal>
