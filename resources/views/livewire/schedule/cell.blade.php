<div class="bg-indigo-300 flex-none h-full w-full pt-1" x-data="draggable()"
     @drop.prevent="drop"
     @dragover.prevent="allowDrop"
     @draggable
     data-room="{{ $room->id }}"
     data-timeslot="{{$timeslot->id}}">
    <div class="flex flex-col">
            @foreach ($presentations as $presentation)
                    @if($presentation->type == 'workshop')
                        <div wire:key="task-{{ $presentation->id }}"
                             x-data="draggable()"
                             draggable="true"
                             @dragstart="dragStart"
                             @drop.prevent
                             data-id="{{ $presentation->id }}"
                             data-room="{{ $room->id }}"
                             class="h-40 z-50 w-full bg-sky-300 absolute">
                            <h3>{{$presentation->name}}</h3>
                        </div>
                    @else
                        <div class="h-14 bg-orange-300">
                            <h3>{{$presentation->name}}</h3>
                        </div>
                    @endif
            @endforeach
        </ul>
    </div>
</div>
