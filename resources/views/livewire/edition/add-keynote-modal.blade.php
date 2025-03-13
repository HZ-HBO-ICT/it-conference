<x-livewire-modal form-action="save">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Keynote speaker details
    </x-slot>

    <x-slot name="description" class="dark:bg-gray-800">
        {{ __('Here you can edit details of the keynote speaker.') }}
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="px-4 py-6 sm:px-0">
            <dl class="sm:grid sm:grid-cols-3 sm:gap-6 items-center">
                <!-- Keynote speaker Name -->
                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white after:content-['*'] after:text-red-500">Keynote Name</dt>
                <dd class="sm:col-span-2">
                    <input
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xs mt-1 block"
                        type="text" wire:model="form.keynote_name">
                    @error('form.keynote_name') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>

                <!-- Keynote speaker Description -->
                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white after:content-['*'] after:text-red-500">Keynote Description</dt>
                <dd class="sm:col-span-2">
                    <textarea
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xs mt-1 block"
                        wire:model="form.keynote_description"></textarea>
                    @error('form.keynote_description') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>

                <!-- Keynote speaker Photo -->
                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white after:content-['*'] after:text-red-500">Keynote Photo</dt>
                <dd class="sm:col-span-2" x-data="{ photoName: null, photoPreview: null, buttonText: 'Select a new photo'}">
                    @if($edition->keynote_photo_path)
                        <div class="mt-2" x-show="! photoPreview">
                            <img src="{{ url('storage/' . $edition->keynote_photo_path) }}" alt="{{ $edition->keynote_name }}"
                                 class="rounded-full h-20 w-20 object-cover">
                        </div>
                    @endif

                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                              x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <input type="file"
                           wire:model="form.keynote_photo_path" class="hidden"
                           x-ref="keynote_photo_path"
                           x-on:change="
                                    photoName = $refs.keynote_photo_path.files[0].name;
                                    buttonText = photoName;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.keynote_photo_path.files[0]);
                            "
                           accept="image/jpeg, image/png, image/jpg"/>

                    <x-secondary-button class="mt-2 mr-2" type="button" x-on:click="$refs.keynote_photo_path.click()">
                        <span x-text="buttonText"></span>
                    </x-secondary-button>
                    <br>
                    @error('form.keynote_photo_path') <span class="error text-red-500">{{ $message }}</span> @enderror
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
