<x-app-layout>
    <!-- TODO: Responsive version -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Content management dashboard
        </h2>
    </x-slot>
    <div class="relative w-full py-10 pr-10">
        <div
            class="absolute inset-0 bg-gradient-to-br from-gradient-blue via-gradient-pink via-gradient-purple to-gradient-blue py-10 px-10 opacity-75"></div>
        <div class="relative min-h-screen">
            <div class="grid grid-cols-4">
                <div class="pl-24">
                    {{--sidebar--}}
                    <div class="w-4/5 basis-1/4 hidden lg:block md:block">
                        <div
                            class="bg-white dark:bg-gray-800 h-fit sticky overflow-hidden sm:rounded-lg shadow-xl fixed">
                            <div class="px-3 py-4 bg-gray-50 dark:bg-gray-800">
                                <ul class="space-y-2">
                                    <x-sidebar-link :label="'Overview'" :route="'moderator.overview'"/>
                                    <x-sidebar-link :label="'Company requests'" :route="'moderator.requests'"
                                                    :param="'teams'"/>
                                    <x-sidebar-link :label="'Presentation requests'" :route="'moderator.requests'"
                                                    :param="'presentations'"/>
                                    <x-sidebar-link :label="'Booth requests'" :route="'moderator.requests'"
                                                    :param="'booths'"/>
                                    <x-sidebar-link :label="'Sponsorships requests'" :route="'moderator.requests'"
                                                    :param="'sponsorships'"/>
                                    <x-sidebar-link :label="'Schedule management'" :route="'moderator.schedule.overview'"/>
                                    <li class="pt-24">
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf
                                            <button type="submit"
                                                    class="flex w-full items-center p-2 text-gray-800 rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                                <span class="ml-3">Logout</span>
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
