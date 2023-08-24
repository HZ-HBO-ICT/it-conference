<x-app-layout>
    @if(!$teams->isEmpty())
    <div class="px-6 py-6 max-w-7xl mx-auto mt-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
        <div class="text-center max-w-2xl mx-auto">
            <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">Companies of 2023</h2>
        </div>
            <ul class="gap-y-16 gap-x-8 grid-cols-2 max-w-2xl grid mt-20 mx-auto" role="list">
                @foreach ($teams as $team)
                <li class="border rounded border-gray-300">
                    <img class="object-cover rounded-2xl w-full aspect-auto[3/2] h-auto" src="TODO: when variable name is known" alt="Logo of {{$team->name}}">
                    <h3 class="tracking-tight leading-8 font-semibold text-lg mt-6">{{$team->name}}</h3>
                    <a class="" href="//{{$team->website}}">{{$team->website}}</a>
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