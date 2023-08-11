<x-form-section submit="updateTeamName">
    <x-slot name="title">
        {{ __('Team Details') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The team\'s details and owner information.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Team Owner Information -->
        <div class="col-span-6">
            <x-label value="{{ __('Team Owner') }}" />

            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $team->owner->profile_photo_url }}" alt="{{ $team->owner->name }}">

                <div class="ml-4 leading-tight">
                    <div class="text-gray-900 dark:text-white">{{ $team->owner->name }}</div>
                    <div class="text-gray-700 dark:text-gray-300 text-sm">{{ $team->owner->email }}</div>
                </div>
            </div>
        </div>

        <!-- Team Name input -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Team Name') }}" class="after:content-['*'] after:text-red-500" />

            <x-input id="name"
                        type="text"
                        class="mt-1 block w-full"
                        wire:model.defer="state.name"
                        :disabled="! Gate::check('update', $team)" />

            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Team Description input -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="description" value="{{ __('Team Description') }}" class="after:content-['*'] after:text-red-500" />

            <x-input id="description"
                     type="text"
                     class="mt-1 block w-full"
                     wire:model.defer="state.description"
                     :disabled="! Gate::check('update', $team)" />

            <x-input-error for="description" class="mt-2" />
        </div>

        <!-- Team Website input -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="website" value="{{ __('Team Website') }}" class="after:content-['*'] after:text-red-500" />

            <x-input id="website"
                     type="text"
                     class="mt-1 block w-full"
                     wire:model.defer="state.website"
                     :disabled="! Gate::check('update', $team)" />

            <x-input-error for="website" class="mt-2" />
        </div>

        <!-- Team Address input -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="address" value="{{ __('Team Address') }}" class="after:content-['*'] after:text-red-500" />

            <x-input id="address"
                     type="text"
                     class="mt-1 block w-full"
                     wire:model.defer="state.address"
                     :disabled="! Gate::check('update', $team)" />

            <x-input-error for="address" class="mt-2" />
        </div>
    </x-slot>

    @if (Gate::check('update', $team))
        <x-slot name="actions">
            <x-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-button>
                {{ __('Save') }}
            </x-button>
        </x-slot>
    @endif
</x-form-section>
