<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Scan tickets') }}
        </h2>
        <div class="pt-5">
            <x-list-section>
                <x-slot name="content">
                    @if($edition->is_in_progress)
                        <x-button onclick="Livewire.dispatch('openModal', { component: 'qr-code.scanner' })"
                                  class="sm:hidden">{{ __('Start Scanning') }}</x-button>

                        <div class="hidden sm:block" id="qr-reader"></div>

                        <p id="errorMessage"></p>
                    @else
                        Ticket scanning will be available on the day of the conference.
                    @endif
                </x-slot>
            </x-list-section>
        </div>
    </div>
</x-hub-layout>
