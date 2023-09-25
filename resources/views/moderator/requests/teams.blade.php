<x-hub-layout>
    <h1 class="text-4xl font-extrabold text-gray-700 dark:text-white ml-4 py-5">Company requests</h1>
    <div class="pr-12 pl-4">
        <h2 class="text-2xl text-gray-700 dark:text-white">Companies currently awaiting approval</h2>
            <div class="px-8 py-6 max-w-7xl mx-auto">
                <div class="max-w-none mx-auto">
                    <div class="rounded-lg bg-white dark:bg-slate-700 overflow-hidden">
                        <div class="px-6 py-5 bg-white dark:bg-slate-700 border-b dark:border-gray-500">
                            <div class="flex-nowrap justify-between items-center flex -mt-2 -ml-4">
                                <div class="mt-2 ml-4">
                                    <h3 class="text-gray-900 dark:text-white leading-6 font-semibold text-base">Open requests</h3>
                                </div>
                                <div class="shrink-0 mt-2 ml-4">
                                    <!-- Add hover effects -->
                                    <a href="{{route('teams.create', ['teams'])}}" class="shadow-sm dark:shadow-s text-white font-semibold text-sm py-2 px-3 bg-crew-400 rounded-md items-center inline-flex relative">
                                        Create new company
                                    </a>
                                </div>
                            </div>
                        </div>
                        <ul role="list">
                            @forelse($teams as $index => $team)
                                <!--  -->
                                <li>
                                    <a href="{{route('moderator.request.details', ['teams', $team])}}" class="block">
                                        <div class="px-6 py-6 hover:bg-crew-100 dark:hover:bg-slate-600">
                                            <div class="justify-between flex mt-2">
                                                <div class="flex">
                                                    <div class="text-gray-700 dark:text-white text-m items-center flex">
                                                        <svg class="shrink-0 w-6 h-6 mr-1.5 block stroke-crew-400" xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none" aria-hidden="true">
                                                            <path d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"></path>
                                                        </svg>
                                                        {{$team->name}}
                                                    </div>
                                                </div>
                                                <div class="text-sm items-center flex ml-2 dark:text-white">
                                                    <svg class="shrink-0 w-6 h-6 mr-1.5 block stroke-crew-400" xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{$team->created_at->format('d/m/Y')}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <p class="text-crew-400 text-lg justify-center flex m-12">There are currently no new companies waiting on approval.</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </a>
        @empty
            <p class="text-violet-600 text-lg">There are currently no sponsorship requests.</p>
        @endforelse
        <div class="pt-2">
            {{ $teams->links() }}
        </div>
    </div>
</x-hub-layout>
