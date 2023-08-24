<x-app-layout>
    @if(!$teams->isEmpty())
    <div class="px-6 py-6 max-w-7xl mx-auto mt-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
        <div class="text-center max-w-2xl mx-auto mb-5">
            <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">Conference Line-up</h2>
        </div>
            <ul class="gap-x-8 gap-y-8 grid-cols-3 max-w-none mx-0 grid" role="list">
                @foreach ($teams as $team)
                    <li class="px-10 py-8 rounded-2xl border border-gray-300 shadow">
                        <img class="w-56 h-56 rounded-full mx-auto my-auto max-w-full block" src="./img/teacher.png" alt="Logo of {{$team->name}}">
                        <h3 class="tracking-tight leading-7 font-semibold text-base mt-6 text-center">{{$team->name}}</h3>
                        <p class="leading-6 text-sm text-center">{{$team->description}}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @else
        <div class="px-6 py-6 max-w-7xl mx-auto mt-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center max-w-2xl mx-auto">
                <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">There are currently no companies registered. Check back later!</h2>
            </div>
        </div>
    @endif
</x-app-layout>