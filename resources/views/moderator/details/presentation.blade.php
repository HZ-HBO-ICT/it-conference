<x-content-moderator-layout>
    <div id="breadcrumbs" class="pl-5">
        <p class="text-gray-800 dark:text-gray-200"><span class="hover:text-violet-500"><a
                    href="{{route('moderator.requests', 'presentations')}}">Presentation requests</a></span> /
            <span>{{$presentation->name}}</span></p>
    </div>
    <h1 class="text-4xl font-extrabold text-gray-700 dark:text-white ml-4 py-5">Presentation request details</h1>

    <div class="pl-5 text-gray-800 dark:text-gray-200">
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
        <x-section-border/>
        <div>
            <div class="flex">
                <form method="POST" action="{{route('moderator.request.presentations.approve', [$presentation, 1])}}"
                      class="mr-2">
                    @csrf
                    <x-button
                        class="dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                        Approve
                    </x-button>
                </form>
                <form method="POST"
                      action="{{ route('moderator.request.presentations.approve', [$presentation, 0]) }}"
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
</x-content-moderator-layout>
