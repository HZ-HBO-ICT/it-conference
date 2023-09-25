@php use Carbon\Carbon; @endphp
<x-hub-layout>
    <h1 class="text-4xl font-extrabold text-gray-700 dark:text-white ml-4 py-5">Schedule management</h1>
    <div class="grid grid-cols-1 gap-2 pr-12 pl-4">
        <div class="grid grid-cols-6 gap-4 pb-12">
            <div>
                <a href="{{ route('moderator.requests', 'presentations') }}"
                   class="bg-purple-800 text-xs text-white py-2 h-full px-4 rounded block text-center transition-all duration-300 transform hover:scale-105">
                    {{ $numberOfPresentationRequest }}
                    <span class="mt-1 block">Presentations</span>
                    <span class="mt-0.5 block leading-relaxed">waiting to be approved</span>
                </a>
            </div>

            <div>
                <a href="{{route('moderator.presentations-for-scheduling')}}"
                   class="bg-purple-800 text-xs text-white py-2 h-full px-4 rounded block text-center transition-all duration-300 transform hover:scale-105">
                    {{$numberOfUnscheduledPresentations}}
                    <span class="mt-1 block">Presentations</span>
                    <span class="mt-0.5 block leading-relaxed">waiting to be scheduled</span>
                </a>
            </div>
            <div>
                <a href="{{route('rooms.index')}}"
                   class="bg-purple-800 text-xs text-white py-2 px-4 rounded block text-center transition-all duration-300 transform hover:scale-105 h-full">
                    {{$numberOfAvailableRooms}}
                    <span class="mt-1 block">Rooms</span>
                    <span class="mt-0.5 block leading-relaxedg">available for the conference</span>
                </a>
            </div>
            @if(\App\Models\Timeslot::all()->count() > 0)
                <div>
                    @livewire('reset-timeslots')
                </div>
            @endif
            <div>
                <a href="{{route('moderator.schedule.draft')}}"
                   class="h-full bg-purple-800 text-xs text-white py-2 px-4 rounded block text-center transition-all duration-300 transform hover:scale-105">
                    <span class="flex items-center h-full justify-center">Automatically fill</span>
                </a>
            </div>
            @if(!\App\Models\EventInstance::current()->is_final_programme_released)
                <div>
                    @livewire('release-final-programme')
                </div>
            @endif
        </div>
        <h1 class="text-2xl font-extrabold text-gray-700 dark:text-white py-3">Current version of schedule</h1>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <table class="table-auto w-full text-gray-900 dark:text-gray-200">
                    <thead>
                    <tr class="text-left">
                        <th>Timeframe</th>
                        <th>Lectures</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lectureTimeslots as $timeslot)
                        @if($timeslot->presentations->count() > 0)
                            <tr>
                                <td class="text-left text-gray-900 dark:text-white align-top">
                                    {{Carbon::parse($timeslot->start)->format('H:i')}}
                                    - {{(Carbon::parse($timeslot->start)->addMinutes(30))->format('H:i')}}
                                </td>
                                <td class="pb-3">
                                    @foreach($timeslot->presentations as $lecture)
                                        @if($lecture->timeslot_id == $timeslot->id)
                                            <a href="{{route('moderator.schedule.presentation', $lecture)}}">
                                                <x-schedule-block :presentation="$lecture"/>
                                            </a>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <table class="table-auto w-full text-gray-900 dark:text-gray-200">
                    <thead>
                    <tr class="text-left">
                        <th>Timeframe</th>
                        <th>Workshops</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($workshopTimeslots as $timeslot)
                        @if($timeslot->presentations->count() > 0)
                            <tr>
                                <td class="text-left text-gray-900 dark:text-white align-top">
                                    {{Carbon::parse($timeslot->start)->format('H:i')}}
                                    - {{(Carbon::parse($timeslot->start)->addMinutes(90))->format('H:i')}}
                                </td>
                                <td class="pb-3">
                                    @foreach($timeslot->presentations as $workshop)
                                        @if($workshop->timeslot_id == $timeslot->id)
                                            <a href="{{route('moderator.schedule.presentation', $workshop)}}">
                                                <x-schedule-block :presentation="$workshop"/>
                                            </a>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-hub-layout>
