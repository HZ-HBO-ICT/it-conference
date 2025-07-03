<x-livewire-modal form-action="save">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Assign crew team to {{$user->name}}
    </x-slot>

    <x-slot name="description" class="dark:bg-gray-800">
        {{ __('Assign team to the crew member. This way they will receive email notifications only for feedback related to their team.') }}
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div>
            <x-label for="crew_team" class="after:content-['*'] after:text-red-500"
                     value="{{ __('Choose team') }}"></x-label>
            <select wire:model="crew_team" name="crew_team"
                    class="mt-1 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                <option value="" {{ is_null($crew_team) ? 'selected' : '' }}>Choose team here</option>
                <option value="organization" {{ $crew_team == 'organization' ? 'selected' : '' }}>Organization</option>
                <option value="website" {{ $crew_team == 'website' ? 'selected' : '' }}>Website</option>
            </select>
            @error('crew_team') <span class="error text-red-500">{{ $message }}</span> @enderror
        </div>
    </x-slot>
    <x-slot name="buttons" class="dark:bg-gray-900">
        @if($user->crew_team)
            <button type="button" wire:click="removeTeam"
                    class="mr-3 inline-flex items-center px-4 py-2 bg-red-800 dark:bg-red-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-red-800 uppercase tracking-widest hover:bg-red-700 dark:hover:bg-white focus:bg-red-700 dark:focus:bg-red active:bg-red-900 dark:active:bg-red-300 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Remove role
            </button>
        @endif
        <x-secondary-button type="button" wire:click="$dispatch('closeModal')" class="mr-3">
            {{ __('Cancel') }}
        </x-secondary-button>
        <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            Save
        </button>
    </x-slot>
</x-livewire-modal>
