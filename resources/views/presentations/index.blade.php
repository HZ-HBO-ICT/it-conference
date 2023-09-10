@php use Carbon\Carbon; @endphp

<x-app-layout>
    <div class="px-6 py-6 max-w-7xl mx-auto mt-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
        <div class="text-center max-w-2xl mx-auto">
            <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">Programme</h2>
        </div>
        <div class="m-5">
            <div class="grid grid-cols-2 gap-6">
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
                                    <td class="text-left text-md text-gray-900 dark:text-white align-top">
                                        {{Carbon::parse($timeslot->start)->format('H:i')}}
                                        - {{(Carbon::parse($timeslot->start)->addMinutes(30))->format('H:i')}}
                                    </td>
                                    <td class="pb-3">
                                        @foreach($timeslot->presentations as $lecture)
                                            @if($lecture->timeslot_id == $timeslot->id)
                                                <a href="{{route('presentations.show', $lecture)}}">
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
                                                <a href="{{route('presentations.show', $workshop)}}">
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
    </div>
</x-app-layout>
