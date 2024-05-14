<div
    class="flex overflow-x-auto overflow-y-hidden py-2.5">
    <div class="bg-indigo-300 flex-none w-58 mr-4 p-2" wire:key="group-null">
        <ul class="space-y-1">
            @foreach ($unscheduledPresentations as $presentation)
                <li wire:key="task-{{ $presentation->id }}"
                    x-data="draggable()"
                    draggable="true"
                    @dragstart="dragStart"
                    data-id="{{ $presentation->id }}"
                    data-room="0">
                    <span class="cursor-pointer">{{ $presentation->name }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="flex overflow-x-auto w-full py-2.5 shadow-lg overflow-x-auto overflow-y-hidden">
        <table class="min-w-max bg-white">
            <thead class="bg-indigo-500">
            <tr>
                <th class="w-32 p-4 text-left text-white border-r border-gray-300">Time Slot</th>
                @foreach ($rooms as $room)
                    <th class="w-64 p-4 text-left text-white border-r border-gray-300">{{$room->name}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($timeslots as $timeslot)
                @php
                    $time = \Carbon\Carbon::parse($timeslot->start);
                    $isHalfHour = $time->format('i') == '30';
                @endphp
                <tr class="{{$isHalfHour ? "border-b border-gray-200 bg-gray-100" : ""}} text-gray-700 h-14 hover:bg-gray-50">
                    <td class="p-4 h-14 text-left border-r border-gray-300">{{!$isHalfHour ? $time->format('H:i') : ''}}</td>
                    @foreach ($rooms as $room)
                        <td class="text-left border-r h-14 border-gray-300 relative overflow-visible">
                            <livewire:schedule.cell wire:key="cell-r-{{ $room->id }}-t-{{$timeslot->id}}"
                                                    :timeslot="$timeslot" :room="$room"
                                                    />
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script src="{{ asset('js/draggable.js') }}"></script>

</div>
