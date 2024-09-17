<x-livewire-modal>
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Reset the schedule
    </x-slot>

    <x-slot name="content" class="w-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200">
        <h3 class="font-bold text-red-600">{{ __('WARNING: this action cannot be undone') }}</h3>
        <p>Are you sure you want to reset the schedule? There are two types of reset
        - full reset or scheduled reset.<br>The full reset removes all scheduled presentations including
        the opening and closing presentation that you created in the beginning.<br>The scheduled presentation reset leaves
        the opening and closing but removes all of the scheduled presentations after them.</p>
    </x-slot>

    <x-slot name="buttons" class="dark:bg-gray-900 border-gray-800">
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
