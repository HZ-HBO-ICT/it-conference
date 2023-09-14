@php
use Carbon\Carbon;
use App\Models\EventInstance;
@endphp

<x-app-layout>
    <x-presentation-details
        :presentation="$presentation"
        :presentationName="$presentation->name"
        :presentationDescription="$presentation->description"
        :filename="basename($presentation->file_path)"
        :presentationType="$presentation->type"
        :presentationMaxParticipants="$presentation->max_participants"
    />


    <!-- <h1 class="text-4xl font-extrabold text-gray-700 dark:text-white ml-4 py-5">Presentation details</h1>
    <div class="grid grid-cols-2 gap-4 text-gray-900 dark:text-gray-200">
        <div class="pl-4">
            <h3 class="text-xl font-extrabold text-gray-700 dark:text-white ml-4 py-5">Details provided by you</h3>
            <p class="text-lg pb-2">Title of presentation: {{$presentation->name}} </p>
            <p class="text-lg">Description of the presentation:</p>
            <p class="text-lg">{{$presentation->description}}</p>
            <p class="text-lg py-2">Type: {{ucfirst($presentation->type)}} </p>
            <p class="text-lg py-2">Max participants that you wish: {{$presentation->max_participants}} </p>
            </h2>
            <x-section-border/>
            <h3 class="text-xl font-extrabold text-gray-700 dark:text-white ml-4 py-5">Presentation slides</h3>
            @livewire('upload-presentation', ['presentation' => $presentation])
        </div>
        <div>
            <div>
                <h3 class="text-2xl font-semibold pb-3">Schedule</h3> -->
                <!-- @if(EventInstance::current()->is_final_programme_released)
                    <p class="text-lg">Time: {{Carbon::parse($presentation->timeslot->start)->format('H:i')}}
                                       - {{(Carbon::parse($presentation->timeslot->start)->addMinutes(30))->format('H:i')}}</p>
                    <p class="text-lg py-2">Room: {{$presentation->room->name}} </p>
                    <p class="text-lg py-2">Participants: {{$presentation->maxParticipants()}} </p>
                @else
                    <p class="text-lg">The programme hasn't been released yet</p>
                @endif -->
            <!-- </div>
        </div>
    </div> -->
</x-app-layout>
