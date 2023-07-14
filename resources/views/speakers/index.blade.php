<x-app-layout>
    <div class="relative bg-cover isolate overflow-hidden h-screen" style="background-image: url('/img/teacher.png')">
        {{--gradient--}}
        <div
            class="before:absolute before:bg-gradient-to-r before:from-blue-500 before:to-cyan-500 before:opacity-70 before:h-screen before:w-full"></div>
        {{--red blob--}}
        <img src="/img/red-blob.png"
             class="absolute -left-52 -top-52 h-[34rem] z-0 opacity-75"
             style="transform: rotate(45deg)">
        {{--rose blob--}}
        <img src="/img/rose-blob.png"
             class="absolute bg-cover -bottom-48 -right-48 h-[34rem] z-0 opacity-75"
             style="transform: rotate(50deg) scaleX(-1); overflow:hidden;">
        {{--container for cards with speakers--}}
        <div class="container px-40">
            <div
                class="grid grid-flow-row gap-10 text-neutral-600 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                {{--display speakers in cards --}}
                @foreach($speakers as $speaker)
                    <div
                        class="mt-12 z-20 rounded shadow-lg shadow-gray-200 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1">
                        <figure>
                            <img class="h-72 w-full rounded" alt="speaker" src="{{ $speaker->user->picture }}">
                            <figcaption class="p-4">
                                <p class="text-gray-800 dark:text-gray-200">{{ $speaker->user->name }}</p>
                            </figcaption>
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
