<x-waitt.livewire-modal form-action="save">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Edit booth
    </x-slot>

    <x-slot name="description" class="dark:bg-gray-800">
        {{ __('Here you can edit the booth details.') }}
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="px-4 py-6 sm:px-0">
            <dl class="sm:grid sm:grid-cols-3 sm:gap-6">
                <x-waitt.label for="form.width" value="{{ __('Booth width') }}"/>
                <dd class="sm:col-span-2">
                    <input
                        class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                        type="number" min="1" step=".1" wire:model="form.width">
                    @error('form.width') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>
                <x-waitt.label for="form.length" value="{{ __('Booth length') }}"/>
                <dd class="sm:col-span-2">
                    <input
                        class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                        type="number" min="1" step=".1" wire:model="form.length">
                    @error('form.length') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>
                <!-- Presentation Description -->
                <x-waitt.label for="form.additional_information" value="{{ __('Booth additional info') }}"/>
                <dd class="sm:col-span-2">
                <textarea
                    class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                    wire:model="form.additional_information" maxlength="255"></textarea>
                    @error('form.additional_information') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>
            </dl>
        </div>
    </x-slot>

    <x-slot name="buttons" class="dark:bg-gray-900">
        <x-waitt.button type="button" wire:click="$dispatch('closeModal')" class="mr-3">
            {{ __('Cancel') }}
        </x-waitt.button>
        <x-waitt.button type="submit" variant="save">
            Save
        </x-waitt.button>
    </x-slot>
</x-waitt.livewire-modal>
