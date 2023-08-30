<x-content-moderator-layout>
    <div id="breadcrumbs" class="pl-5">
        <p class="text-gray-800 dark:text-gray-200"><span class="hover:text-violet-500"><a
                    href="{{route('moderator.schedule.overview')}}">Schedule management</a></span> /
            <span>Presentations for scheduling</span></p>
    </div>
    <h1 class="text-4xl font-extrabold text-gray-700 dark:text-white ml-4 py-5">Presentations that are approved and need to be scheduled</h1>
    <div class="pr-7">
        @foreach($presentations as $presentation)
            <a href="{{route('moderator.schedule.presentation', $presentation)}}">
                <div
                    class="card w-full rounded-md bg-violet-700 text-white font-bold px-4 py-4 mb-2 drop-shadow-l  transition-all duration-300 transform hover:scale-105 hover:cursor-pointer">
                    {{$presentation->name}}
                    <span class="text-xs mb-1 block">Speaker: {{$presentation->mainSpeaker()->user->name}}</span>
                </div>
            </a>
        @endforeach
    </div>
</x-content-moderator-layout>
