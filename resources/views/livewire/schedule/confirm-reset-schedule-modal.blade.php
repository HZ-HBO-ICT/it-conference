<x-livewire-modal>
    <x-slot name="title">
        Reset the schedule
    </x-slot>

    <x-slot name="content">
        <h3 class="font-bold text-red-600">{{ __('WARNING: this action cannot be undone') }}</h3>
        <p>Are you sure you want to reset the schedule? There are two types of reset
        - full reset or scheduled reset.<br>The full reset removes all scheduled presentations including
        the opening and closing presentation that you created in the beginning.<br>The scheduled presentation reset leaves
        the opening and closing but removes all of the scheduled presentations after them.</p>
    </x-slot>

    <x-slot name="buttons">
        <x-secondary-button wire:click="$dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <form method="POST" action="{{route('moderator.schedule.reset', 'full')}}" class="pl-2">
            @csrf
            <x-danger-button class="ml-3" type="submit">
                {{ __('Full Reset') }}
            </x-danger-button>
        </form>
        <form method="POST" action="{{route('moderator.schedule.reset', 'scheduled')}}" class="pl-2">
            @csrf
            <x-danger-button class="ml-3" type="submit">
                {{ __('Scheduled Reset') }}
            </x-danger-button>
        </form>
    </x-slot>
</x-livewire-modal>
