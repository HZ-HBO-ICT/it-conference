<x-waitt.livewire-modal>
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Publish the programme
    </x-slot>

    <x-slot name="content">
        <h3 class="font-bold text-red-600">{{ __('WARNING: this action cannot be undone') }}</h3>
        <p class="text-white">Are you sure you want to publish the programme? After the programme is published, you will not be able to move the presentations around anymore. The rooms and presentations will stay as definitive. The only possible change in the programme that can be done is the removing of scheduled presentations. </p>
    </x-slot>

    <x-slot name="buttons" class="dark:bg-gray-900 border-gray-800">
        <x-waitt.button wire:click="$dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-waitt.button>

        <form method="POST" action="{{route('moderator.schedule.publish')}}" class="pl-2">
            @csrf
            <x-waitt.button variant="delete" class="ml-3" type="submit">
                {{ __('Publish programme') }}
            </x-waitt.button>
        </form>
    </x-slot>
</x-waitt.livewire-modal>
