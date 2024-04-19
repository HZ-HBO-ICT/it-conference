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
        <div class="bg-white p-4 rounded shadow-lg dark:bg-gray-900">
            <div class="p-5">
                <x-action-section>
                    <x-slot name="title">
                        {{ __('Edit presentation') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Here you can edit your presentation details until 12th of October.') }}
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Presentation title
                            </dt>
                            <div style="grid-column: span 2;">
                                <input
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                    type="text" wire:model="form.name">
                                @error('form.name') <span class="error text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Presentation
                                                                                                    description
                            </dt>
                            <div style="grid-column: span 2;">
                                <textarea
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                    type="text" wire:model="form.description"></textarea>
                                @error('form.description') <span
                                    class="error text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Presentation type
                            </dt>
                            <div style="grid-column: span 2;">
                                <select
                                    wire:model="form.type"
                                    style="grid-column: span 2;"
                                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                    <option value="lecture">Lecture (30 minutes)</option>
                                    <option value="workshop">Workshop (90 minutes)</option>
                                </select>
                                @error('form.type') <span class="error text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Difficulty level
                            </dt>
                            <div style="grid-column: span 2;">
                                <select
                                    wire:model="form.difficulty_id"
                                    style="grid-column: span 2;"
                                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                    @foreach(App\Models\Difficulty::all() as $difficulty)
                                        <option value="{{$difficulty->id}}">{{ucfirst($difficulty->level)}}</option>
                                    @endforeach
                                </select>
                                @error('form.difficulty_id') <span
                                    class="error text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Suggested max
                                                                                                    participants
                            </dt>
                            <div style="grid-column: span 2;">
                                <input
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                    type="number" wire:model="form.max_participants">
                                @error('form.max_participants') <span
                                    class="error text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="px-4 py-6 flex sm:gap-4 sm:px-0">
                            <button wire:click="save"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Save
                            </button>
                            <button @click="open = false"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Cancel
                            </button>
                        </div>
                    </x-slot>
                </x-action-section>
            </div>
        </div>
    </div>
</div>
