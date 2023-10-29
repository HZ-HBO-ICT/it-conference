@php
    use Carbon\Carbon;
    use App\Models\DefaultPresentation;
@endphp

<x-app-layout>
    <div class="relative bg-cover overflow-hidden min-h-screen">
        <div
            class="before:absolute before:bg-gradient-to-br before:from-gradient-yellow before:via-gradient-pink before:via-gradient-purple before:to-gradient-blue before:opacity-70 before:w-full before:h-full"></div>
        <div
            class="isolate px-6 py-6 max-w-7xl mx-auto mt-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center max-w-2xl mx-auto">
                <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">Programme</h2>
            </div>
            <div class="m-5 mt-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 sm:gap-3">
                    <!-- Start of the opening -->
                    <div class="sm:col-span-2">
                        <table class="table-auto w-full text-gray-900 dark:text-gray-200">
                            <tbody>
                            <tr>
                                <td class="text-left text-md text-gray-900 dark:text-white align-top">
                                    {{Carbon::parse(DefaultPresentation::opening()->timeslot->start)->format('H:i')}}
                                    - {{(Carbon::parse(DefaultPresentation::opening()->timeslot->start)->addMinutes(DefaultPresentation::opening()->timeslot->duration))->format('H:i')}}
                                </td>
                                <td class="pl-4 w-11/12">
                                    <div
                                        class="w-full rounded overflow-hidden shadow-lg bg-violet-600 transition-all duration-300 transform hover:scale-105">
                                        <div class="px-3 py-1">
                                            <div
                                                class="font-bold text-white text-md">{{DefaultPresentation::opening()->name}}</div>
                                            <p class="text-gray-100 text-sm">
                                                {{DefaultPresentation::opening()->description}}
                                            </p>
                                        </div>
                                        <div class="px-2 pb-2">
                                        <span
                                            class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">
                                            {{DefaultPresentation::opening()->room->name}}
                                        </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- End of the opening -->
                    <div>
                        <h3 class="tracking-tight leading-10 font-bold text-center text-xl dark:text-white">
                            Lectures</h3>
                        <table class="table-auto w-full text-gray-900 dark:text-gray-200">
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
                                                    <a href="{{route('programme.presentation.show', $lecture)}}">
                                                        <x-schedule-block :presentation="$lecture" :colorName="'violet'"/>
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
                        <h3 class="tracking-tight leading-10 font-bold text-center text-xl dark:text-white">
                            Workshops</h3>
                        <table class="table-auto w-full text-gray-900 dark:text-gray-200">
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
                                                    <a href="{{route('programme.presentation.show', $workshop)}}">
                                                        <x-schedule-block :presentation="$workshop" :colorName="'violet'"/>
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
                    <!-- Start of the closing -->
                    <div class="sm:col-span-2">
                        <table class="table-auto w-full text-gray-900 dark:text-gray-200">
                            <tbody>
                            <tr>
                                <td class="text-left text-md text-gray-900 dark:text-white align-top">
                                    {{Carbon::parse(DefaultPresentation::closing()->timeslot->start)->format('H:i')}}
                                    - {{(Carbon::parse(DefaultPresentation::closing()->timeslot->start)->addMinutes(DefaultPresentation::closing()->timeslot->duration))->format('H:i')}}
                                </td>
                                <td class="pl-4 w-11/12">
                                    <div
                                        class="w-full rounded overflow-hidden shadow-lg bg-violet-600 transition-all duration-300 transform hover:scale-105">
                                        <div class="px-3 py-1">
                                            <div
                                                class="font-bold text-white text-md">{{DefaultPresentation::closing()->name}}</div>
                                            <p class="text-gray-100 text-sm">
                                                {{DefaultPresentation::closing()->description}}
                                            </p>
                                        </div>
                                        <div class="px-2 pb-2">
                                        <span
                                            class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">
                                            {{DefaultPresentation::closing()->room->name}}
                                        </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- End of the closing -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
