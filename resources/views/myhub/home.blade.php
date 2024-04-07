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
                @if(Auth::user()->company)
                    <x-company-dashboard-section></x-company-dashboard-section>
                @endif
                @if(Auth::user()->hasRole('content moderator'))
                    <x-content-moderator-dashboard></x-content-moderator-dashboard>
                @endif
            </div>
                <h3 class="leading-6 font-semibold text-xl dark:text-white">Notifications</h3>
                <dl class="py-11 px-4">
                    <!-- Inspirational design for the notification -->
                    <!-- https://tailwindui.com/components/application-ui/feedback/alerts reverse engineer the one with title: With link on right
                    You can also use: With actions-->
                    <!-- TODO: To be reworked to something prettier -->
                    <div class="px-2 py-2 max-w-7xl mx-auto">
                        <div class="max-w-4xl mx-auto">
                          <!--  livewire('notifications-list') -->
                        </div>
                    </div>

                </dl>
            </div>
        </div>
    </div>
</x-hub-layout>
