<x-waitt.livewire-modal>
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        {{ $message }}
    </x-slot>

    <x-slot name="content" class="text-white">
        @if($user)
            <div class="flex flex-col">
                <div>
                    Name: <span class="text-{{ $user->role_colour }}-600 dark:text-{{ $user->role_colour }}-200">{{ $user->name }}</span>
                </div>
                <div>
                    Role: <span class="text-{{ $user->role_colour }}-600 dark:text-{{ $user->role_colour }}-200 capitalize">{{ $user->role_colour }}</span>
                </div>

                @if($presentation)
                    <div>
                        Room: <span class="text-{{ $user->role_colour }}-600 dark:text-{{ $user->role_colour }}-200 capitalize">{{ $presentation->room->name }}</span>
                    </div>
                    <div>
                        Presentation: <span class="text-{{ $user->role_colour }}-600 dark:text-{{ $user->role_colour }}-200 capitalize">{{ $presentation->name }}</span>
                    </div>
                @endif
            </div>
        @else
            {{ __('Please scan a correct ticket') }}
        @endif
    </x-slot>

    <x-slot name="buttons">
        <x-waitt.button variant="save" wire:click="$dispatch('closeModal')">
            {{ __('Ok') }}
        </x-waitt.button>
    </x-slot>
</x-waitt.livewire-modal>
