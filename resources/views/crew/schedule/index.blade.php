@php
    use Carbon\Carbon;
    use App\Models\DefaultPresentation;
@endphp
<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <div class="flex items-center justify-between">
            <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Schedule management') }}
            </h1>
            @if(DefaultPresentation::opening() && DefaultPresentation::closing())
            <div class="flex gap-3">
                <button class="flex items-center justify-center p-3 text-sm font-semibold text-white bg-apricot-peach-400 rounded-md hover:bg-apricot-peach-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-apricot-peach-400"
                        onclick="Livewire.dispatch('openModal', { component: 'schedule.edit-default-presentation-modal', arguments: { type: 'opening' }})">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"></path>
                    </svg>
                    <span>Edit Opening</span>
                </button>
                <button class="flex items-center justify-center p-3 text-sm font-semibold text-white bg-apricot-peach-400 rounded-md hover:bg-apricot-peach-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-apricot-peach-400"
                        onclick="Livewire.dispatch('openModal', { component: 'schedule.edit-default-presentation-modal', arguments: { type: 'closing' }})">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"></path>
                    </svg>
                    <span>Edit Closing</span>
                </button>
                <button class="flex items-center justify-center p-3 text-sm font-semibold text-white bg-apricot-peach-400 rounded-md hover:bg-apricot-peach-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-crew-400"
                        onclick="Livewire.dispatch('openModal', { component: 'schedule.confirm-reset-schedule-modal' })">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"></path>
                    </svg>
                    <span>Reset</span>
                </button>

            </div>
            @endif
        </div>


    @if(is_null(DefaultPresentation::opening()) || is_null(DefaultPresentation::closing()))
            <x-schedule.set-default-presentations/>
        @else
            <livewire:schedule.grid-parent-component/>
        @endif
    </div>
</x-hub-layout>
