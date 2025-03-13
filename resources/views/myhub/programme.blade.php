@php
    use Carbon\Carbon;
    use App\Models\DefaultPresentation;
    use App\Models\Edition;
@endphp

    <!-- Leave this to fool Tailwind compilation, otherwise it will delete dynamic styles. There is a better fix! -->
<!-- Potential dynamic classes: bg-crew-600 dark:bg-crew-600 bg-violet-600 dark:bg-violet-600 bg-partner-600 dark:bg-partner-600 bg-participant-600 -->

<x-hub-layout>
    <div class="py-8 px-2 mx-auto max-w-7xl">
        <div style="display: flex; justify-content: space-between;">
            <h2 class="font-semibold text-2xl px-6 text-gray-800 dark:text-gray-200 leading-tight">
                My Programme
            </h2>
            <div class="pr-5">
                <a href="{{route('programme')}}" class="bg-{{Auth::user()->roleColour}}-600 rounded-sm py-2 px-3 rounded-lg text-white">
                    Sign up for presentations/workshops
                </a>
            </div>
        </div>
        <div class="pt-6 px-6 pb-12 rounded-lg overflow-hidden">
            <div class="grid grid-cols-7 sm:gap-3">
                <!-- Start of the opening -->
                <div class="sm:col-span-1">
                    <div class="text-left text-md text-gray-900 dark:text-white align-top">
                        {{Carbon::parse(DefaultPresentation::opening()->start)->format('H:i')}}
                        - {{Carbon::parse(DefaultPresentation::opening()->end)->format('H:i')}}
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-6">
                    <div
                        class="w-full rounded-sm overflow-hidden bg-{{Auth::user()->roleColour}}-400 hover:bg-linear-to-r hover:from-{{Auth::user()->roleColour}}-400 hover:to-{{Auth::user()->roleColour}}-600 hover:transition-all hover:duration-300 hover:ease-in-out">
                        <div class="px-3 py-1">
                            <div
                                class="font-bold text-white text-md">{{DefaultPresentation::opening()->name}}</div>
                            <p class="text-gray-100 text-sm">
                                {{DefaultPresentation::opening()->description}}
                            </p>
                        </div>
                        <div class="px-2 pb-2">
                            <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">
                                {{DefaultPresentation::opening()->room->name}}
                            </span>
                        </div>
                    </div>
                </div>
                @foreach($presentations as $presentation)
                    <div class="sm:col-span-1">
                        <div class="text-left text-md text-gray-900 dark:text-white align-top">
                            {{Carbon::parse($presentation->start)->format('H:i')}}
                            @if ($presentation->type == 'lecture')
                                - {{(Carbon::parse($presentation->start)->addMinutes(Edition::current()->lecture_duration))->format('H:i')}}
                            @else
                                - {{(Carbon::parse($presentation->start)->addMinutes(Edition::current()->workshop_duration))->format('H:i')}}
                            @endif
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-6">
                        <a href="{{route('programme.presentation.show', $presentation)}}">
                            <x-schedule-block :presentation="$presentation" :colorName="Auth::user()->roleColour"/>
                        </a>
                    </div>
                @endforeach
                <div class="sm:col-span-1">
                    <div class="text-left text-md text-gray-900 dark:text-white align-top">
                        {{Carbon::parse(DefaultPresentation::closing()->start)->format('H:i')}}
                        - {{Carbon::parse(DefaultPresentation::closing()->end)->format('H:i')}}
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-6">
                    <div
                        class="w-full rounded-sm overflow-hidden bg-{{Auth::user()->roleColour}}-400 hover:bg-linear-to-r hover:from-{{Auth::user()->roleColour}}-400 hover:to-{{Auth::user()->roleColour}}-600 hover:transition-all hover:duration-300 hover:ease-in-out">
                        <div class="px-3 py-1">
                            <div
                                class="font-bold text-white text-md">{{DefaultPresentation::closing()->name}}</div>
                            <p class="text-gray-100 text-sm">
                                {{DefaultPresentation::closing()->description}}
                            </p>
                        </div>
                        <div class="px-2 pb-2">
                            <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">
                                {{DefaultPresentation::closing()->room->name}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-hub-layout>
