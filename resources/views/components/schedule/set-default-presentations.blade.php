@php
    use \App\Models\DefaultPresentation;
@endphp

<div class="flex items-center justify-center h-screen">
    <div class="text-center w-3/4 h-3/4">
        <h2 class="text-3xl">Heads Up!</h2>
        <p class='py-5'>Before continuing to the schedule for all presentations, we need to add an opener and a closer.
                        We don't need all the details right away, but knowing their start and end times is essential.
                        You can add them here!</p>
        <div class="grid grid-cols-1 w-full">
            @if(is_null(DefaultPresentation::opening()))
                <div class="w-full">
                    <button class="bg-crew-300 py-2 px-3 border border-crew-400 hover:bg-crew-400 rounded"
                            onclick="Livewire.dispatch('openModal', { component: 'schedule.add-default-presentation', arguments: { type: 'opening' }})">
                        Create opening presentation
                    </button>
                </div>
            @else
                <div class="w-full">
                    <button class="bg-crew-300 py-2 px-3 border border-crew-400 hover:bg-crew-400 rounded"
                            onclick="Livewire.dispatch('openModal', { component: 'schedule.add-default-presentation', arguments: { type: 'closing' }})">
                        Create closing presentation
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>