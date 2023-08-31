@php use Carbon\Carbon; @endphp

<x-hub-layout>
    {{--personal programme--}}
    <div class="z-20 w-full mr-8">
        <div class="bg-white dark:bg-gray-800 h-fit overflow-hidden rounded-lg shadow-xl">
            <div class="px-6 py-6 bg-gray-50 dark:bg-gray-800">
                <div class="flex flex-row justify-between">
                    <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">Programme</h2>
                </div>
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
                                                    <x-my-programme-block :presentation="$lecture"/>
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
                                                    <x-my-programme-block :presentation="$workshop"/>
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
                <a href="{{ route('my-programme') }}" type="button"
                   class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 mt-16">
                    Go back
                </a>
            </div>
        </div>
    </div>
</x-hub-layout>
