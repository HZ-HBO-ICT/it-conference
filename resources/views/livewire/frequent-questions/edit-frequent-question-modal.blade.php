<x-waitt.livewire-modal form-action="save">
    <x-slot name="title">
        Edit FAQ
    </x-slot>

    <x-slot name="description" class="dark:bg-gray-800">
        {{ __('Here you can edit the FAQ details.') }}
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="px-4 py-6 sm:px-0">
            <dl class="sm:grid sm:grid-cols-3 sm:gap-6">
                <dt class="text-sm font-medium leading-6 text-white">Question</dt>
                <dd class="sm:col-span-2">
                    <input
                        class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                        type="text" maxlength="255" wire:model="form.question">
                    @error('form.question') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>
                <dt class="text-sm font-medium leading-6 text-white">Answer</dt>
                <dd class="sm:col-span-2">
                    <x-markdown-editor wire:model="form.answer"/>
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
