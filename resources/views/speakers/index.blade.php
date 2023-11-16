<x-app-layout>
    <div class="relative bg-cover overflow-hidden min-h-screen">
        <div
            class="before:absolute before:bg-gradient-to-br before:from-gradient-yellow before:via-gradient-pink before:via-gradient-purple before:to-gradient-blue before:opacity-70 before:w-full before:h-full"></div>

        @if(!$speakers->isEmpty())
            <div
                class="isolate px-6 py-6 max-w-7xl mx-auto my-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
                <div class="text-center max-w-2xl mx-auto mb-5">
                    <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">Speakers Line-up</h2>
                </div>
                <ul class="grid-cols-1 gap-y-5 md:gap-x-8 md:gap-y-8 md:grid-cols-3 max-w-none mx-0 grid" role="list">
                    <li class="px-3 py-6 lg:px-10 lg:py-8 sm:col-span-3 grid grid-cols-3 rounded-2xl border-2 shadow dark:bg-gray-800 border-gray-200">
                        <div>
                            <img class="w-56 h-56 rounded-full mx-auto my-auto max-w-full block dark:text-white"
                                 src="img/keynote.png" alt="Photo of ">
                        </div>
                        <div class="sm:col-span-2">
                            <h3 class="tracking-tight leading-7 font-semibold text-xl mt-3 dark:text-white">Keynote Speaker - Jolanda ter Maten</h3>
                            <p class="leading-6 text-sm mt-1 dark:text-gray-200">Jolanda ter Maten is an international trainer, consultant, author and speaker. In addition, she is regularly hired as an expert at the European Commission for "Blockchain Observatory & Forum" and "Horizon2020".
                                                                                               It is her drive to help business leaders worldwide in the transition to a new digital society and has more than 30 years of experience in making the opportunities and possibilities that new technology offers understandable and insightful.
                                                                                               She is the author of the book From Buzz to Bizz: Your strategic guide in a complex world of emerging technologies  in which she simplifies the complex subject matter of new technologies into understandable and easily digestible information
                            </p>
                        </div>
                    </li>
                    @foreach ($speakers as $speaker)
                        <!-- Quick and dirty fix to make sure that only speakers registered as such in the team_user table are displayed -->
                        @if(!$speaker->user->currentTeam || ($speaker->user->currentTeam && $speaker->user->hasTeamRole($speaker->user->currentTeam, 'speaker')))
                            <li class="px-3 py-6 lg:px-10 lg:py-8 rounded-2xl border-2 shadow dark:bg-gray-800 border-gray-200">
                                <img class="w-56 h-56 rounded-full mx-auto my-auto max-w-full block dark:text-white"
                                     src="{{ $speaker->user->profile_photo_url }}"
                                     alt="Photo of {{$speaker->user->name}}">
                                <h3 class="tracking-tight leading-7 font-semibold text-base mt-6 text-center dark:text-white">{{$speaker->user->name}}</h3>
                                <p class="leading-6 text-sm italic text-center dark:text-gray-200">
                                    "{{$speaker->presentation->name}}"</p>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @else
            <div
                class="isolate px-6 py-6 max-w-7xl mx-auto my-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
                <div class="text-center max-w-2xl mx-auto">
                    <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">There are currently no
                                                                                             speakers available.</h2>
                </div>
            </div>
        @endif
    </div>

</x-app-layout>
