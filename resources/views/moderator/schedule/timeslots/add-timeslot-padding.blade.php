<div>
    <x-button wire:click="openModal" type="button"
              class="mt-5 dark:bg-crew-500 bg-crew-500 hover:bg-crew-600 hover:dark:bg-crew-600 active:bg-green-600 active:dark:bg-green-600">
        Continue
    </x-button>

    <x-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ __('Add time between timeslots') }}
        </x-slot>

        <x-slot name="content">
            <h3 class="font-bold text-gray-600 dark:text-gray-200">{{ __('In order to make it possible for participants to change rooms for presentations, they need to have
                enough time to calmly navigate through the building. The default changeover time is 10 minutes. Would you like to change it?') }}</h3>

            <div class="pt-3 col-span-6 sm:col-span-4">
                <x-label for="duration" value="Duration (in minutes)" class="after:content-['*'] after:text-red-500"/>
                <x-input id="duration" name="duration" type="number" value="10"
                         class="mt-1 block w-full focus:border-crew-500 dark:focus:border-crew-600 focus:ring-crew-500 dark:focus:ring-crew-600"/>
                <x-input-error for="duration" class="mt-2"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button>
                {{ __('Cancel') }}
            </x-secondary-button>

            <form>
                <x-button class="ml-3" type="submit">
                    {{ __('Save') }}
                </x-button>
            </form>
        </x-slot>
    </x-dialog-modal>
</div>
