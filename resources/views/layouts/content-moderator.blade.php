<x-app-layout>
    <div class="bg-cover isolate overflow-hidden h-screen"
         style="background-image: url('/img/hz-building.jpg')">
        <div style="z-index: -1 !important;"
             class="relative before:absolute before:bg-gradient-to-br before:from-gradient-blue before:via-gradient-pink before:via-gradient-purple before:to-gradient-blue before:opacity-70 before:h-screen before:w-full"></div>
        <div class="py-10 px-10">
            <div class="grid grid-cols-4">
                <div class="pl-10">
                    {{--sidebar--}}
                    <div class="w-fit basis-1/4 hidden pl-8 lg:block md:block">
                        <div
                            class="bg-white dark:bg-gray-800 h-fit sticky overflow-hidden sm:rounded-lg shadow-xl fixed">
                            <div class="px-3 py-4 bg-gray-50 dark:bg-gray-800">
                                <ul class="space-y-2">
                                    <li>
                                        <a href="{{ route('moderator.overview') }}"
                                           class="flex items-center p-2 text-gray-800 rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 group @if(request()->routeIs('announcements')) dark:bg-gray-700 @endif">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-gray-200" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                 viewBox="0 0 18 19">
                                                <path
                                                    d="M15 1.943v12.114a1 1 0 0 1-1.581.814L8 11V5l5.419-3.871A1 1 0 0 1 15 1.943ZM7 4H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2v5a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V4ZM4 17v-5h1v5H4ZM16 5.183v5.634a2.984 2.984 0 0 0 0-5.634Z"/>
                                            </svg>
                                            <span class="ml-3">Overview</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('my-profile') }}"
                                           class="flex items-center p-2 text-gray-800 rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 group @if(request()->routeIs('my-profile')) dark:bg-gray-700 @endif">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-gray-200" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                 viewBox="0 0 14 18">
                                                <path
                                                    d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                                            </svg>
                                            <span class="ml-3">My profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('my-programme') }}"
                                           class="flex items-center p-2 text-gray-800 rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 group @if(request()->routeIs('my-programme')) dark:bg-gray-700 @endif">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-gray-200" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                 viewBox="0 0 18 20">
                                                <path
                                                    d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v2H7V2ZM5 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-4a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm8 4H8a1 1 0 0 1 0-2h5a1 1 0 0 1 0 2Zm0-4H8a1 1 0 0 1 0-2h5a1 1 0 1 1 0 2Z"/>
                                            </svg>
                                            <span class="ml-3">My programme</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="pt-4 mt-20">
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf
                                            <button type="submit"
                                                    class="flex w-full items-center p-2 text-gray-800 rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                                <svg class="w-6 h-6 text-gray-800 dark:text-gray-200" aria-hidden="true"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M4 8h11m0 0-4-4m4 4-4 4m-5 3H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h3"/>
                                                </svg>
                                                <span class="ml-3">Logout</span>
                                            </button>
                                        </form>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{--sidebar for smartphones--}}
                    <div class="z-30 w-[4rem] left-0 rounded-lg md:hidden lg:hidden">
                        <div class="bg-white dark:bg-gray-800 h-fit overflow-hidden rounded-lg shadow-xl fixed">
                            <div class="px-3 py-4 bg-gray-50 dark:bg-gray-800">
                                <ul class="space-y-2">
                                    <li>
                                        <a href="{{ route('announcements') }}"
                                           class="flex items-center p-2 text-gray-800 rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 group @if(request()->routeIs('announcements')) dark:bg-gray-700 @endif">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-gray-200" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                 viewBox="0 0 18 19">
                                                <path
                                                    d="M15 1.943v12.114a1 1 0 0 1-1.581.814L8 11V5l5.419-3.871A1 1 0 0 1 15 1.943ZM7 4H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2v5a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V4ZM4 17v-5h1v5H4ZM16 5.183v5.634a2.984 2.984 0 0 0 0-5.634Z"/>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('my-profile') }}"
                                           class="flex items-center p-2 text-gray-800 rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 group @if(request()->routeIs('my-profile')) dark:bg-gray-700 @endif">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-gray-200" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                 viewBox="0 0 14 18">
                                                <path
                                                    d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('my-programme') }}"
                                           class="flex items-center p-2 text-gray-800 rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 group @if(request()->routeIs('my-programme')) dark:bg-gray-700 @endif">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-gray-200" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                 viewBox="0 0 18 20">
                                                <path
                                                    d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v2H7V2ZM5 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-4a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm8 4H8a1 1 0 0 1 0-2h5a1 1 0 0 1 0 2Zm0-4H8a1 1 0 0 1 0-2h5a1 1 0 1 1 0 2Z"/>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="pt-4 mt-20">
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf
                                            <button type="submit"
                                                    class="flex w-full items-center p-2 text-gray-800 rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                                <svg class="w-6 h-6 text-gray-800 dark:text-gray-200" aria-hidden="true"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M4 8h11m0 0-4-4m4 4-4 4m-5 3H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h3"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-100 dark:bg-gray-800 pl-9 py-5 rounded" style="grid-column: span 3">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
