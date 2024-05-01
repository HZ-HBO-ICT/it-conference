<x-livewire-modal form-action="save">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Edit edition
    </x-slot>

    <x-slot name="description" class="dark:bg-gray-800">
        {{ __('Here you can edit details of the edition.') }}
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="px-4 py-6 sm:px-0">
            <dl class="sm:grid sm:grid-cols-3 sm:gap-6">
                <!-- Edition Name -->
                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Edition Name</dt>
                <dd class="sm:col-span-2">
                    <input
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block"
                        type="text" wire:model="form.name">
                    @error('form.name') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>

                <!-- Edition State -->
                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Edition State</dt>
                <dd class="sm:col-span-2">
                    <select wire:model="form.state"
                            class="mt-1 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        <option value="10">Design</option>
                        <option value="20">Registration opened</option>
                        <option value="30">Final programme released</option>
                        <option value="40">Currently being executed</option>
                        <option value="50">Archived</option>
                    </select>
                    @error('form.state') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>

                <!-- Edition Start Date -->
                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Edition Start Date</dt>
                <dd class="sm:col-span-2">
                    <input
                        type="datetime-local"
{{--                        min="2018-06-07T00:00"--}}
{{--                        max="2030-06-14T00:00"--}}
                        wire:model="form.start_at"
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block"
                    />
                    @error('form.start_at') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>

                <!-- Edition End Date -->
                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Edition End Date</dt>
                <dd class="sm:col-span-2">
                    <input
                        type="datetime-local"
{{--                        min="2018-06-07T00:00"--}}
{{--                        max="2030-06-14T00:00"--}}
                        wire:model="form.end_at"
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block"
                    />
                    @error('form.end_at') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>
            </dl>
        </div>
    </x-slot>

    <x-slot name="buttons" class="dark:bg-gray-900">
        <x-secondary-button type="button" wire:click="$dispatch('closeModal')" class="mr-3">
            {{ __('Cancel') }}
        </x-secondary-button>
        <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            Save
        </button>
    </x-slot>
</x-livewire-modal>
