<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Presentations') }}
        </h1>
        <div class="pt-5">
            <h2 class="text-2xl text-gray-700 dark:text-white">Overview of all the presentations awaiting scheduling</h2>
            <div class="px-8 py-6 max-w-7xl mx-auto">
                <div class="max-w-none mx-auto">
                    <div class="rounded-lg bg-white dark:bg-slate-700 overflow-hidden">
                        <div class="px-6 py-5 bg-white dark:bg-slate-700 border-b dark:border-gray-500">
                            <div class="flex-nowrap justify-between items-center flex -mt-2 -ml-4">
                                <div class="mt-2 ml-4">
                                    <h3 class="text-gray-900 dark:text-white leading-6 font-semibold text-base">All presentations</h3>
                                </div>
                            </div>
                        </div>
                        <ul role="list">
                            @forelse($presentations as $index => $presentation)
                                <li>
                                    <div
                                        class="px-6 py-6 hover:bg-crew-100 dark:hover:bg-slate-600">
                                        <div class="justify-between flex mt-2">
                                            <div class="flex">
                                                <div class="text-gray-700 dark:text-white text-m items-center flex">
                                                    <svg class="shrink-0 w-6 h-6 mr-1.5 block stroke-crew-400"
                                                         xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23"
                                                         fill="none" aria-hidden="true">
                                                        <path
                                                            d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"></path>
                                                    </svg>
                                                    <div class="ml-2 flex-grow">
                                                        <strong>{{$presentation->name}}</strong>
                                                        <br/>
                                                        <span
                                                            class="text-sm text-gray-500">{{ $presentation->speakernames }}</span>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="text-sm items-center gap-2 flex ml-2 dark:text-white">
                                                <a href="{{route('moderator.presentations.show', $presentation)}}">
                                                    <div class="relative group">
                                                        <div
                                                            class="bg-gray-100 text-crew-400 dark:bg-slate-800 p-2 rounded-md flex items-center"
                                                            id="tooltip-trigger">
                                                            <svg class="shrink-0 w-6 h-6 block stroke-crew-400"
                                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23"
                                                                 fill="none" aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                                            </svg>
                                                        </div>
                                                        <div
                                                            class="tooltip absolute bg-gray-50 text-crew-300 dark:bg-slate-900 dark:text-crew-300 p-2 rounded-md text-center opacity-0 invisible group-hover:opacity-90 group-hover:visible transition-all duration-300 transform -translate-x-1/2 left-1/2 top-10">
                                                            View
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="{{route('moderator.schedule.presentation', $presentation)}}">
                                                    <div class="relative group">
                                                        <div
                                                            class="bg-gray-100 text-crew-400 dark:bg-slate-800 p-2 rounded-md flex items-center"
                                                            id="tooltip-trigger">
                                                            <svg class="shrink-0 w-6 h-6 block stroke-crew-400"
                                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23"
                                                                 fill="none" aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <div
                                                            class="tooltip absolute bg-gray-50 text-crew-300 dark:bg-slate-900 dark:text-crew-300 p-2 rounded-md text-center opacity-0 invisible group-hover:opacity-90 group-hover:visible transition-all duration-300 transform -translate-x-1/2 left-1/2 top-10">
                                                            Manual
                                                            scheduling
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <p class="text-crew-400 text-lg justify-center flex m-12">There are currently no new
                                                                                          presentations waiting on
                                                                                          approval.</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-hub-layout>
