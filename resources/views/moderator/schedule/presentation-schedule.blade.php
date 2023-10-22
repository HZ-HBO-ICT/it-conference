@php
    $speakers = $presentation->speakers->filter(function ($speaker) {
        return $speaker->is_main_speaker === 0;
    });

    $cospeakers = [];
    foreach ($speakers as $speaker) {
        if ($speaker->user && $speaker->user->name) {
            $cospeakers[] = $speaker->user->name;
        }
    }

    $cospeakersString = implode(', ', $cospeakers);
@endphp

<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Schedule presentation') }}
        </h1>
        <div class="pt-5">
            <div class="grid mt-5 grid-cols-2 gap-6 text-gray-900 dark:text-gray-200 px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-md">
                <div class="pt-1 p-2">
                    <h3 class="text-xl font-bold pb-3">Details</h3>
                    <p class="text-md"><span class="font-semibold">Main speaker:</span> {{$presentation->mainSpeaker()->user->name}} </p>
                    <p class="text-sm pb-2">{{$presentation->mainSpeaker()->user->currentTeam ? $presentation->mainSpeaker()->user->currentTeam->name : 'Independent speaker' }} </p>
                    @if($speakers->count() > 0)
                        <p class="text-sm">Cohosted with: {{$cospeakersString}}</p>
                    @endif
                    <p class="text-md"><span class="font-semibold">Email:</span> <a
                            href="mailto:{{$presentation->mainSpeaker()->user->email}}"
                            class="text-crew-500">{{$presentation->mainSpeaker()->user->email}}</a>
                    </p>
                    <x-section-border/>
                    <h2 class="text-md pb-2"><span class="font-semibold">Title of presentation:</span> {{$presentation->name}} </h2>
                    <h2 class="text-md font-semibold">Description of the presentation:</h2>
                    <p class="text-md">{{$presentation->description}}</p>
                    <h2 class="text-md py-2"><span class="font-semibold">Type:</span> {{ucfirst($presentation->type)}} </h2>
                    <h2 class="text-md pb-2"><span class="font-semibold">Max participants that the speaker
                                             wants:</span> {{$presentation->max_participants}} </h2>
                    </h2>
                    <x-section-border/>
                    @livewire('download-presentation', ['presentation' => $presentation])

                </div>
                <div>
                    <div>
                        <h2 class="text-2xl font-semibold pb-3">Schedule</h2>
                        @livewire('room-and-timeslot-selector', ['presentation' => $presentation])
                    </div>
                </div>
            </div>
</x-hub-layout>
