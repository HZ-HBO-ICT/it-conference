<x-content-moderator-layout>
    <div id="breadcrumbs" class="pl-5">
        <p class="text-gray-800 dark:text-gray-200">
            <a href="{{route('moderator.schedule.overview')}}"
               class="hover:text-violet-500">Schedule management</a> /
            <a href="{{route('moderator.presentations-for-scheduling')}}"
               class="hover:text-violet-500">Schedule presentations</a> /
            <span>{{$presentation->name}}</span></p>
    </div>
    <h1 class="text-4xl font-extrabold text-gray-700 dark:text-white ml-4 py-5">Schedule presentation</h1>
    <div class="grid grid-cols-2 gap-4 text-gray-900 dark:text-gray-200">
        <div class="pl-4">
            <h2 class="text-2xl font-semibold pb-3">Details</h2>
            <h2 class="text-lg">Speaker: {{$presentation->mainSpeaker()->user->name}} </h2>
            <h2 class="text-md pb-2">{{$presentation->mainSpeaker()->user->currentTeam ? $presentation->mainSpeaker()->user->currentTeam->name : 'Independent speaker' }} </h2>
            <h2 class="text-lg">Email: <a
                    href="mailto:{{$presentation->mainSpeaker()->user->email}}">{{$presentation->mainSpeaker()->user->email}}</a>
            </h2>
            <x-section-border/>
            <h2 class="text-lg pb-2">Title of presentation: {{$presentation->name}} </h2>
            <h2 class="text-lg">Description of the presentation:</h2>
            <p class="text-lg">{{$presentation->description}}</p>
            <h2 class="text-lg py-2">Type: {{ucfirst($presentation->type)}} </h2>
            <h2 class="text-lg py-2">Max participants that the speaker wants: {{$presentation->max_participants}} </h2>
            </h2>
        </div>
        <div>
            <div>
                <h2 class="text-2xl font-semibold pb-3">Schedule</h2>
                @livewire('room-and-timeslot-selector', ['presentation' => $presentation])
            </div>
        </div>
    </div>
</x-content-moderator-layout>
