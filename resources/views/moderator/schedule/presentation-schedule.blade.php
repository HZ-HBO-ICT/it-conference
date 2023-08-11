<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Schedule presentation
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 dark:text-gray-200">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h2 class="text-2xl font-semibold pb-3">Presentation details</h2>
                    <h2 class="text-xl">Speaker: {{$presentation->mainSpeaker()->user->name}} </h2>
                    <h2 class="text-md pb-2">{{$presentation->mainSpeaker()->user->currentTeam ? $presentation->mainSpeaker()->user->currentTeam->name : 'Independent speaker' }} </h2>
                    <h2 class="text-lg">Email: <a
                            href="mailto:{{{$presentation->mainSpeaker()->user->email}}}">{{$presentation->mainSpeaker()->user->email}}</a>
                    </h2>
                    <x-section-border/>
                    <h2 class="text-xl py-2">Title of presentation: {{$presentation->name}} </h2>
                    <h2 class="text-xl">Description of the presentation:</h2>
                    <p class="text-lg">{{$presentation->description}}</p>
                    <h2 class="text-xl py-2">Type: {{ucfirst($presentation->type)}} </h2>
                    <h2 class="text-xl py-2">Max participants: {{$presentation->max_participants}} </h2>
                    </h2>
                </div>
                <div>
                    <div>
                        <h2 class="text-2xl font-semibold pb-3">Schedule details</h2>
                        @livewire('room-and-timeslot-selector', ['presentation' => $presentation])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
