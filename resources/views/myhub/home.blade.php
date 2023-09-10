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
                </dl>
            </div>
        </div>
    </div>
</x-hub-layout>
