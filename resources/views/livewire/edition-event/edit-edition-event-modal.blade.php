<x-waitt.livewire-modal form-action="save">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        {{ $editionEvent->event->name }}
    </x-slot>

    <x-slot name="description" class="dark:bg-gray-800">
        {{ __('Here you can edit details of the event.') }}
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="px-4 py-6 sm:px-0">
            <dl class="sm:grid sm:grid-cols-3 sm:gap-6 items-center">
                <!-- Event Start Date -->
                <dt class="text-sm font-medium leading-6 text-white">Event Start Date</dt>
                <dd class="sm:col-span-2">
                    <input
                        type="date"
                        id="start_at"
                        max="{{ $editionEvent->end_at }}"
                        wire:model="form.start_at"
                        class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                    />
                    @error('form.start_at') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>

                <!-- Event End Date -->
                <dt class="text-sm font-medium leading-6 text-white">Event End Date</dt>
                <dd class="sm:col-span-2">
                    <input
                        type="date"
                        id="end_at"
                        min="{{ $editionEvent->start_at }}"
                        max="@if($edition->start_at) {{ $edition->start_at->format('Y-m-d') }} @endif"
                        wire:model="form.end_at"
                        class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                    />
                    @error('form.end_at') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>
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

@script
    <script>
        const startAt = document.getElementById('start_at');
        const endAt = document.getElementById('end_at');
        startAt.max = endAt.value;
        endAt.min = startAt.value;

        startAt.addEventListener('change', (event) => {
            endAt.min = event.target.value;
        });

        endAt.addEventListener('change', (event) => {
            startAt.max = event.target.value;
        });
    </script>
@endscript
