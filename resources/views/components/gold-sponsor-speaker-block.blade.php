<dl class="pt-11 pb-5 px-6">
    <div
        class="py-5 px-4 rounded-lg overflow-hidden relative bg-amber-100 dark:bg-amber-900 shadow-md dark:shadow-md">
        <dt>
            <div class="p-3 rounded-md absolute bg-orange-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="white"
                     aria-hidden="true" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                </svg>
            </div>
            <p class="ml-16 font-semibold text-md text-gray-500 dark:text-gray-100 overflow-hidden text-ellipsis">
                Your company is the gold sponsor for the "We are in IT Together" Conference. As such your company can
                have two presentations. As you have been invited as a speaker from your company representative
            {{Auth::user()->currentTeam->allPresentations->count() == 0 ? "you have to request a presentation." : "you have
            a choice."}}
        </dt>
        <dd class="pt-4">
            <div class="grid place-items-center">
                @if(Auth::user()->currentTeam->allPresentations->count() < 2)
                    <a href="{{route('speakers.request.presentation')}}"
                       class="flex items-center bg-gray-100 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-900 text-gray-600 dark:text-white font-semibold justify-center py-2 px-4 w-3/4 rounded-lg transition duration-300 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                             class="w-6 h-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Request a presentation</span>
                    </a>
                    @if(Auth::user()->currentTeam->allPresentations->count() > 0)
                        <p class="font-semibold py-2 text-md text-gray-500 dark:text-gray-100 overflow-hidden text-ellipsis">
                            or
                        </p>
                    @endif
                @endif
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
                        @if(Auth::user()->currentTeam->allPresentations->count() == 2 && $index == 0)
                            <p class="font-semibold py-2 text-md text-gray-500 dark:text-gray-100 overflow-hidden text-ellipsis">
                                or
                            </p>
                        @endif
                    @endforeach
                @endif
            </div>
        </dd>
    </div>
</dl>
