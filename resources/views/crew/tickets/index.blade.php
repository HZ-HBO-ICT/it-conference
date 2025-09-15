<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Scan tickets') }}
        </h2>

        <x-waitt.button-link id="manual-form-modal">
            {{ __('Fill attendance manually') }}
        </x-waitt.button-link>
    </div>

    <div class="pt-5">
        <x-waitt.list-section>
            <x-slot name="content">
                @if($edition->is_in_progress)
                    <x-waitt.label value="Choose location:" />
                    <x-select id="room-select" class="mt-1 mb-4 block w-3xs border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs">
                        <option selected value="">Entrance</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                    </x-select>

                    <x-button onclick="Livewire.dispatch('openModal', { component: 'qr-code.scanner' })"
                              class="sm:hidden">{{ __('Start Scanning') }}</x-button>

                    <div class="hidden sm:block" id="qr-reader"></div>

                    <p id="errorMessage" class="text-white"></p>
                @else
                    <div class="h-screen text-white text-xl">
                        Ticket scanning will be available on the day of the conference.
                    </div>
                @endif
            </x-slot>
        </x-waitt.list-section>
    </div>
</x-crew-colorful-layout>
