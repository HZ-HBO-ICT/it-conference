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
    style="height: {{ $height }}rem; margin-top: {{$marginTop}}rem;"
>
    <div class="flex h-full">
        <!-- Vertical line -->
        <div class="w-2 rounded-tl rounded-bl {{$colors}}"></div>
        <!-- TODO: Figure out the autoresize of the presentation table; don't forget to reconf the presentation height themselves
        <!-- Content -->
        <div class="flex flex-col pt-1 ml-2">
            <span>
                {{ strlen($presentation->name) > 20 ? substr($presentation->name, 0, 20) . '...' : $presentation->name }}
            </span>
            <span class="text-xs">
                {{ strlen($presentation->speakersName) > 29 ? substr($presentation->speakersName, 0, 29) . '...' : $presentation->speakersName }}
            </span>
            @if($presentation->company)
                <span class="text-xs">
                    {{ strlen($presentation->company->name) > 29 ? substr($presentation->company->name, 0, 29) . '...' : $presentation->company->name }}
                </span>
            @endif
        </div>
    </div>
</div>
