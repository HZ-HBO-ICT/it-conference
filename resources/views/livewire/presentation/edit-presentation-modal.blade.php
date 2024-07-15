<x-livewire-modal form-action="save">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Edit presentation
    </x-slot>

    <x-slot name="description" class="dark:bg-gray-800">
        {{ __('Here you can edit your presentation details until 12th of October.') }}
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="px-4 py-6 sm:px-0">
            <dl class="sm:grid sm:grid-cols-3 sm:gap-6">
                <!-- Presentation Title -->
                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Presentation Title</dt>
                <dd class="sm:col-span-2">
                    <input
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block"
                        type="text" maxlength="255" wire:model="form.name">
                    @error('form.name') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>

                <!-- Presentation Description -->
                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Presentation Description</dt>
                <dd class="sm:col-span-2">
                <textarea
                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1"
                    wire:model="form.description" maxlength="300"></textarea>
                    @error('form.description') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>

                <!-- Presentation Type -->
                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Presentation Type</dt>
                <dd class="sm:col-span-2">
                    <select wire:model="form.type"
                            class="mt-1 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        <option value="lecture">Lecture ({{\App\Models\Presentation::lectureDuration()}} minutes)</option>
                        <option value="workshop">Workshop ({{\App\Models\Presentation::workshopDuration()}} minutes)</option>
                    </select>
                    @error('form.type') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>

                <!-- Difficulty Level -->
                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Difficulty Level</dt>
                <dd class="sm:col-span-2">
                    <select wire:model="form.difficulty_id"
                            class="mt-1 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        @foreach(App\Models\Difficulty::all() as $difficulty)
                            <option value="{{$difficulty->id}}">{{ucfirst($difficulty->level)}}</option>
                        @endforeach
                    </select>
                    @error('form.difficulty_id') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>

                <!-- Suggested Max Participants -->
                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Suggested Max Participants</dt>
                <dd class="sm:col-span-2">
                    <input
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1"
                        type="number" wire:model="form.max_participants">
                    @error('form.max_participants') <span class="error text-red-500">{{ $message }}</span> @enderror
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
