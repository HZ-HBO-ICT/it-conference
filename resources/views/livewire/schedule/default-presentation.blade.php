<div style="height: {{ $height }}rem;">
    <div class="flex h-full w-full rounded-sm text-black absolute hover:cursor-pointer bg-waitt-yellow"
    @if($presentation->type == 'opening')
        wire:click="$dispatch('openModal', { component: 'schedule.edit-default-presentation-modal',  arguments: { type: 'opening' }})"
    @else
         wire:click="$dispatch('openModal', { component: 'schedule.edit-default-presentation-modal',  arguments: { type: 'closing' }})"
    @endif
    >
        <!-- The IF statement above is a bit funky but otherwise the dynamic parameter was not passing properly -->
        <div class="flex flex-col pt-1 pb-2 ml-2">
            <span>
                {{ $presentation->name  }}
            </span>
            <span class="text-xs">
                {{ $presentation->description }}
            </span>
            <span class="pt-1 text-xs">
                {{$presentation->room->name}}
            </span>
        </div>
    </div>
</div>
