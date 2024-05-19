<div
    x-data="draggable()"
    draggable="true"
    @dragstart="dragStart"
    @drop.prevent.stop
    @dragover.prevent.stop
    data-id="{{ $presentation->id }}"
    data-room="{{ $presentation->id }}"
    wire:click="$dispatch('openModal', { component: 'schedule.presentation-modal', arguments: { presentationId: {{ $presentation->id }} }})"
    class="cursor-move w-5/6 rounded bg-opacity-50 absolute {{$colors}}"
    style="height: {{ $height }}rem; margin-top: {{$marginTop}}rem;">
    <div class="flex flex-col p-1">
        <div class="flex items-center">
            <div class="w-1 h-6 {{$colors}} mr-1"></div>
            <h3>{{ $presentation->name }}</h3>
        </div>
        <div class="mt-px ml-2 text-xs w-full">
            {{$details}}
        </div>
    </div>
</div>
