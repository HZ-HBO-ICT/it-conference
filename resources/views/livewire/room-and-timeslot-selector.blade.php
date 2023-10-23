@php use Carbon\Carbon; @endphp

<div>
    <form action="{{route('moderator.schedule.presentation.store', $presentation)}}" method="POST">
        @csrf
        <div class="pb-3 pr-7">
            <label for="room" class="text-sm">Select a Room:</label>
            <select name="room_id" id="room" wire:model="selectedRoom"
                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-crew-500 focus:border-crew-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-crew-500 dark:focus:border-crew-500">
                @if(is_null($presentation->room))
                    <option value="">Select a room...</option>
                @endif
                @foreach ($rooms as $room)
                    @if($presentation->room_id == $room->id)
                        <option selected value="{{ $room->id }}">{{ $room->name }} (max
                                                                                   participants: {{$room->max_participants}}
                                                                                   )
                        </option>
                    @else
                        <option value="{{ $room->id }}">{{ $room->name }} (max participants: {{$room->max_participants}}
                                                                          )
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="pb-3 pr-7">
            @if($selectedRoom)
                <label for="timeslot" class="text-sm">Select a Timeslot:</label>
                @if($timeslots->count() > 0)
                    <select name="timeslot_id" id="timeslot"
                            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-crew-500 focus:border-crew-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-crew-500 dark:focus:border-crew-500">
                        @if(is_null($presentation->timeslot))
                            <option value="">Select a timeslot...</option>
                        @endif
                        @foreach ($timeslots as $timeslot)
                            @if($presentation->timeslot_id == $timeslot->id)
                                <option selected
                                        value="{{ $timeslot->id }}"> {{Carbon::parse($timeslot->start)->format('H:i')}}
                                    - {{(Carbon::parse($timeslot->start)->addMinutes($timeslot->duration))->format('H:i')}}</option>
                            @else
                                <option
                                    value="{{ $timeslot->id }}"> {{Carbon::parse($timeslot->start)->format('H:i')}}
                                    - {{(Carbon::parse($timeslot->start)->addMinutes($timeslot->duration))->format('H:i')}}</option>
                            @endif
                        @endforeach
                    </select>
                @else
                    <select name="timeslot" id="timeslot" disabled
                            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-crew-500
                    focus:border-crew-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700
                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-crew-500 dark:focus:border-crew-500">
                        <option>No timeslots available for this room</option>
                    </select>
                @endif
            @endif
        </div>
        <div class="grid grid-cols-5">
            <div>
                <button class="bg-crew-500 hover:bg-crew-600 text-white py-2 px-4 rounded">
                    Save
                </button>
            </div>
            <div class="sm:col-span-4">
                @if($presentation->isScheduled)
                    <p wire:click="resetTimeslot" class="text-xs underline pt-3 cursor-pointer hover:text-crew-500">Remove presentation from timeslot and room</p>
                @endif
            </div>
        </div>
        @if($selectedRoom)
            <p class="text-xs pt-2 text-gray-900 dark:text-gray-200">This means that the presentation's maximum
                                                                     participants is {{$maxParticipants}}</p>
        @endif
    </form>
</div>
