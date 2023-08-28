@php use Carbon\Carbon; @endphp

<x-app-layout>
    <div
        class="px-6 py-6 max-w-7xl mx-auto mt-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
        <div id="breadcrumbs" class="pl-5 text-sm">
            <p class="text-gray-800 dark:text-gray-200">
                <a href="{{route('programme')}}"
                   class="hover:text-violet-500 pl-4">Programme</a> /
                <span>{{$presentation->name}}</span></p>
        </div>
        <div class="text-center max-w-2xl mx-auto">
            <h1 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">{{$presentation->name}}</h1>
        </div>
        <div class="m-5">
            <div class="text-gray-900 dark:text-gray-200">
                <div class="grid grid-cols-2">
                    <div class="pl-4">
                        @if($presentation->speakers()->get()->count() == 1)
                            <h2 class="text-md">Speaker: {{$presentation->mainSpeaker()->user->name}} </h2>
                        @else
                            <h2 class="text-md">Speakers:
                                @foreach($presentation->speakers()->get() as $speaker)
                                {{$speaker->name}},
                                @endforeach</h2>
                        @endif
                        <h2 class="text-sm pb-2">{{$presentation->mainSpeaker()->user->currentTeam ? $presentation->mainSpeaker()->user->currentTeam->name : 'Independent speaker' }} </h2>
                        <h2 class="text-md py-3">Type: {{ucfirst($presentation->type)}} </h2>
                        <h2 class="text-md py-3">Time: {{Carbon::parse($presentation->timeslot->start)->format('H:i')}}
                                                 - {{(Carbon::parse($presentation->timeslot->start)->addMinutes($presentation->timeslot->duration))->format('H:i')}} </h2>
                        <h2 class="text-md py-3">Room: {{$presentation->room->name}} </h2>
                    </div>
                    <div>
                        <h2 class="text-md">Description of the presentation:</h2>
                        <blockquote
                            class="mt-1 pl-4 text-gray-600 border-gray-400 dark:text-gray-200 dark:border-gray-100 border-l-4 italic">
                            {{$presentation->description}}
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
