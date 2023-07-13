<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Sponsorship request details
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 dark:text-gray-200">
            <h2 class="text-xl py-2">Name of the company: {{$team->name}} </h2>
            <h2 class="text-xl py-2">Sponsorship tier: {{$team->sponsorTier->name}}</h2>
            <x-section-border/>
            <h2 class="text-xl py-2">Company representative: {{$team->owner->name}}</h2>
            <h2 class="text-xl py-2">Email: <a href="mailto:{{$team->owner->email}}}">{{$team->owner->email}}</a></h2>
            <div>
                <div class="mt-16 flex">
                    <form method="POST" action="{{route('moderator.request.approve', ['sponsorships', $team, 1])}}" class="mr-2">
                        @csrf
                        <x-button
                            class="dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                            Approve
                        </x-button>
                    </form>
                    <form method="POST" action="{{ route('moderator.request.approve', ['sponsorships', $team, 0]) }}" class="mr-2">
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
