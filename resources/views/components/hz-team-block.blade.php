<div>
    @if(Auth::user()->ownsTeam(Auth::user()->currentTeam))
        <dl class="pt-11 pb-5 px-6">
            <div
                class="py-5 px-4 rounded-lg overflow-hidden relative bg-sky-100 dark:bg-sky-900 shadow-md dark:shadow-md">
                <dt>
                    <div class="p-3 rounded-md absolute bg-sky-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="white"
                             aria-hidden="true" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                        </svg>
                    </div>
                    <p class="ml-16 font-semibold text-md text-gray-500 dark:text-gray-100 overflow-hidden text-ellipsis">
                        You are the team manager of the HZ University of Applied Sciences.
                        @can('request', \App\Models\Presentation::class)
                        As such you can request presentation, invite others to present and join their presentation. As
                        HZ
                        UAS there is no limit on presentations, except one person can participate in a single
                        presentation.
                        @endcan
                        @cannot('request', \App\Models\Presentation::class)
                        You already have requested presentation, but you still can invite others to present. As HZ
                        UAS there is no limit on presentations, except one person can participate in a single
                        presentation.
                    @endcannot
                </dt>
                <dd class="pt-4">
                    <div class="grid place-items-center">
                        @can('request', \App\Models\Presentation::class)
                            <a href="{{route('speakers.request.presentation')}}"
                               class="flex items-center bg-gray-100 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-900 text-gray-600 dark:text-white font-semibold justify-center py-2 px-4 w-3/4 rounded-lg transition duration-300 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     class="w-6 h-6 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span>Request a presentation</span>
                            </a>
                            <p class="font-semibold py-2 text-md text-gray-500 dark:text-gray-100 overflow-hidden text-ellipsis">
                                or
                            </p>
                        @endcan
                        <a href="{{route('teams.show', Auth::user()->currentTeam->id)}}"
                           class="flex items-center bg-gray-100 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-900 text-gray-600 dark:text-white font-semibold justify-center py-2 px-4 w-3/4 rounded-lg transition duration-300 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"></path>
                            </svg>
                            <span>Invite people to join HZ UAS</span>
                        </a>
                    </div>
                </dd>
            </div>
        </dl>
    @endif
    @can('request', App\Models\Presentation::class)
        <dl class="pt-3 pb-5 px-6">
            <div
                class="py-5 px-4 rounded-lg overflow-hidden relative bg-sky-100 dark:bg-sky-900 shadow-md dark:shadow-md">
                <dt>
                    <div class="p-3 rounded-md absolute bg-sky-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="white"
                             aria-hidden="true" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"/>
                        </svg>
                    </div>
                    <p class="ml-16 pt-3 font-semibold text-md text-gray-500 dark:text-gray-100 overflow-hidden text-ellipsis">
                        As a member of the HZ team you can <a>request a presentation</a> or join one of the
                        presentations
                        shown below.
                    </p>
                </dt>
                <dd class="pt-4">
                    <div class="grid place-items-center gap-3">
                        @if(Auth::user()->currentTeam->allPresentations->count() > 0)
                            @foreach(Auth::user()->currentTeam->allPresentations->unique() as $index => $presentation)
                                <form action="{{route('cohost.presentation', $presentation)}}" method="POST">
                                    @csrf
                                    <button
                                        class="flex items-center bg-gray-100 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-900 text-gray-600 dark:text-white font-semibold justify-center py-3 px-6 w-full rounded-lg transition duration-300 ease-in-out break-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             class="w-6 h-6 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"/>
                                            </path>
                                        </svg>
                                        <span>Join {{$presentation->mainSpeaker()->user->name}} as a co-speaker in their presentation named {{$presentation->name}}</span>
                                    </button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                </dd>
            </div>
        </dl>
    @endcan
</div>
