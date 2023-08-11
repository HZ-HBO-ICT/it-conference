@php use Carbon\Carbon; @endphp

<div>
    <form action="{{route('moderator.schedule.presentation.store', $presentation)}}" method="POST">
        @csrf
        <div class="pb-3">
            <label for="room">Select a Room:</label>
            <select name="room_id" id="room" wire:model="selectedRoom"
                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                @if(is_null($presentation->room))
                    <option value="">Select a room...</option>
                @endif
                @foreach ($rooms as $room)
                    @if($presentation->room_id == $room->id)
                        <option selected value="{{ $room->id }}">{{ $room->name }}</option>
                    @else
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="pb-3">
            @if($selectedRoom)
                <label for="timeslot">Select a Timeslot:</label>
                @if($timeslots->count() > 0)
                    <select name="timeslot_id" id="timeslot"
                            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
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
                            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500
                    focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700
                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        <option>No timeslots available for this room</option>
                    </select>
                @endif
            @endif
        </div>
        <button class="bg-indigo-800 hover:bg-indigo-700 text-white py-2 px-4 rounded">
            Save
        </button>
    </form>
</div>
