<x-waitt.livewire-modal form-action="{{ is_null($presentationTypeId) ? 'store' : 'update' }}">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        @if(is_null($presentationTypeId))
            Create new presentation type
        @else
            Edit {{ $presentationType->name }}
        @endif
    </x-slot>

    <x-slot name="description" class="dark:bg-gray-800">
        {{ __('Here you can edit details of the presentation type.') }}
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="px-4 py-2 sm:px-0">
            <dl class="sm:grid sm:grid-cols-3 sm:gap-6 items-center">
                <dt class="text-sm font-medium leading-6    text-white">Name</dt>
                <dd class="sm:col-span-2">
                    <input
                        class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                        type="text" maxlength="255" wire:model="name">
                    @error('name') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>
                <dt class="text-sm font-medium leading-6 text-white">Description</dt>
                <dd class="sm:col-span-2">
                    <textarea
                        class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                        required wire:model="description"
                    ></textarea>
                    @error('description') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>
                <dt class="text-sm font-medium leading-6 text-white">Colour</dt>
                <dd class="sm:col-span-2">
                    <select
                        class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                        required wire:model.live="colour">
                        <option value="">Select a colour</option>
                        @foreach ($this->colours as $colour)
                            <option
                                {{ $colour == $this->colour ? 'selected' : '' }} value="{{ $colour }}">{{ ucfirst($colour) }}</option>
                        @endforeach
                    </select>
                    @error('colour') <span class="error text-red-500">{{ $message }}</span> @enderror
                    @if($this->colourUsedBy != '')
                        <span class="font-bold text-orange-400 text-sm w-full">
                        ⚠️ Colour also used by {{ $this->colourUsedBy }}
                        </span>
                    @endif
                @if($this->colour)
                    <dt class="text-sm font-medium leading-6 text-white">Preview</dt>
                    <dd class="sm:col-span-2">
                        <div class="rounded-md h-12 border border-slate-950 bg-gray-900 grid grid-cols-3">
                            <div class="w-full h-full bg-{{lcfirst($this->colour)}}-200 flex justify-center text-center items-center">Sample</div>
                            <div class="w-full h-full bg-{{lcfirst($this->colour)}}-300 flex justify-center text-center items-center">Sample</div>
                            <div class="w-full h-full bg-{{lcfirst($this->colour)}}-400/90 text-{{lcfirst($this->colour)}}-400 flex justify-center text-center items-center">
                                Sample
                            </div>
                        </div>
                    </dd>
                @endif
                <dt class="text-sm font-medium leading-6 text-white">Duration</dt>
                <dd class="sm:col-span-2">
                    <input
                        class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                        type="number" min="10" wire:model.live="duration">
                    @error('duration') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>
                <div class="sm:col-span-3">
                    @if (!is_null($presentationTypeId))
                        @if($this->showWarningMessage())
                            <span class="font-bold text-orange-400 text-sm w-full">
                            ⚠️ Changing the presentation duration will reset all scheduled presentations of this type. You'll need to reschedule them.
                            </span>
                        @endif
                    @endif
                </div>
            </dl>
        </div>
    </x-slot>

    <x-slot name="buttons" class="dark:bg-gray-900">
        <x-waitt.button type="button" wire:click="$dispatch('closeModal')" class="mr-3">
            {{ __('Cancel') }}
        </x-waitt.button>
        <x-waitt.button variant="save" type="submit">
            Save
        </x-waitt.button>
    </x-slot>
</x-waitt.livewire-modal>
