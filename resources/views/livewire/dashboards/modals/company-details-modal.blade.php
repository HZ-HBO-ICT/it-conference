<x-waitt.modal form-action="save" wire:key="{{ $company->id }}">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Company Settings
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="relative md:col-span-2 border border-gray-700 rounded-lg p-6 space-y-4">
                <span
                    class="absolute -top-3 left-3 px-2 py-0.5 text-xs font-semibold uppercase tracking-wide
                           bg-gray-900 text-gray-400 rounded">
                    Details
                </span>

                <div>
                    <x-waitt.label for="name" value="Name"/>
                    <x-waitt.input id="name" type="text" class="mt-1 block w-full"
                                   wire:model.defer="form.name"/>
                    @error('form.name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <x-waitt.label for="description" value="Description"/>
                    <x-waitt.input-textarea id="description" class="mt-1 block w-full"
                                            wire:model.defer="form.description"/>
                    @error('form.description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <x-waitt.label for="website" value="Website"/>
                        <x-waitt.input id="website" type="text" class="mt-1 block w-full"
                                       wire:model.defer="form.website"/>
                        @error('form.website') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <x-waitt.label for="phone_number" value="Phone Number"/>
                        <x-waitt.input id="phone_number" type="text" class="mt-1 block w-full"
                                       wire:model.defer="form.phone_number"/>
                        @error('form.phone_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <x-waitt.label for="postcode" value="Postcode"/>
                        <x-waitt.input id="postcode" type="text" class="mt-1 block w-full"
                                       wire:model.defer="form.postcode"/>
                        @error('form.postcode') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <x-waitt.label for="house_number" value="House Number"/>
                        <x-waitt.input id="house_number" type="text" class="mt-1 block w-full"
                                       wire:model.defer="form.house_number"/>
                        @error('form.house_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <x-waitt.label for="street" value="Street"/>
                        <x-waitt.input id="street" type="text" class="mt-1 block w-full"
                                       wire:model.defer="form.street"/>
                        @error('form.street') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <x-waitt.label for="city" value="City"/>
                        <x-waitt.input id="city" type="text" class="mt-1 block w-full"
                                       wire:model.defer="form.city"/>
                        @error('form.city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="relative flex flex-col justify-between items-center space-y-4 border border-gray-700 rounded-lg p-6 h-full">
                <span
                    class="absolute -top-3 left-3 px-2 py-0.5 text-xs font-semibold uppercase tracking-wide
                           bg-gray-900 text-gray-400 rounded">
                    Logo
                </span>
                <div class="h-full flex flex-col gap-3 items-center justify-center w-full">
                    <div class="w-full">
                        <x-waitt.label for="logo" value="Logo preview" class="text-left" />
                    </div>
                    <div class="h-32 w-full bg-gray-700 object-contain rounded overflow-hidden flex items-center justify-center">
                        @if($company->logo_path && !$photo)
                            <img src="{{ url('storage/'.$company->logo_path) }}"
                                 alt="Logo" class="object-contain max-h-full max-w-full">
                        @elseif ($photo && in_array($photo->getMimeType(), config('livewire.temporary_file_upload.preview_mimes')))
                            <img alt="Preview" src="{{ $photo->temporaryUrl() }}" class="object-contain max-h-full max-w-full">
                        @else
                            <p class="text-gray-400">No logo uploaded</p>
                        @endif
                    </div>
                        <div class="w-full">
                            <label class="block w-full cursor-pointer">
                                @if($photo)
                                    <div class="py-2">
                                        <button type="submit" class="flex items-center hover:cursor-pointer justify-center w-full h-12 bg-gray-900 text-teal-600 text-sm rounded-lg border border-teal-600 hover:bg-gray-700 transition">
                                            Save
                                        </button>
                                    </div>
                                @endif
                                <input
                                    type="file"
                                    id="logo"
                                    accept="image/*"
                                    wire:model="photo"
                                    class="sr-only"/>
                                <div class="flex items-center justify-center w-full h-12 bg-gray-900 text-gray-300 text-sm rounded-lg border border-gray-600 hover:bg-gray-700 transition">
                                    Choose File
                                </div>
                            </label>

                            @error('photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="buttons">
        <div wire:dirty>
            @can('update', $company)
                <x-waitt.button type="button" wire:click="cancel">Cancel</x-waitt.button>
                <x-waitt.button type="submit" variant="save">Save</x-waitt.button>
            @endcan
        </div>
    </x-slot>
</x-waitt.modal>
