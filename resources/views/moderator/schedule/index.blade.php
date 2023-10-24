@php use Carbon\Carbon; @endphp
@php
    $anyScheduledLectures = false;
    $anyScheduledWorkshops = false;
@endphp
<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Schedule management') }}
        </h1>
        <div class="pt-5">
            <div class="grid grid-cols-1 gap-2 pr-12">
                <div class="grid grid-cols-6 gap-4 pb-12">
                    <div>
                        <a href="{{ route('moderator.requests', 'presentations') }}"
                           class="bg-crew-500 text-xs text-white py-2 h-full px-4 rounded block text-center transition-all duration-300 transform hover:scale-105">
                            {{ $numberOfPresentationRequest }}
                            <span class="mt-1 block">Presentations</span>
                            <span class="mt-0.5 block leading-relaxed">waiting to be approved</span>
                        </a>
                    </div>

                    <div>
                        <a href="{{route('moderator.presentations-for-scheduling')}}"
                           class="bg-crew-500 text-xs text-white py-2 h-full px-4 rounded block text-center transition-all duration-300 transform hover:scale-105">
                            {{$numberOfUnscheduledPresentations}}
                            <span class="mt-1 block">Presentations</span>
                            <span class="mt-0.5 block leading-relaxed">waiting to be scheduled</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{route('moderator.rooms.index')}}"
                           class="bg-crew-500 text-xs text-white py-2 px-4 rounded block text-center transition-all duration-300 transform hover:scale-105 h-full">
                            {{$numberOfAvailableRooms}}
                            <span class="mt-1 block">Rooms</span>
                            <span class="mt-0.5 block leading-relaxedg">available for the conference</span>
                        </a>
                    </div>
                    @if(\App\Models\Timeslot::all()->count() > 0)
                        <div>
                            @livewire('reset-timeslots')
                        </div>
                    @else
                        {{--<a href="{{route('moderator.schedule.timeslots.create')}}"
                           class="h-full bg-crew-500 text-xs text-white py-2 px-4 rounded block text-center transition-all duration-300 transform hover:scale-105">
                            <span class="flex items-center h-full justify-center">Generate timeslots</span>
                        </a>--}}
                    @endif
                    @if($numberOfUnscheduledPresentations > 0)
                        <div>
                            <form class="h-full" action="{{route('moderator.schedule.draft')}}" method="POST">
                                @csrf
                                <button
                                    class="h-full bg-crew-500 text-xs text-white py-2 px-4 rounded block text-center transition-all duration-300 transform hover:scale-105">
                                    <span class="flex items-center h-full justify-center">Automatically schedule presentations</span>
                                </button>
                            </form>
                        </div>
                    @else
                        @if(!\App\Models\EventInstance::current()->is_final_programme_released)
                            <div>
                                @livewire('release-final-programme')
                            </div>
                        @endif
                    @endif
                </div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Current version of schedule') }}
                </h2>
                <div class="px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-md">
                    @if(\App\Models\DefaultPresentation::all()->count() == 0)
                        <div>
                            <p class="pb-3 text-center font-italic text-md text-gray-800 dark:text-gray-200 leading-tight">
                                To start assembling the schedule first you need to add opening and closing part of the
                                conference day</p>
                            <a href="{{route("moderator.schedule.default.presentation.create", "opening")}}"
                               class="flex items-center bg-crew-100 hover:bg-crew-200 dark:bg-crew-700 dark:hover:bg-crew-900 text-gray-600 dark:text-white font-semibold justify-center py-3 px-6 w-full rounded-lg transition duration-300 ease-in-out break-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     class="w-6 h-6 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4.5v15m7.5-7.5h-15"></path>
                                </svg>
                                <span>Add opening and closing part of the conference</span>
                            </a>
                        </div>
                    @elseif(!\App\Models\DefaultPresentation::closing())
                        <div>
                            <p class="pb-3 text-center font-italic text-md text-gray-800 dark:text-gray-200 leading-tight">
                                To start assembling the schedule first you need to add opening and closing part of the
                                conference day</p>
                            <a href="{{route("moderator.schedule.default.presentation.create", "closing")}}"
                               class="flex items-center bg-crew-100 hover:bg-crew-200 dark:bg-crew-700 dark:hover:bg-crew-900 text-gray-600 dark:text-white font-semibold justify-center py-3 px-6 w-full rounded-lg transition duration-300 ease-in-out break-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     class="w-6 h-6 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4.5v15m7.5-7.5h-15"></path>
                                </svg>
                                <span>Add closing part of the conference</span>
                            </a>
                        </div>
                    @else
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
                                                            @php
                                                                $anyScheduledLectures = true
                                                            @endphp
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
                                                            @php
                                                                $anyScheduledWorkshops = true
                                                            @endphp
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

                        @if(!$anyScheduledLectures && !$anyScheduledWorkshops)
                            <div
                                class="text-center  pt-5 font-italic text-lg text-gray-800 dark:text-gray-200 leading-tight">
                                There are no presentation scheduled yet. Assign them manually or use the autofill
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-hub-layout>
