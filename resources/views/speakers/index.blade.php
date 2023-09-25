<x-app-layout>
    @if(!$speakers->isEmpty())
        <div
            class="px-6 py-6 max-w-7xl mx-auto mt-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center max-w-2xl mx-auto mb-5">
                <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">Speakers Line-up</h2>
            </div>
            <ul class="grid-cols-1 gap-y-5 md:gap-x-8 md:gap-y-8 md:grid-cols-3 max-w-none mx-0 grid" role="list">
                @foreach ($speakers as $speaker)
                    <li class="px-3 py-6 lg:px-10 lg:py-8 rounded-2xl border-2 shadow dark:bg-gray-800 border-gray-200">
                        <img class="w-56 h-56 rounded-full mx-auto my-auto max-w-full block dark:text-white"
                             src="{{ $speaker->user->profile_photo_url }}" alt="Photo of {{$speaker->user->name}}">
                        <h3 class="tracking-tight leading-7 font-semibold text-base mt-6 text-center dark:text-white">{{$speaker->user->name}}</h3>
                        <p class="leading-6 text-sm italic text-center dark:text-gray-200">"{{$speaker->presentation->name}}"</p>
                    </li>
                @endforeach
            </ul>
        </div>
        </div>
    @else
        <div
            class="px-6 py-6 max-w-7xl mx-auto mt-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center max-w-2xl mx-auto">
                <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">There are currently no speakers available.</h2>
            </div>
        </div>
    @endif
</x-app-layout>
