<x-livewire-modal form-action="save">
    <x-slot name="title" class="bg-waitt-dark border-gray-600">
        <h3 class="text-lg leading-6 font-medium text-white">
            Edit room
        </h3>
    </x-slot>

    <x-slot name="description" class="bg-waitt-dark">
        <p class="text-gray-300 text-sm">{{ __('Here you can edit the room details.') }}</p>
    </x-slot>

    <x-slot name="content" class="w-full bg-waitt-dark">
        <div class="px-4 py-6 sm:px-0">
            <dl class="sm:grid sm:grid-cols-3 sm:gap-6">
                <dt class="text-sm font-medium leading-6 text-white">Room name</dt>
                <dd class="sm:col-span-2">
                    <input
                        class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                        type="text" maxlength="255" wire:model="form.name">
                    @error('form.name') 
                        <span class="error text-red-400 text-sm mt-1">{{ $message }}</span> 
                    @enderror
                </dd>
                <dt class="text-sm font-medium leading-6 text-white">Room maximum capacity/participants</dt>
                <dd class="sm:col-span-2">
                    <input
                        class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                        type="number" wire:model="form.max_participants" min="1" max="999">
                    @error('form.max_participants') 
                        <span class="error text-red-400 text-sm mt-1">{{ $message }}</span> 
                    @enderror
                </dd>
            </dl>
        </div>
    </x-slot>

    <x-slot name="buttons" class="bg-waitt-dark">
        <button type="button" wire:click="$dispatch('closeModal')" 
                class="mr-3 px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-bold rounded-lg shadow transition">
            {{ __('Cancel') }}
        </button>
        <button type="submit"
                class="px-4 py-2 bg-waitt-pink-500 hover:bg-waitt-pink-600 text-white font-bold rounded-lg shadow transition">
            Save
        </button>
    </x-slot>
</x-livewire-modal>
