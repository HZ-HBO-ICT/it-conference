<div>
    <form wire:submit.prevent="save">
        <div class="col-span-6 sm:col-span-4 pt-5">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="Title" class="after:content-['*'] after:text-red-500"/>
                <x-input id="name" name="name" type="text" wire:model="presentation.name"
                         class="mt-1 block w-full focus:border-crew-500 dark:focus:border-crew-600 focus:ring-crew-500 dark:focus:ring-crew-600"/>
                <x-input-error for="name" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4 py-4">
                <x-label for="description" value="Description"
                         class="after:content-['*'] after:text-red-500"/>
                <textarea name="description" wire:model="presentation.description"
                          class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-crew-500 dark:focus:border-crew-600 focus:ring-crew-500 dark:focus:ring-crew-600 rounded-md shadow-xs block mt-1 w-full">{{old('description')}}</textarea>
                <x-input-error for="description" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="starting" value="Starting time"
                         class="after:content-['*'] after:text-red-500"/>
                <x-input id="starting" name="starting" type="time" wire:model="starting"
                         class="mt-1 block w-full focus:border-crew-500 dark:focus:border-crew-600 focus:ring-crew-500 dark:focus:ring-crew-600"/>
                <x-input-error for="starting" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4 py-4">
                <x-label for="ending" value="Ending time"
                         class="after:content-['*'] after:text-red-500"/>
                <x-input id="ending" name="ending" type="time" wire:model="ending"
                         class="mt-1 block w-full focus:border-crew-500 dark:focus:border-crew-600 focus:ring-crew-500 dark:focus:ring-crew-600"/>
                <x-input-error for="ending" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="room_id" value="Room"
                         class="after:content-['*'] after:text-red-500"/>
                <select name="room_id" id="room" wire:model="presentation.room_id"
                        class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-crew-500 focus:border-crew-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-crew-500 dark:focus:border-crew-500">
                    @foreach (\App\Models\Room::all() as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>
            <x-button
                class="mt-5 dark:bg-crew-500 bg-crew-500 hover:bg-crew-600 dark:hover:bg-crew-600 active:bg-green-600 dark:active:bg-green-600">
                Save
            </x-button>
        </div>
    </form>
    <x-dialog-modal wire:model="confirmationTimeslotRegeneration">
        <x-slot name="title">
            {{ __('New ending time') }}
        </x-slot>

        <x-slot name="content">
            @if($presentation->type == 'opening')
                <h3 class="font-bold text-red-600">{{ __('WARNING: By extending the end time of the opening presentation, timeslots will overlap. If you proceed, all presentations will need to be rescheduled. Do you want to continue? ') }}</h3>
            @else
                <h3 class="font-bold text-red-600">{{ __('WARNING: You have moved the start time of the closing presentation to an earlier slot, causing an overlap in timeslots. To continue, all presentations will need to be rescheduled. Do you want to continue?') }}</h3>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button>
                {{ __('Cancel') }}
            </x-secondary-button>

            <form wire:submit.prevent="confirmedTimeslotRegeneration">
                <x-danger-button class="ml-3" type="submit">
                    {{ __('Proceed and regenerate timeslots') }}
                </x-danger-button>
            </form>
        </x-slot>
    </x-dialog-modal>
</div>
