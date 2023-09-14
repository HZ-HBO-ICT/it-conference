<x-content-moderator-layout>
    <h1 class="text-4xl font-extrabold text-gray-700 dark:text-white ml-4 py-5">Sponsorship requests</h1>
    <div class="grid grid-cols-1 gap-2 pr-12 pl-4">
        <h2 class="text-2xl text-gray-700 dark:text-white">Companies that want to join as sponsors</h2>
        @forelse($teams as $index => $team)
            <a href="{{route('moderator.request.details', ['sponsorships', $team])}}">
                <div
                    class="card w-full rounded-md bg-violet-700 text-white font-bold px-4 py-4 drop-shadow-l  transition-all duration-300 transform hover:scale-105 hover:cursor-pointer">
                    {{$team->name}} <span class="text-xs">applied to be {{$team->sponsorTier->name}} sponsor</span>
                </div>
            </a>
        @empty
            <p class="text-violet-600 text-lg">There are currently no sponsorship requests.</p>
        @endforelse
        <div class="pt-2">
            {{ $teams->links() }}
        </div>
    </div>
</x-content-moderator-layout>
