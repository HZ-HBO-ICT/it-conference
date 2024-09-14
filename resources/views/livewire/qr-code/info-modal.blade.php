<x-livewire-modal>
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800 text-{{ $color }}-300">
        {{ $message }}
    </x-slot>

    <x-slot name="content">
        @if($user)
            <div class="flex flex-col">
                <div>
                    Name: <span class="text-{{ $user->role_colour }}-600 dark:text-{{ $user->role_colour }}-200">{{ $user->name }}</span>
                </div>
                <div>
                    Role: <span class="text-{{ $user->role_colour }}-600 dark:text-{{ $user->role_colour }}-200 capitalize">{{ $user->role_colour }}</span>
                </div>
            </div>
        @else
            Please scan a correct ticket.
        @endif
    </x-slot>

    <x-slot name="buttons">
        <x-secondary-button wire:click="$dispatch('closeModal')">
            {{ __('Ok') }}
        </x-secondary-button>
    </x-slot>
</x-livewire-modal>
