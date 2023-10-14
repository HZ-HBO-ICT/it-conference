<x-action-section>
    <x-slot name="title">
        {{ __('Company details') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Here you can edit the company details you provided.') }}
    </x-slot>

    <x-slot name="content">
        <div class="col-span-6 sm:col-span-4 pb-5">
            <x-label for="name" value="{{ __('Company Name') }}"/>
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="team.name" autofocus/>
            @error('team.name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div class="col-span-6 sm:col-span-4 pb-5">
            <x-label for="description" value="{{ __('Company Description') }}"/>
            <textarea id="description" wire:model="team.description"
                      class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                      name="description" required
            ></textarea>
            @error('team.description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div class="col-span-6 sm:col-span-4 pb-5">
            <x-label for="postcode" value="{{ __('Postcode') }}"/>
            <x-input id="postcode" type="text" class="mt-1 block w-full" wire:model="team.postcode" autofocus/>
            @error('team.description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div class="col-span-6 sm:col-span-4 pb-5">
            <x-label for="house_number" value="{{ __('House Number') }}"/>
            <x-input id="house_number" type="text" class="mt-1 block w-full" wire:model="team.house_number"
                     autofocus/>
            @error('team.house_number') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div class="col-span-6 sm:col-span-4 pb-5">
            <x-label for="street" value="{{ __('Street') }}"/>
            <x-input id="street" type="text" class="mt-1 block w-full" wire:model="team.street" autofocus/>
            @error('team.street') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div class="col-span-6 sm:col-span-4 pb-5">
            <x-label for="city" value="{{ __('City') }}"/>
            <x-input id="city" type="text" class="mt-1 block w-full" wire:model="team.city" autofocus/>
            @error('team.city') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="website" value="{{ __('Website') }}"/>
            <x-input id="website" type="text" class="mt-1 block w-full" wire:model="team.website" autofocus/>
            @error('team.website') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </x-slot>

    <x-slot name="actions">
        @if (session()->has('message'))
            <div class="text-sm text-green-600 pr-5">
                {{ session('message') }}
            </div>
        @endif
        <button wire:click="save"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            Save
        </button>
    </x-slot>
</x-action-section>
