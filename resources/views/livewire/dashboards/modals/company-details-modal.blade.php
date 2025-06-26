<x-spa-livewire-modal form-action="save" wire:key="{{ $company->id }}">
    {{-- ─────── Title ─────── --}}
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Company Settings
    </x-slot>

    {{-- ─────── Content ─────── --}}
    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- ========= DETAILS CARD ========= --}}
            <div class="relative md:col-span-2 border border-gray-700 rounded-lg p-6 space-y-4">
                {{-- badge --}}
                <span
                    class="absolute -top-3 left-3 px-2 py-0.5 text-xs font-semibold uppercase tracking-wide
                           bg-gray-800 text-gray-400 rounded">
                    Details
                </span>

                {{-- Name --}}
                <div>
                    <x-waitt.label for="name" value="Name"/>
                    @if($editing)
                        <x-waitt.input id="name" type="text" class="mt-1 block w-full"
                                       wire:model.defer="form.name"/>
                        @error('form.name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    @else
                        <p class="mt-1 text-gray-300">{{ $form->name }}</p>
                    @endif
                </div>

                {{-- Description --}}
                <div>
                    <x-waitt.label for="description" value="Description"/>
                    @if($editing)
                        <x-input-textarea id="description" class="mt-1 block w-full"
                                          wire:model.defer="form.description"/>
                        @error('form.description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    @else
                        <p class="mt-1 text-gray-300">{{ $form->description }}</p>
                    @endif
                </div>

                {{-- Website & Phone --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <x-waitt.label for="website" value="Website"/>
                        @if($editing)
                            <x-waitt.input id="website" type="text" class="mt-1 block w-full"
                                           wire:model.defer="form.website"/>
                            @error('form.website') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        @else
                            <p class="mt-1 text-gray-300">{{ $form->website }}</p>
                        @endif
                    </div>

                    <div>
                        <x-waitt.label for="phone_number" value="Phone Number"/>
                        @if($editing)
                            <x-waitt.input id="phone_number" type="text" class="mt-1 block w-full"
                                           wire:model.defer="form.phone_number"/>
                            @error('form.phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        @else
                            <p class="mt-1 text-gray-300">{{ $form->phone_number }}</p>
                        @endif
                    </div>
                </div>

                {{-- Address block --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <x-waitt.label for="postcode" value="Postcode"/>
                        @if($editing)
                            <x-waitt.input id="postcode" type="text" class="mt-1 block w-full"
                                           wire:model.defer="form.postcode"/>
                            @error('form.postcode') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        @else
                            <p class="mt-1 text-gray-300">{{ $form->postcode }}</p>
                        @endif
                    </div>

                    <div>
                        <x-waitt.label for="house_number" value="House Number"/>
                        @if($editing)
                            <x-waitt.input id="house_number" type="text" class="mt-1 block w-full"
                                           wire:model.defer="form.house_number"/>
                            @error('form.house_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        @else
                            <p class="mt-1 text-gray-300">{{ $form->house_number }}</p>
                        @endif
                    </div>

                    <div>
                        <x-waitt.label for="street" value="Street"/>
                        @if($editing)
                            <x-waitt.input id="street" type="text" class="mt-1 block w-full"
                                           wire:model.defer="form.street"/>
                            @error('form.street') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        @else
                            <p class="mt-1 text-gray-300">{{ $form->street }}</p>
                        @endif
                    </div>

                    <div>
                        <x-waitt.label for="city" value="City"/>
                        @if($editing)
                            <x-waitt.input id="city" type="text" class="mt-1 block w-full"
                                           wire:model.defer="form.city"/>
                            @error('form.city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        @else
                            <p class="mt-1 text-gray-300">{{ $form->city }}</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ========= LOGO CARD ========= --}}
            <div class="relative flex flex-col items-center space-y-4 border border-gray-700 rounded-lg p-6">
                {{-- badge --}}
                <span
                    class="absolute -top-3 left-3 px-2 py-0.5 text-xs font-semibold uppercase tracking-wide
                           bg-gray-800 text-gray-400 rounded">
                    Logo
                </span>

                <div class="w-32 h-32 bg-gray-700 rounded-full overflow-hidden flex items-center justify-center">
                    @if($company->logo_path)
                        <img src="{{ url('storage/'.$company->logo_path) }}"
                             alt="Logo" class="object-cover w-full h-full">
                    @else
                        <span class="text-gray-400 text-sm">No Logo</span>
                    @endif
                </div>

                @if($editing)
                    <div class="w-full">
                        <x-waitt.label for="logo" value="Upload Logo"/>
                        <input
                            type="file"
                            id="logo"
                            wire:model="form.logo"
                            class="block w-full text-sm text-gray-300 bg-gray-800 border border-gray-600
                                   rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded
                                   file:border-0 file:text-sm file:bg-indigo-600 file:text-white
                                   hover:file:bg-indigo-500"/>
                        @error('form.logo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                @endif
            </div>
        </div>
    </x-slot>

    {{-- ─────── Buttons ─────── --}}
    <x-slot name="buttons">
        @if($editing)
            <x-button wire:click="$set('editing', false)">Cancel</x-button>
            <x-button type="submit">Save</x-button>
        @else
            <x-button wire:click="$set('editing', true)">Edit</x-button>
        @endif
    </x-slot>
</x-spa-livewire-modal>
