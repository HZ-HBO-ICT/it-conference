<x-waitt.livewire-modal form-action="save">
    <x-slot name="title">
        Edit company
    </x-slot>

    <x-slot name="description">
        {{ __('Here you can edit the company details.') }}
    </x-slot>

    <x-slot name="content">
        <div class="px-4 py-6 sm:px-0">
            <dl class="sm:grid sm:grid-cols-3 sm:gap-6">
                <x-waitt.label for="name" value="{{ __('Company Name') }}"/>
                <dd class="sm:col-span-2">
                    <x-waitt.input id="name" type="text" class="mt-1 block w-full" wire:model="form.name"
                             autofocus/>
                    @error('form.name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </dd>
                <x-waitt.label for="description" value="{{ __('Company Description') }}"/>
                <dd class="sm:col-span-2">
                    <x-waitt.input-textarea id="description" wire:model="form.description"
                              class="h-20 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xs block mt-1 w-full"
                              name="description" required
                    ></x-waitt.input-textarea>
                    @error('form.description') <p
                        class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </dd>
                <x-waitt.label for="postcode" value="{{ __('Company Phone number') }}"/>
                <dd class="sm:col-span-2">
                    <x-waitt.input id="phone_number" type="tel" class="mt-1 block w-full" wire:model="form.phone_number"
                             autofocus/>
                    @error('form.phone_number') <p
                        class="mt-2 text-sm text-red-600">Invalid phone number</p> @enderror
                </dd>
                <x-waitt.label for="postcode" value="{{ __('Company Postcode') }}"/>
                <dd class="sm:col-span-2">
                    <x-waitt.input id="postcode" type="text" class="mt-1 block w-full" wire:model="form.postcode"
                             autofocus/>
                    @error('form.description') <p
                        class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </dd>
                <x-waitt.label for="house_number" value="{{ __('House Number') }}"/>
                <dd class="sm:col-span-2">
                    <x-waitt.input id="house_number" type="text" class="mt-1 block w-full"
                             wire:model="form.house_number"
                             autofocus/>
                    @error('form.house_number') <p
                        class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </dd>
                <x-waitt.label for="street" value="{{ __('Street') }}"/>
                <dd class="sm:col-span-2">
                    <x-waitt.input id="street" type="text" class="mt-1 block w-full" wire:model="form.street"
                             autofocus/>
                    @error('form.street') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </dd>
                <x-waitt.label for="city" value="{{ __('City') }}"/>
                <dd class="sm:col-span-2">
                    <x-waitt.input id="city" type="text" class="mt-1 block w-full" wire:model="form.city"
                             autofocus/>
                    @error('form.city') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </dd>
                <x-waitt.label for="website" value="{{ __('Website') }}"/>
                <dd class="sm:col-span-2">
                    <x-waitt.input id="website" type="url" class="mt-1 block w-full" wire:model="form.website"
                             autofocus/>
                    @error('form.website') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </dd>
            </dl>
        </div>
    </x-slot>

    <x-slot name="buttons">
        <x-waitt.button type="button" wire:click="$dispatch('closeModal')" class="mr-3">
            {{ __('Cancel') }}
        </x-waitt.button>
        <x-waitt.button type="submit" variant="save">
            Save
        </x-waitt.button>
    </x-slot>
</x-waitt.livewire-modal>
