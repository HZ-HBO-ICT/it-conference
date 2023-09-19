@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Presentation;
@endphp

<x-app-moderator-layout>
    <div class="flex">
        <div class="flex-col w-72 flex z-50 inset-y-0 relative bg-white dark:bg-gray-900 h-screen">
            <div
                class="pb-4 px-6 border-r border-b border-t dark:border-gray-800 overflow-y-auto gap-y-5 flex-col flex-grow flex">
                <div class="items-center flex-shrink-0 h-16 flex mt-4">
                    <!-- TODO: Style heading -->
                    <h3 class="font-semibold dark:text-white">My hub</h3>
                </div>
                <nav class="flex-col flex-1 flex">
                    <ul class="gap-y-3 flex-col flex-1 flex" role="list">
                        <!-- Company Links -->
                        <li>
                            <ul class="-mx-2" role="list">
                                <x-sidebar-link
                                    :type="'link'"
                                    :label="'Home'"
                                    :route="'announcements'"
                                    :icon="'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25'"
                                    :roleColour="'partner'"/>
                            </ul>
                        </li>
                        @if(Auth::user()->currentTeam)
                            <li>
                                <div class="leading-6 font-semibold text-xs text-gray-400">Company</div>
                                <ul class="-mx-2" role="list">
                                    <x-sidebar-link
                                        :type="'link'"
                                        :label="'Company details'"
                                        :route="'teams.show'"
                                        :icon="'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z'"
                                        :param="Auth::user()->currentTeam->id"
                                        :roleColour="'partner'"/>
                                    @if(Auth::user()->currentTeam->owner->id == Auth::user()->id)
                                        <x-sidebar-link
                                            :type="'link'"
                                            :label="'Requests'"
                                            :route="'teams.requests'"
                                            :icon="'M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z'"
                                            :param="Auth::user()->currentTeam"
                                            :roleColour="'partner'"/>
                                    @endif
                                    @can('request', \App\Models\Presentation::class)
                                        @unlessrole('content moderator')
                                        <x-sidebar-link
                                            :type="'link'"
                                            :label="'Request presentation'"
                                            :route="'speakers.request.presentation'"
                                            :icon="'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6'"
                                            :roleColour="'partner'"/>
                                        @endunlessrole
                                    @endcan
                                    @if(Auth::user()->speaker)
                                        <x-sidebar-link
                                            :type="'link'"
                                            :label="'View presentation'"
                                            :route="'presentations.show'"
                                            :param="Auth::user()->speaker->presentation"
                                            :icon="'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6'"
                                            :roleColour="'partner'"/>
                                    @endif
                                </ul>
                            </li>
                        @else
                            @can('request', \App\Models\Presentation::class)
                        @unlessrole('content moderator')
                            <li>
                                <ul class="-mx-2" role="list">
                                    <x-sidebar-link
                                        :type="'link'"
                                        :label="'Request presentation'"
                                        :route="'speakers.request.presentation'"
                                        :icon="'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6'"
                                        :roleColour="'partner'"/>
                                </ul>
                            </li>
                        @endunlessrole
                            @endcan
                            @if(Auth::user()->speaker)
                                <li>
                                    <ul class="-mx-2" role="list">
                                        <x-sidebar-link
                                            :type="'link'"
                                            :label="'View presentation'"
                                            :route="'presentations.show'"
                                            :param="Auth::user()->speaker->presentation"
                                            :icon="'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6'"
                                            :roleColour="'partner'"/>
                                    </ul>
                                </li>
                            @endcan
                        @endif


                        <!-- Profile Links -->
                        <li>
                            <div class="leading-6 font-semibold text-xs text-gray-400">Profile</div>
                            <ul class="mt-2 -mx-2 mb-auto" role="list">
                                <x-sidebar-link
                                    :type="'link'"
                                    :label="'My programme'"
                                    :route="'my-programme'"
                                    :icon="'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605'"
                                    :roleColour="'partner'"/>
                                <x-sidebar-link
                                    :type="'link'"
                                    :label="'Edit profile'"
                                    :route="'profile.show'"
                                    :icon="'M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z'"
                                    :roleColour="'partner'"/>
                                <x-sidebar-link
                                    :type="'form'"
                                    :label="'Logout'"
                                    :route="'logout'"
                                    :icon="'M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75'"
                                    :roleColour="'partner'"/>
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
</x-app-moderator-layout>
