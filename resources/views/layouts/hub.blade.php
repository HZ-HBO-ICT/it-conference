@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Presentation;
@endphp

<x-app-layout>
    <div class="flex">
        <div class="flex-col w-72 flex inset-y-0 relative bg-white dark:bg-gray-900 h-screen">
            <div
                class="pb-4 px-6 border-r border-b border-t dark:border-gray-800 overflow-y-auto flex-col flex-grow flex">
                <div class="items-center flex-shrink-0 h-16 flex mt-4">
                    <img class="w-auto h-8" src="{{ url('/img/logo-small-' . Auth::user()->roleColour . '.png') }}"
                         alt="IT Conference logo">
                    <h3 class="ml-4 font-semibold dark:text-white">My hub</h3>
                </div>
                <nav class="flex-col flex-1 flex">
                    <ul class="gap-y-7 flex-col flex-1 flex" role="list">
                        <ul class="mt-2 -mx-2" role="list">
                            {{-- Home link --}}
                            <x-sidebar-link
                                :type="'link'"
                                :label="'Home'"
                                :route="'dashboard'"
                                :icon="'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25'"
                                :roleColour="Auth::user()->role_colour"/>
                            {{--<x-content-moderator-sidebar-link-content-mod
                                :label="'My programme'"
                                :route="'my.programme'"
                                :icon="'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z'"
                                :roleColour="Auth::user()->role_colour"></x-content-moderator-sidebar-link-content-mod>--}}
                            {{-- Presentation links --}}
                            @if(!Auth::user()->company)
                                @can('request', \App\Models\Presentation::class)
                                    <x-sidebar-link
                                        :type="'link'"
                                        :label="'Request presentation'"
                                        :route="'presentations.create'"
                                        :icon="'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6'"
                                        :roleColour="Auth::user()->role_colour"></x-sidebar-link>
                                @endcan
                            @endif
                            @if(Auth::user()->presenterOf)
                                <x-sidebar-link
                                    :type="'link'"
                                    :label="'My presentation'"
                                    :route="'presentations.show'"
                                    :param="Auth::user()->presenterOf"
                                    :icon="'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6'"
                                    :roleColour="Auth::user()->role_colour"></x-sidebar-link>
                            @endif
                        </ul>

                        {{-- Role dependant links --}}
                        @if(Auth::user()->hasRole('event organizer'))
                            <x-sidemenus.content-moderator></x-sidemenus.content-moderator>
                        @endif
                        @if(Auth::user()->company)
                            <x-sidemenus.company></x-sidemenus.company>
                        @endif

                        {{-- Profile links --}}
                        <li>
                            <div class="leading-6 font-semibold text-xs text-gray-400">Profile</div>
                            <ul class="mt-2 -mx-2 mb-auto" role="list">
                                <x-sidebar-link
                                    :type="'link'"
                                    :label="'Edit profile'"
                                    :route="'profile.show'"
                                    :icon="'M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z'"
                                    :roleColour="Auth::user()->role_colour"></x-sidebar-link>
                                <x-sidebar-link
                                    :type="'form'"
                                    :label="'Logout'"
                                    :route="'logout'"
                                    :icon="'M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75'"
                                    :roleColour="Auth::user()->role_colour"></x-sidebar-link>
                            </ul>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
        <!-- Content -->
        <div class="flex-grow max-h-screen overflow-y-auto bg-gray-100 dark:bg-gray-900">
            {{ $slot }}
        </div>
    </div>
</x-app-layout>
