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
                                <x-sidebar-link-content-mod :label="'Dashboard'" :route="'moderator.overview'" :icon=""/>
                                <x-sidebar-link-content-mod :label="'Company requests'" :route="'moderator.requests'" :icon="" :param="'teams'"/>
                                <x-sidebar-link-content-mod :label="'Presentation requests'" :route="'moderator.requests'" :icon="" :param="'presentations'"/>
                                <x-sidebar-link-content-mod :label="'Booth requests'" :route="'moderator.requests'" :icon="" :param="'booths'"/>
                                <x-sidebar-link-content-mod :label="'Sponsorship requests'" :route="'moderator.requests'" :icon="" :param="'sponsorships'"/>
                                <x-sidebar-link-content-mod :label="'Schedule management'" :route="'moderator.schedule.overview'" :icon=""/>
                            </ul>
                        </li>
                        <!-- Profile Links -->
                        <li>
                            <div class="leading-6 font-semibold text-xs text-gray-400">Profile</div>
                            <ul class="mt-2 -mx-2 mb-auto" role="list">
                                <x-sidebar-link-content-mod :label="'Edit profile'" :route="'profile.show'" :icon=""/>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Content -->
        <div class="flex-grow max-h-screen overflow-y-auto bg-gray-100">
            {{ $slot }}
        </div>
    </div>
</x-app-moderator-layout>
