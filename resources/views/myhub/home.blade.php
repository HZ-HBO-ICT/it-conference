@php
    use App\Models\Team;
    use App\Models\Booth;
    use App\Models\Speaker;
    use App\Models\User;use Illuminate\Support\Facades\Auth;
@endphp

<x-hub-layout>
    <div>
        <div class="py-8 px-2 mx-auto max-w-7xl">
            <div>
                <h3 class="leading-6 font-semibold text-xl dark:text-white">Dashboard</h3>
                @if(Auth::user()->currentTeam)
                    <x-company-dashboard-section></x-company-dashboard-section>
                @endif
            </div>
                <h3 class="leading-6 font-semibold text-xl dark:text-white">Notifications</h3>
                <dl class="py-11 px-6">
                    <!-- TODO: Implement on Monday with Daan -->

                    <!-- Inspirational design for the notification -->
                    <!-- https://tailwindui.com/components/application-ui/feedback/alerts reverse engineer the one with title: With link on right 
                    You can also use: With actions-->
                    <div class="px-8 py-12 max-w-7xl mx-auto">
                        <div class="max-w-4xl mx-auto">
                            <div class="p-4 rounded-md bg-blue-300">
                                <div class="flex">
                                    <div class="shrink-0">
                                        <!-- For the SVG use things from heroicons.com -->
                                        <!-- Probably make this a component with fields like: param, icon, alertColor etc -->
                                        <svg class="w-5 h-5 bg-blue-400" xlmns="https://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="white" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"
                                            clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="justify-between flex flex-1 ml-3">
                                        <p class="text-sm text-blue-700">Lorem Ipsum</p>
                                        <p class="mt-0 ml-6 text-sm">
                                            <a class="text-blue-700 font-medium whitespace-nowrap" href="#">
                                                Details
                                                <span aria-hidden="true">-></span>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </dl>
            </div>
        </div>
    </div>
</x-hub-layout>
