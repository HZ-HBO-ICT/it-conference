<x-hub-layout>
    <div id="breadcrumbs" class="pl-5">
        <p class="text-gray-800 dark:text-gray-200"><span class="hover:text-violet-500"><a
                    href="{{route('moderator.requests', 'teams')}}">Company requests</a></span> /
            <span>{{$team->name}}</span></p>
    </div>
    <h1 class="text-4xl font-extrabold text-gray-700 dark:text-white ml-4 py-5">Company request details</h1>

    <div class="pl-5 text-gray-800 dark:text-gray-200">
        <h2 class="text-xl pt-2">Name of the company: {{$team->name}} </h2>
        <h2 class="text-xl py-2">Added on: {{\Carbon\Carbon::parse($team->created_at)->format('d/m/y H:i')}} </h2>
        <h2 class="text-xl">Description:</h2>
        <p class="text-lg">{{$team->description}}</p>
        <h2 class="text-xl py-2">Address: {{$team->address}} </h2>
        <h2 class="text-xl">Website: <a
                href="{{str_starts_with($team->website, 'https://www.') ? $team->website : "https://www." . $team->website}}">
                {{$team->website}}</a>
        </h2>
        <x-section-border/>

        <h2 class="text-xl py-2">Company representative: {{$team->owner->name}}</h2>
        <h2 class="text-xl">Email: <a href="mailto:{{$team->owner->email}}}">{{$team->owner->email}}</a></h2>
        <div>
            <div class="mt-16 flex">
                <form method="POST" action="{{route('moderator.request.teams.approve', [$team, 1])}}" class="mr-2">
                    @csrf
                    <x-button
                        class="dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                        Approve
                    </x-button>
                </form>
                <form method="POST" action="{{ route('moderator.request.teams.approve', [$team, 0]) }}" class="mr-2">
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
</x-hub-layout>
