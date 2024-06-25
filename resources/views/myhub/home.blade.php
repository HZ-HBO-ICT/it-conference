@php
    use App\Models\Team;
    use App\Models\Booth;
    use App\Models\Speaker;
    use App\Models\User;use Illuminate\Support\Facades\Auth;
@endphp

<x-hub-layout>
    <div>
        <div class="py-8 px-8 mx-auto max-w-7xl">
            <div>
                <h3 class="leading-6 font-semibold text-xl dark:text-white">Dashboard</h3>
                @if(Auth::user()->company)
                    <x-dashboards.company/>
                @endif
                @if(Auth::user()->hasRole('event organizer'))
                    <x-dashboards.crew/>
                @endif
            </div>
        </div>
    </div>
</x-hub-layout>
