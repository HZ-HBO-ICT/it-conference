@php use Carbon\Carbon; @endphp
<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            Schedule management
        </h1>
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            General overview
        </h2>
    </x-slot>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto py-5 mt-12 sm:px-6 lg:px-8 dark:bg-gray-800 bg-gray-200 rounded">
            <div class="grid grid-cols-7 gap-4 pb-12">
                <div style="grid-column: span 3;">
                    <h2 class="text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                        Current version of schedule
                    </h2>
                </div>
                <div>
                    <a href="{{route('moderator.requests', 'presentations')}}"
                       class="bg-purple-800 text-xs text-white py-2 px-4 rounded block text-center transition-all duration-300 transform hover:scale-105">
                        {{$numberOfPresentationRequest}}<br>Presentations<br>waiting to be approved
                    </a>
                </div>
                <div>
                    <a href="{{route('moderator.presentations-for-scheduling')}}"
                       class="bg-purple-800 text-xs text-white py-2 px-4 rounded block text-center transition-all duration-300 transform hover:scale-105">
                        {{$numberOfUnscheduledPresentations}}<br>Presentations<br>waiting to be scheduled
                    </a>
                </div>
                <div>
                    <a href="{{route('rooms.index')}}"
                       class="bg-purple-800 text-xs text-white py-2 px-4 rounded block text-center transition-all duration-300 transform hover:scale-105 h-full">
                        <span class="flex items-center h-full justify-center">{{$numberOfAvailableRooms}}<br>Rooms available for the conference</span>
                    </a>
                </div>
                <div>
                    <a href="{{route('moderator.schedule.draft')}}"
                       class="h-full bg-purple-800 text-xs text-white py-2 px-4 rounded block text-center transition-all duration-300 transform hover:scale-105">
                        <span class="flex items-center h-full justify-center">Automatically fill</span>
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <table class="table-auto w-full text-gray-200">
                        <thead>
                        <tr class="text-left">
                            <th>Timeframe</th>
                            <th>Lectures</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lectureTimeslots as $timeslot)
                            <tr>
                                <td class="text-left align-top">
                                    {{Carbon::parse($timeslot->start)->format('H:i')}}
                                    - {{(Carbon::parse($timeslot->start)->addMinutes(30))->format('H:i')}}
                                </td>
                                <td class="pb-3">
                                    @foreach($lectures as $lecture)
                                        @if($lecture->timeslot == $timeslot)
                                            <a href="{{route('moderator.schedule.presentation', $lecture)}}">
                                                <x-schedule-block :presentation="$lecture"/>
                                            </a>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    <table class="table-auto w-full text-gray-200">
                        <thead>
                        <tr class="text-left">
                            <th>Timeframe</th>
                            <th>Workshops</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($workshopTimeslots as $timeslot)
                            <tr>
                                <td class="text-left align-top">
                                    {{Carbon::parse($timeslot->start)->format('H:i')}}
                                    - {{(Carbon::parse($timeslot->start)->addMinutes(90))->format('H:i')}}
                                </td>
                                <td class="pb-3">
                                    @foreach($workshops as $workshop)
                                        @if($workshop->timeslot == $timeslot)
                                            <a href="{{route('moderator.schedule.presentation', $workshop)}}">
                                                <x-schedule-block :presentation="$workshop"/>
                                            </a>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
