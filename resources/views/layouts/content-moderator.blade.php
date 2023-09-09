<x-app-moderator-layout>
    <div class="flex">
        <div class="flex-col w-72 flex z-50 inset-y-0 relative bg-white dark:bg-gray-900 h-screen">
            <div class="pb-4 px-6 border-r border-b border-t dark:border-gray-800 overflow-y-auto gap-y-5 flex-col flex-grow flex">
                <div class="items-center flex-shrink-0 h-16 flex mt-4">
                    <!-- TODO: Style heading -->
                    <h3 class="font-semibold dark:text-white">Content Management Dashboard</h3>
                </div>
                <nav class="flex-col flex-1 flex">
                    <ul class="gap-y-7 flex-col flex-1 flex" role="list">
                        <!-- Content Management Links -->
                        <li>
                            <ul class="-mx-2" role="list">
                                <x-sidebar-link-content-mod 
                                :label="'Dashboard'" 
                                :route="'moderator.overview'"
                                :icon="'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25'"
                                :roleColour="'crew'"/>
                                <x-sidebar-link-content-mod 
                                :label="'Company requests'" 
                                :route="'moderator.requests'" 
                                :icon="'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z'" 
                                :param="'teams'"
                                :roleColour="'crew'"/>
                                <x-sidebar-link-content-mod 
                                :label="'Presentation requests'" 
                                :route="'moderator.requests'" 
                                :icon="'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6'" 
                                :param="'presentations'"
                                :roleColour="'crew'"/>
                                <x-sidebar-link-content-mod 
                                :label="'Booth requests'" 
                                :route="'moderator.requests'" 
                                :icon="'M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z'" 
                                :param="'booths'"
                                :roleColour="'crew'"/>
                                <x-sidebar-link-content-mod 
                                :label="'Sponsorship requests'" 
                                :route="'moderator.requests'" 
                                :icon="'M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z'" 
                                :param="'sponsorships'"
                                :roleColour="'crew'"/>
                                <x-sidebar-link-content-mod 
                                :label="'Schedule management'" 
                                :route="'moderator.schedule.overview'" 
                                :icon="'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5'"
                                :roleColour="'crew'"/>
                            </ul>
                        </li>
                        <!-- Profile Links -->
                        <li>
                            <div class="leading-6 font-semibold text-xs text-gray-400">Profile</div>
                            <ul class="mt-2 -mx-2 mb-auto" role="list">
                                <x-sidebar-link-content-mod 
                                :label="'Edit profile'" 
                                :route="'profile.show'" 
                                :icon="'M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z'"
                                :roleColour="'crew'"/>
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
