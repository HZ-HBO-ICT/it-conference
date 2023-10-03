<x-app-layout>
    @if(!$teams->isEmpty())
        <div
            class="px-6 py-6 max-w-7xl mx-auto mt-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center max-w-2xl mx-auto mb-5">
                <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">Conference Line-up</h2>
            </div>
            <ul class="grid-cols-1 gap-y-5 md:gap-x-8 md:gap-y-8 md:grid-cols-3 max-w-none mx-0 grid" role="list">
                @foreach ($teams as $team)
                    <li class="px-3 py-6 lg:px-10 lg:py-8 rounded-2xl border-2 shadow dark:bg-gray-800
                    @if ($team->sponsor_tier_id === 1 && $team->is_sponsor_approved === 1) border-gold dark:border-gold
                    @elseif ($team->sponsor_tier_id === 2 && $team->is_sponsor_approved === 1) border-silver dark:border-silver
                    @elseif ($team->sponsor_tier_id === 3 && $team->is_sponsor_approved === 1) border-bronze dark:border-bronze
                    @else border-gray-200 dark:border-gray-500 @endif">
                        @if($team->logo_path)
                            <img class="object-scale-down w-56 h-56 mx-auto my-auto max-w-full block dark:text-white"
                                 src="{{ url('storage/'. $team->logo_path) }}" alt="Logo of {{$team->name}}">
                        @else
                            @php
                                $color = '';
                                 if ($team->sponsor_tier_id === 1 && $team->is_sponsor_approved === 1) $color='#FFD700';
                                 elseif ($team->sponsor_tier_id === 2 && $team->is_sponsor_approved === 1) $color='#C0C0C0';
                                 elseif ($team->sponsor_tier_id === 3 && $team->is_sponsor_approved === 1) $color='#CD7F32';
                                 else $color='#60a5fa'
                            @endphp
                            <div
                                class="flex items-center justify-center w-56 h-56 rounded-full mx-auto my-auto max-w-full block dark:text-white border-2
                                @if ($team->sponsor_tier_id === 1 && $team->is_sponsor_approved === 1) border-gold dark:border-gold
                                @elseif ($team->sponsor_tier_id === 2 && $team->is_sponsor_approved === 1) border-silver dark:border-silver
                                @elseif ($team->sponsor_tier_id === 3 && $team->is_sponsor_approved === 1) border-bronze dark:border-bronze
                                @else border-blue-400 dark:border-blue-400 @endif">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="{{$color}}" aria-hidden="true" class="w-24 h-24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                                </svg>
                            </div>
                        @endif
                        <h3 class="tracking-tight leading-7 font-semibold text-base mt-6 text-center dark:text-white">{{$team->name}}</h3>
                        <p class="leading-6 text-sm text-center dark:text-gray-200">
                            {{substr($team->description, 0, 70) . '...' }}
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>
        </div>
    @else
        <div
            class="px-6 py-6 max-w-7xl mx-auto mt-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center max-w-2xl mx-auto">
                <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">There are currently no
                                                                                         companies registered. Check
                                                                                         back later!</h2>
            </div>
        </div>
    @endif
</x-app-layout>
