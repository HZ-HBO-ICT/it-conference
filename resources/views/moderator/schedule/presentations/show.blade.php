@php
    use Carbon\Carbon;
    use App\Models\EventInstance;

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
            @if (session('error'))
                <div class="text-red-600">
                    {{ session('error') }}
                </div>
            @endif
            <div
                class="grid mt-5 grid-cols-2 gap-6 text-gray-900 dark:text-gray-200 px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-md">
                <div class="pt-1 p-2">
                    <h3 class="text-xl font-bold pb-3">Presentation details</h3>
                    <p class="text-md"><span
                            class="font-semibold">Main speaker:</span> {{$presentation->mainSpeaker()->user->name}} </p>
                    <p class="text-sm pb-2">{{$presentation->mainSpeaker()->user->currentTeam ? $presentation->mainSpeaker()->user->currentTeam->name : 'Independent speaker' }} </p>
                    @if($speakers->count() > 0)
                        <p class="text-sm">Cohosted with: {{$cospeakersString}}</p>
                    @endif
                    <p class="text-md"><span class="font-semibold">Email:</span> <a
                            href="mailto:{{$presentation->mainSpeaker()->user->email}}"
                            class="text-crew-500">{{$presentation->mainSpeaker()->user->email}}</a>
                    </p>
                    <x-section-border/>
                    <p class="text-md pb-2"><span
                            class="font-semibold">Title of presentation:</span> {{$presentation->name}} </p>
                    <p class="text-md font-semibold">Description of the presentation:</p>
                    <p class="text-md">{{$presentation->description}}</p>
                    <p class="text-md py-2"><span class="font-semibold">Type:</span> {{ucfirst($presentation->type)}}
                    </p>
                    <p class="text-md pb-2"><span class="font-semibold">Max participants that the speaker
                                             wants:</span> {{$presentation->max_participants}} </p>
                    <x-section-border/>
                    @livewire('download-presentation', ['presentation' => $presentation])
                </div>
                <div>
                    <div class="pt-1 p-2">
                        <h3 class="text-xl font-bold pb-3">Scheduling details</h3>
                        @if($presentation->isScheduled)
                            <p class="text-md pt-4 pb-3">
                                <span class="font-semibold">Currently scheduled at:<br></span>
                                {{$presentation->room->name}}
                                ({{Carbon::parse($presentation->timeslot->start)->format('H:i')}}
                                - {{(Carbon::parse($presentation->timeslot->start)->addMinutes($presentation->timeslot->duration))->format('H:i')}}
                                )
                            </p>
                            <x-section-border/>
                        @endif
                        @if(EventInstance::current()->is_final_programme_released && $presentation->isScheduled)
                            <div class="font-semibold pb-2">
                                Replace presentation
                            </div>
                            <p class="text-md pb-1">If you want you can replace the presentation with one of the
                            presentations that are not scheduled already</p>
                            @livewire('schedule.replace-presentation', ['presentationToBeReplaced' => $presentation])
                            <x-section-border/>
                            @livewire('schedule.remove-presentation-from-schedule', ['presentation' => $presentation])
                        @else
                            <div class="font-semibold pb-2">
                                Select room and timeslot
                            </div>
                            @livewire('room-and-timeslot-selector', ['presentation' => $presentation])
                        @endif
                    </div>
                </div>
            </div>
</x-hub-layout>
