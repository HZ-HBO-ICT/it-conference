@php
    use Carbon\Carbon;
    use App\Models\DefaultPresentation;
    use App\Models\Edition;
@endphp
<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <div class="flex items-center justify-between">
            <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Schedule management') }}
            </h1>
            @if(DefaultPresentation::opening() && DefaultPresentation::closing() && Edition::current() && !Edition::current()->is_final_programme_released)
                <div class="flex gap-3">
                    <button
                        class="flex items-center justify-center p-3 text-sm font-semibold text-white bg-apricot-peach-400 rounded-md hover:bg-apricot-peach-500 focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-apricot-peach-400"
                        onclick="Livewire.dispatch('openModal', { component: 'schedule.confirm-reset-schedule-modal' })">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" aria-hidden="true" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"></path>
                        </svg>
                        <span>Reset</span>
                    </button>
                    <livewire:schedule.publish-programme-button/>
                </div>
            @endif
        </div>

        @if($noActiveEdition)
            <div class="flex items-center justify-center h-screen">
                <div class="text-center w-3/4 h-3/4">
                    <h2 class="text-3xl">Heads Up!</h2>
                    <p class='py-5'>In order to access the scheduling, you must first set an active edition.</p>
                    <div class="grid grid-cols-1 w-full">
                        <div class="w-full">
                            <a href="{{route('moderator.editions.index')}}" class="bg-apricot-peach-300 py-2 px-3 border border-apricot-peach-400 hover:bg-apricot-peach-400 rounded-sm">
                                Go to Editions management
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(is_null(DefaultPresentation::opening()) || is_null(DefaultPresentation::closing()))
            <x-schedule.set-default-presentations/>
        @else
            <livewire:schedule.grid-parent-component/>
        @endif
    </div>
</x-hub-layout>
