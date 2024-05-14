<div class="bg-indigo-300 flex-none h-full w-full" x-data="draggable()"
     @drop.prevent="drop"
     @dragover.prevent="allowDrop"
     @draggable
     data-room="{{ $room->id }}"
     data-timeslot="{{$timeslot->id}}">
    <div class="flex flex-col">
        @foreach ($presentations as $presentation)
            <livewire:schedule.presentation wire:key="c-p-{$presentation->id}"
                                            :presentation="$presentation"/>
        @endforeach
    </div>
</div>
