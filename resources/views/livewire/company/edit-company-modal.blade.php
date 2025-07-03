<x-livewire-modal form-action="save">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Edit company
    </x-slot>

    <x-slot name="description" class="dark:bg-gray-800">
        {{ __('Here you can edit the company details.') }}
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="px-4 py-6 sm:px-0">
            <dl class="sm:grid sm:grid-cols-3 sm:gap-6">
                <x-label class="text-sm font-medium leading-6 text-gray-900 dark:text-white" for="name" value="{{ __('Company Name') }}"/>
                <dd class="sm:col-span-2">
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model="form.name"
                             autofocus/>
                    @error('form.name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </dd>
                <x-label class="text-sm font-medium leading-6 text-gray-900 dark:text-white" for="description" value="{{ __('Company Description') }}"/>
                <dd class="sm:col-span-2">
                    <textarea id="description" wire:model="form.description"
                              class="h-20 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xs block mt-1 w-full"
                              name="description" required
                    ></textarea>
                    @error('form.description') <p
                        class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </dd>
                <x-label class="text-sm font-medium leading-6 text-gray-900 dark:text-white" for="postcode" value="{{ __('Company Phone number') }}"/>
                <dd class="sm:col-span-2">
                    <x-input id="phone_number" type="tel" class="mt-1 block w-full" wire:model="form.phone_number"
                             autofocus/>
                    @error('form.phone_number') <p
                        class="mt-2 text-sm text-red-600">Invalid phone number</p> @enderror
                </dd>
                <x-label class="text-sm font-medium leading-6 text-gray-900 dark:text-white" for="postcode" value="{{ __('Company Postcode') }}"/>
                <dd class="sm:col-span-2">
                    <x-input id="postcode" type="text" class="mt-1 block w-full" wire:model="form.postcode"
                             autofocus/>
                    @error('form.description') <p
                        class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </dd>
                <x-label class="text-sm font-medium leading-6 text-gray-900 dark:text-white" for="house_number" value="{{ __('House Number') }}"/>
                <dd class="sm:col-span-2">
                    <x-input id="house_number" type="text" class="mt-1 block w-full"
                             wire:model="form.house_number"
                             autofocus/>
                    @error('form.house_number') <p
                        class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </dd>
                <x-label class="text-sm font-medium leading-6 text-gray-900 dark:text-white" for="street" value="{{ __('Street') }}"/>
                <dd class="sm:col-span-2">
                    <x-input id="street" type="text" class="mt-1 block w-full" wire:model="form.street"
                             autofocus/>
                    @error('form.street') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </dd>
                <x-label class="text-sm font-medium leading-6 text-gray-900 dark:text-white" for="city" value="{{ __('City') }}"/>
                <dd class="sm:col-span-2">
                    <x-input id="city" type="text" class="mt-1 block w-full" wire:model="form.city"
                             autofocus/>
                    @error('form.city') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </dd>
                <x-label class="text-sm font-medium leading-6 text-gray-900 dark:text-white" for="website" value="{{ __('Website') }}"/>
                <dd class="sm:col-span-2">
                    <x-input id="website" type="url" class="mt-1 block w-full" wire:model="form.website"
                             autofocus/>
                    @error('form.website') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </dd>
            </dl>
        </div>
    </x-slot>

    <x-slot name="buttons" class="dark:bg-gray-900">
        <x-secondary-button type="button" wire:click="$dispatch('closeModal')" class="mr-3">
            {{ __('Cancel') }}
        </x-secondary-button>
        <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            Save
        </button>
    </x-slot>
</x-livewire-modal>
