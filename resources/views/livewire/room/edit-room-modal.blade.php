<x-waitt.livewire-modal form-action="save">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Edit room
    </x-slot>

    <x-slot name="description" class="dark:bg-gray-800">
        {{ __('Here you can edit the room details.') }}
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="px-4 py-6 sm:px-0">
            <dl class="sm:grid sm:grid-cols-3 sm:gap-6">
                <dt class="text-sm font-medium leading-6 text-white">Room name</dt>
                <dd class="sm:col-span-2">
                    <input
                        class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                        type="text" maxlength="255" wire:model="form.name">
                    @error('form.name') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>
                <dt class="text-sm font-medium leading-6 text-white">Room maximum capacity/participants</dt>
                <dd class="sm:col-span-2">
                    <input
                        class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                        type="number" wire:model="form.max_participants" min="1" max="999">
                    @error('form.max_participants') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>
            </dl>
        </div>
    </x-slot>

    <x-slot name="buttons" class="dark:bg-gray-900">
        <x-waitt.button type="button" wire:click="$dispatch('closeModal')" variant="delete" class="mr-3">
            {{ __('Cancel') }}
        </x-waitt.button>
        <x-waitt.button variant="save" type="submit">
            Save
        </x-waitt.button>
    </x-slot>
</x-waitt.livewire-modal>
