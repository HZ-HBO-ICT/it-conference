<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Scan tickets') }}
        </h2>
    </div>

    <div class="pt-5">
        <x-waitt.list-section>
            <x-slot name="content">
                @if($edition->is_in_progress)
                    <x-button onclick="Livewire.dispatch('openModal', { component: 'qr-code.scanner' })"
                              class="sm:hidden">{{ __('Start Scanning') }}</x-button>

                    <div class="hidden sm:block" id="qr-reader"></div>

                    <p id="errorMessage"></p>
                @else
                    <div class="h-screen text-white text-xl">
                        Ticket scanning will be available on the day of the conference.
                    </div>
                @endif
            </x-slot>
        </x-waitt.list-section>
    </div>
</x-crew-colorful-layout>
