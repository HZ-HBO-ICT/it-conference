<x-content-moderator-layout>
    <h1 class="text-4xl font-extrabold text-gray-700 dark:text-white ml-4 py-5">Presentation requests</h1>
    <div class="grid grid-cols-1 gap-2 pr-12 pl-4">
        <h2 class="text-2xl text-gray-700 dark:text-white">Speakers and the presentations</h2>
        @foreach($presentations as $presentation)
            <a href="{{route('moderator.request.details', ['presentations', $presentation])}}">
                <div
                    class="card w-full rounded-md bg-violet-700 text-white font-bold px-4 py-4 drop-shadow-l  transition-all duration-300 transform hover:scale-105 hover:cursor-pointer">
                    {{$presentation->mainSpeaker()->user->name}} - {{$presentation->name}} ({{ucfirst($presentation->type)}})
                </div>
            </a>
        @endforeach
        <div class="pt-2">
            {{ $presentations->links() }}
        </div>
    </div>
</x-content-moderator-layout>
