@php
    use \App\Models\DefaultPresentation;
@endphp

<div>
    <div class="flex items-center justify-center">
        <x-schedule.progress-bar></x-schedule.progress-bar>
    </div>
    <div class="flex text-white items-center justify-center h-screen">
        <div class="text-center w-3/4 h-3/4">
            <h2 class="text-3xl">Heads Up!</h2>
            <p class='py-5'>Before continuing to the schedule for all presentations, we need to add an opener and a
                            closer.
                            We don't need all the details right away, but knowing their start and end times is
                            essential.
                            You can add them here!</p>
            <div class="grid grid-cols-1 w-full">
                @if(is_null(DefaultPresentation::opening()))
                    <div class="w-full">
                        <x-waitt.button-link
                            onclick="Livewire.dispatch('openModal', { component: 'schedule.add-default-presentation', arguments: { type: 'opening' }})">
                            Create opening presentation
                        </x-waitt.button-link>
                    </div>
                @else
                    <div class="w-full">
                        <x-waitt.button-link
                            onclick="Livewire.dispatch('openModal', { component: 'schedule.add-default-presentation', arguments: { type: 'closing' }})">
                            Create closing presentation
                        </x-waitt.button-link>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
