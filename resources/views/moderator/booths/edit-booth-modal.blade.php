<div x-data="{ open: @entangle('isOpen') }" class="w-full h-full">
    <button
        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
        @click="open = true">
        <span class="flex items-center h-full justify-center">Edit</span>
    </button>

    <div
        x-cloak
        x-show="open"
        x-transition:enter="transition-opacity ease-out duration-400"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 flex items-center justify-center z-50 bg-opacity-75 bg-gray-900 dark:bg-opacity-75 dark:bg-gray-800 dark:text-gray-200"
    >
        <div class="bg-white p-4 rounded shadow-lg dark:bg-gray-900 text-left">
            <div class="p-5">
                <x-action-section>
                    <x-slot name="title">
                        {{ __('Booth details') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Here you can edit the booth details') }}
                    </x-slot>

                    <x-slot name="content">
                        <div class="col-span-6 sm:col-span-4 pb-5">
                            <x-label for="width" value="{{ __('Width') }}"/>
                            <x-input id="width" type="number" class="mt-1 block w-full" wire:model="booth.width"
                                     autofocus/>
                            @error('booth.width') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-4 pb-5">
                            <x-label for="length" value="{{ __('Length') }}"/>
                            <x-input id="length" type="number" class="mt-1 block w-full" wire:model="booth.length"
                                     autofocus/>
                            @error('booth.length') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-4 pb-5">
                            <x-label for="additional_information" value="{{ __('Additional info') }}"/>
                            <textarea id="additional_information" wire:model="booth.additional_information"
                                      class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                                      name="additional_information" required
                            ></textarea>
                            @error('booth.additional_information') <p
                                class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </x-slot>

                    <x-slot name="actions">
                        @if (session()->has('message'))
                            <div class="text-sm text-green-600 pr-5">
                                {{ session('message') }}
                            </div>
                        @endif
                        <button wire:click="save"
                                class="inline-flex items-center px-4 mr-2 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Save
                        </button>
                        <button @click="open = false"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Cancel
                        </button>
                    </x-slot>
                </x-action-section>
            </div>
        </div>
    </div>
</div>
