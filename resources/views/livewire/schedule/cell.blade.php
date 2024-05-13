<div class="bg-indigo-300 flex-none h-full w-full p-2" x-data="draggable()"
     @drop.prevent="drop"
     @dragover.prevent="allowDrop"
     data-room="{{ $room->id }}"
     data-timeslot="{{$timeslot->id}}">
    <div class="flex flex-col">
        <ul class="space-y-1">
            @foreach ($presentations as $presentation)
                <li wire:key="task-{{ $presentation->id }}"
                    x-data="draggable()"
                    draggable="true"
                    @dragstart="dragStart"
                    data-id="{{ $presentation->id }}"
                    data-room="{{ $room->id }}">
                    <span class="cursor-pointer">
                        {{$presentation->type == 'workshop' ? 'W' : 'L' }}:
                        {{ $presentation->name }}</span>
                </li>

            @endforeach
        </ul>
    </div>
</div>
