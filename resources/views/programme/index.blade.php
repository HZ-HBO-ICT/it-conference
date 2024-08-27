@php
    use Carbon\Carbon;
    use App\Models\DefaultPresentation;
    use App\Models\Edition;
    use Illuminate\Support\Facades\Auth;

    $roleColour = Auth::user() ? Auth::user()->roleColour : 'blue';
@endphp

<x-app-layout>
    <div class="relative bg-cover overflow-hidden min-h-screen">
        <h2 class="text-center dark:text-gray-50 text-gray-900 text-5xl font-extrabold py-12">
            Programme
        </h2>
        <div
            class="isolate px-6 py-6 max-w-7xl mx-auto border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700 my-5">
            <div class="m-5 mt-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 sm:gap-3">
                    <!-- Start of the opening -->
                    <div class="sm:col-span-2">
                        <table class="table-auto w-full text-gray-900 dark:text-gray-200">
                            <tbody>
                            <tr>
                                <td class="text-left text-md text-gray-900 dark:text-white align-top">
                                    {{Carbon::parse(DefaultPresentation::opening()->start)->format('H:i')}}
                                    - {{Carbon::parse(DefaultPresentation::opening()->end)->format('H:i')}}
                                </td>
                                <td class="pl-4 w-11/12">
                                    <div
                                        class="w-full rounded overflow-hidden hover:transition-all hover:duration-300 hover:ease-in-out bg-{{ $roleColour }}-400 hover:bg-gradient-to-r hover:from-{{ $roleColour }}-400 hover:to-{{ $roleColour }}-600
                                        dark:bg-{{ $roleColour }}-500 dark:hover:bg-gradient-to-r dark:hover:from-{{ $roleColour }}-500 dark:hover:to-{{ $roleColour }}-800 dark:hover:transition-all dark:hover:duration-300 dark:hover:ease-in-out">
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
                                <tr>
                                    <td class="text-left text-md text-gray-900 dark:text-white align-top">
                                        {{Carbon::parse($timeslot['start'])->format('H:i')}}
                                        - {{(Carbon::parse($timeslot['start'])->addMinutes(Edition::current()->lecture_duration))->format('H:i')}}
                                    </td>
                                    <td class="pb-5">
                                        @foreach($lectures as $lecture)
                                            @if($lecture->start == $timeslot['start'])
                                                <div class="pb-3">
                                                    <a href="{{route('programme.presentation.show', $lecture)}}">
                                                        <x-schedule-block :presentation="$lecture" :colorName="$roleColour"/>
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
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
                                <tr>
                                    <td class="text-left text-gray-900 dark:text-white align-top">
                                        {{Carbon::parse($timeslot['start'])->format('H:i')}}
                                        - {{(Carbon::parse($timeslot['start'])->addMinutes(Edition::current()->workshop_duration))->format('H:i')}}
                                    </td>
                                    <td class="pb-5">
                                        @foreach($workshops as $workshop)
                                            @if($workshop->start == $timeslot['start'])
                                                <div class="pb-3">
                                                    <a href="{{route('programme.presentation.show', $workshop)}}">
                                                        <x-schedule-block :presentation="$workshop"
                                                                          :colorName="$roleColour"/>
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
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
                                    {{Carbon::parse(DefaultPresentation::closing()->start)->format('H:i')}}
                                    - {{Carbon::parse(DefaultPresentation::closing()->end)->format('H:i')}}
                                </td>
                                <td class="pl-4 w-11/12">
                                    <div
                                        class="w-full rounded overflow-hidden bg-{{ $roleColour }}-400 hover:bg-gradient-to-r hover:from-{{ $roleColour }}-400 hover:to-{{ $roleColour }}-600 hover:transition-all hover:duration-300 hover:ease-in-out
                                        dark:bg-{{ $roleColour }}-500 dark:hover:bg-gradient-to-r dark:hover:from-{{ $roleColour }}-500 dark:hover:to-{{ $roleColour }}-800 dark:hover:transition-all dark:hover:duration-300 dark:hover:ease-in-out">
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
