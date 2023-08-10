<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Presentation details
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 dark:text-gray-200">
            <h2 class="text-xl">Speaker: {{$presentation->mainSpeaker()->user->name}} </h2>
            <h2 class="text-md pb-2">{{$presentation->mainSpeaker()->user->currentTeam ? $presentation->mainSpeaker()->user->currentTeam->name : 'Independent speaker' }} </h2>
            <h2 class="text-lg">Email: <a href="mailto:{{{$presentation->mainSpeaker()->user->email}}}">{{$presentation->mainSpeaker()->user->email}}</a></h2>
            <x-section-border/>
            <h2 class="text-xl py-2">Title of presentation: {{$presentation->name}} </h2>
            <h2 class="text-xl">Description of the presentation:</h2>
            <p class="text-lg">{{$presentation->description}}</p>
            <h2 class="text-xl py-2">Type: {{ucfirst($presentation->type)}} </h2>
            <h2 class="text-xl py-2">Max participants: {{$presentation->max_participants}} </h2>
            </h2>
            <x-section-border/>
            <div>
                <div class="flex">
                    <form method="POST" action="{{route('moderator.request.approve', ['presentations', $presentation, 1])}}"
                          class="mr-2">
                        @csrf
                        <x-button
                            class="dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                            Approve
                        </x-button>
                    </form>
                    <form method="POST" action="{{ route('moderator.request.approve', ['presentations', $presentation, 0]) }}"
                          class="mr-2">
                        @csrf
                        <x-button
                            class="dark:bg-red-500 bg-red-500 hover:bg-red-600 hover:dark:bg-red-600 active:bg-red-600 active:dark:bg-red-600">
                            Disapprove
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
