<x-livewire-modal>
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        <div>Edit {{$presentation->name}} scheduling details</div>
        <div class="text-sm pt-1 text-gray-600 dark:text-gray-200">Searching for other details for the presentation?
            <a href="{{route('moderator.presentations.show', $presentation)}}" class="underline text-crew-600 bg:text-crew-700">Click here!</a>
        </div>
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="text-red-500">
            {{$errorMessage}}
        </div>
        <div class="px-4 py-4 sm:px-0">
            <dl class="sm:grid sm:grid-cols-3 sm:gap-6">
                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Presentation room</dt>
                <dd class="sm:col-span-2">
                    <select name="type"
                            wire:model="room_id"
                            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-crew-500 focus:border-crew-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-crew-500 dark:focus:border-crew-500">
                        @foreach($rooms as $room)
                            <option
                                value="{{$room->id}}"> {{$room->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('room_id') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>
                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Presentation starting time</dt>
                <dd class="sm:col-span-2">
                    <!-- TODO: Once metatable exist fix the min max -->
                    <input
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-crew-500 dark:focus:border-crew-600 focus:ring-crew-500 dark:focus:ring-crew-600 rounded-md shadow-sm mt-1 block"
                        type="time" min="8:00" max="18:00" wire:model="start" value={{$presentation->start}}>
                    @error('start') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>
            </dl>
        </div>
    </x-slot>

    <x-slot name="buttons" class="dark:bg-gray-900">
        <x-secondary-button type="button" wire:click="$dispatch('closeModal')" class="mr-3">
            {{ __('Cancel') }}
        </x-secondary-button>
        <button wire:click="remove"
                class="mr-3 inline-flex items-center px-4 py-2 bg-red-800 dark:bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 dark:hover:bg-red-800 focus:bg-red-700 dark:focus:bg-red-800 active:bg-red-900 dark:active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-crew-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            Remove
        </button>
        <button wire:click="save"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-crew-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            Save
        </button>
    </x-slot>
</x-livewire-modal>
