@php
    $borderColor = 'bg-gradient-to-r from-blue-300 via-blue-400 to-blue-500'; // Default
    $linkColor = 'text-blue-400 hover:text-blue-600';
    $iconColor = 'stroke-blue-400 dark:stroke-blue-400';
@endphp

<x-app-layout>
    <div class="container mx-auto px-6 py-12">
        <h2 class="text-center text-gray-900 dark:text-gray-50 text-5xl font-extrabold bg-clip-text bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400 mb-12">
            Our Companies
        </h2>
        @if(!$companies->isEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($companies as $company)
                    @php
                        if($company->is_sponsorship_approved) {
                            switch ($company->sponsorship_id) {
                                case 1:
                                    $borderColor = 'bg-gradient-to-r from-yellow-300 to-yellow-600'; // Gold
                                    $linkColor = 'text-yellow-400 hover:text-yellow-500';
                                    $iconColor = 'stroke-yellow-400 hover:stroke-yellow-500';
                                    break;
                                case 2:
                                    $borderColor = 'bg-gradient-to-r from-gray-300 to-gray-600'; // Silver
                                    $linkColor = 'text-gray-600 hover:text-gray-700';
                                    $iconColor = 'stroke-gray-600 hover:stroke-gray-700';
                                    break;
                                case 3:
                                    $borderColor = 'bg-gradient-to-r from-orange-300 to-orange-600'; // Bronze
                                    $linkColor = 'text-orange-400 hover:text-orange-500';
                                    $iconColor = 'stroke-orange-400 hover:stroke-orange-500';
                                    break;
                            }
                        } else {
                            $borderColor = 'bg-gradient-to-r from-blue-300 via-blue-400 to-blue-500'; // Default
                            $linkColor = 'text-blue-400 hover:text-blue-600';
                            $iconColor = 'stroke-blue-400 dark:stroke-blue-400';
                        }
                    @endphp
                    <a href="{{route('companies.show', $company)}}" class="{{$linkColor}}">
                        <div
                                class="relative min-h-full bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden transform transition-all hover:bg-gray-100 dark:hover:bg-gray-900">
                            <div class="absolute top-0 left-0 w-full h-2 {{$borderColor}}"></div>
                            <div class="p-8 flex flex-col items-center">
                                <div class="relative w-56 h-56 mb-6">
                                    @if($company->logo_path)
                                        <div class="absolute inset-0 rounded-full opacity-75 blur-lg"></div>
                                        <img class="relative w-56 h-56 rounded-full object-contain {{$company->dark_logo_path ? 'dark:hidden' : ''}}"
                                             src="{{url('storage/'. $company->logo_path) }}"
                                             alt="Profile picture of {{$company->name}}">
                                        @if($company->dark_logo_path)
                                            <img class="relative w-56 h-56 rounded-full object-contain hidden dark:block"
                                                 src="{{url('storage/'. $company->dark_logo_path) }}"
                                                 alt="Profile picture of {{$company->name}}">
                                        @endif
                                    @else
                                        <div class="absolute inset-0 rounded-full opacity-75 blur-lg"></div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1"
                                             stroke="gray" aria-hidden="true" class="w-56 h-56 {{$iconColor}}">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                                        </svg>
                                    @endif
                                </div>
                                <h3 class="font-bold text-2xl text-gray-900 dark:text-white text-center">{{$company->name}}</h3>
                                <p class="mt-4 text-gray-600 dark:text-gray-400 text-center">{{strlen($company->description) > 165 ? substr($company->description, 0, 165) . '...' : $company->description}}</p>
                            </div>
                            <div class="absolute bottom-0 left-0 w-full h-2 {{$borderColor}}"></div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 rounded py-2">
                <p class="text-center text-2xl font-bold">
                    There are no companies available right now.
                </p>
            </div>
    @endif

{{--    <div class="relative bg-cover overflow-hidden min-h-screen">--}}
{{--        <div--}}
{{--            class="before:absolute before:bg-gradient-to-br before:from-gradient-yellow before:via-gradient-pink before:via-gradient-purple before:to-gradient-blue before:opacity-70 before:w-full before:h-full"></div>--}}
{{--        @if(!$teams->isEmpty())--}}
{{--            <div--}}
{{--                class="isolate px-6 py-6 max-w-7xl mx-auto my-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">--}}
{{--                <div class="text-center max-w-2xl mx-auto mb-5">--}}
{{--                    <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">Conference Line-up</h2>--}}
{{--                </div>--}}
{{--                <ul class="grid-cols-1 gap-y-5 md:gap-x-8 md:gap-y-8 md:grid-cols-3 max-w-none mx-0 grid" role="list">--}}
{{--                    @foreach ($teams as $team)--}}
{{--                        <li class="px-3 py-6 lg:px-10 lg:py-8 rounded-2xl border-2 shadow dark:bg-gray-800--}}
{{--                    @if ($team->sponsor_tier_id === 1 && $team->is_sponsor_approved === 1) border-gold dark:border-gold--}}
{{--                    @elseif ($team->sponsor_tier_id === 2 && $team->is_sponsor_approved === 1) border-silver dark:border-silver--}}
{{--                    @elseif ($team->sponsor_tier_id === 3 && $team->is_sponsor_approved === 1) border-bronze dark:border-bronze--}}
{{--                    @else border-gray-200 dark:border-gray-500 @endif">--}}
{{--                            <a href="{{route('companies.show', $team)}}">--}}
{{--                                @if($team->logo_path)--}}
{{--                                    <img class="object-scale-down p-2 @if ($team->sponsor_tier_id === 1 && $team->is_sponsor_approved === 1) border-gold dark:border-gold--}}
{{--                            @elseif ($team->sponsor_tier_id === 2 && $team->is_sponsor_approved === 1) border-silver dark:border-silver--}}
{{--                            @elseif ($team->sponsor_tier_id === 3 && $team->is_sponsor_approved === 1) border-bronze dark:border-bronze--}}
{{--                            @else border-gray-200 dark:border-gray-500 @endif w-56 h-56 mx-auto my-auto max-w-full block dark:text-white"--}}
{{--                                         src="{{ url('storage/'. $team->logo_path) }}" alt="Logo of {{$team->name}}">--}}
{{--                                @else--}}
{{--                                    @php--}}
{{--                                        $color = '';--}}
{{--                                         if ($team->sponsor_tier_id === 1 && $team->is_sponsor_approved === 1) $color='#FFD700';--}}
{{--                                         elseif ($team->sponsor_tier_id === 2 && $team->is_sponsor_approved === 1) $color='#C0C0C0';--}}
{{--                                         elseif ($team->sponsor_tier_id === 3 && $team->is_sponsor_approved === 1) $color='#CD7F32';--}}
{{--                                         else $color='#60a5fa'--}}
{{--                                    @endphp--}}
{{--                                    <div--}}
{{--                                        class="flex items-center justify-center w-56 h-56 mx-auto my-auto max-w-full block dark:text-white--}}
{{--                                @if ($team->sponsor_tier_id === 1 && $team->is_sponsor_approved === 1) border-gold dark:border-gold--}}
{{--                                @elseif ($team->sponsor_tier_id === 2 && $team->is_sponsor_approved === 1) border-silver dark:border-silver--}}
{{--                                @elseif ($team->sponsor_tier_id === 3 && $team->is_sponsor_approved === 1) border-bronze dark:border-bronze--}}
{{--                                @else border-blue-400 dark:border-blue-400 @endif">--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"--}}
{{--                                             stroke-width="1.5"--}}
{{--                                             stroke="{{$color}}" aria-hidden="true" class="w-24 h-24">--}}
{{--                                            <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                  d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>--}}
{{--                                        </svg>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                                <h3 class="tracking-tight leading-7 font-semibold text-base mt-6 text-center dark:text-white">{{$team->name}}</h3>--}}
{{--                                <p class="leading-6 text-sm text-center dark:text-gray-200">--}}
{{--                                    {{substr($team->description, 0, 70) . '...' }}--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <div--}}
{{--                class="isolate px-6 py-6 max-w-7xl mx-auto my-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">--}}
{{--                <div class="text-center max-w-2xl mx-auto">--}}
{{--                    <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">There are currently--}}
{{--                                                                                             no--}}
{{--                                                                                             companies--}}
{{--                                                                                             registered. Check--}}
{{--                                                                                             back later!</h2>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}

</x-app-layout>
