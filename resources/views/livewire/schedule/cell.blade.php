<div class="flex-none h-full w-full" x-data="draggable()"
     @if(\App\Models\Edition::current() && !\App\Models\Edition::current()->is_final_programme_released)
         @drop.prevent="drop"
         @dragover.prevent="allowDrop"
         @draggable
     @endif
     data-room="{{ $room->id }}"
     data-timeslot="{{$timeslot->id}}"
     style="height: {{ $height }}rem">
    <div class="flex flex-col">
        @foreach ($presentations as $presentation)
            <livewire:schedule.presentation wire:key="c-p-{$presentation->id}"
                                            :presentation="$presentation"/>
        @endforeach
    </div>
</div>
