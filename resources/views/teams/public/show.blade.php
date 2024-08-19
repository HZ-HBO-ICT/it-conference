<x-app-layout>
    <div class="relative bg-cover overflow-hidden min-h-screen">
        <div
            class="before:absolute before:bg-gradient-to-br before:from-gradient-yellow before:via-gradient-pink before:via-gradient-purple before:to-gradient-blue before:opacity-70 before:w-full before:h-full"></div>
        <div
            class="isolate px-6 py-6 max-w-7xl mx-auto mt-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center max-w-2xl mx-auto mb-5">
                <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">Conference Line-up /
                    <span class="text-violet-600">{{$company->name}}</span>
                </h2>
            </div>
            <div class="mx-auto max-w-7xl">
                <div class="py-3 px-6 rounded-lg overflow-hidden relative">
                    <div class=" rounded-2xl py-3 px-3 border-2 shadow dark:bg-gray-800
                            @if ($company->sponsor_tier_id === 1 && $company->is_sponsor_approved === 1) border-gold dark:border-gold
                            @elseif ($company->sponsor_tier_id === 2 && $company->is_sponsor_approved === 1) border-silver dark:border-silver
                            @elseif ($company->sponsor_tier_id === 3 && $company->is_sponsor_approved === 1) border-bronze dark:border-bronze
                            @else border-gray-200 dark:border-gray-500 @endif">
                        <div class="grid grid-cols-3">
                            <div class=" flex items-center justify-center">
                                <div>
                                    <div class="px-3 py-6 lg:px-10 lg:py-8">
                                        @if ($company->logo_path)
                                            <img class="object-scale-down p-2 @if ($company->sponsor_tier_id === 1 && $company->is_sponsor_approved === 1) border-gold dark:border-gold
                                @elseif ($company->sponsor_tier_id === 2 && $company->is_sponsor_approved === 1) border-silver dark:border-silver
                                @elseif ($company->sponsor_tier_id === 3 && $company->is_sponsor_approved === 1) border-bronze dark:border-bronze
                                @else border-gray-200 dark:border-gray-500 @endif w-56 h-56 mx-auto my-auto max-w-full block dark:text-white"
                                                 src="{{ url('storage/'. $company->logo_path) }}"
                                                 alt="Logo of {{$company->name}}">
                                        @else
                                            @php
                                                $color = '';
                                                if ($company->sponsor_tier_id === 1 && $company->is_sponsor_approved === 1) $color='#FFD700';
                                                elseif ($company->sponsor_tier_id === 2 && $company->is_sponsor_approved === 1) $color='#C0C0C0';
                                                elseif ($company->sponsor_tier_id === 3 && $company->is_sponsor_approved === 1) $color='#CD7F32';
                                                else $color='#60a5fa'
                                            @endphp
                                            <div
                                                class="flex items-center justify-center w-56 h-56 mx-auto my-auto max-w-full block dark:text-white
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
                                        @if($team->booth)
                                            <h3 class="tracking-tight leading-7 font-semibold text-base mt-6 text-center dark:text-white">
                                                Meet us at our booth!</h3>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="sm:col-span-2 py-2 pl-3 dark:text-white">
                                <div>
                                    <h3 class="tracking-tight text-3xl font-semibold text-left">{{$team->name}}</h3>
                                </div>
                                <div>
                                    <h3 class="tracking-tight text-xl font-semibold mt-6 text-left">
                                        Company Description</h3>
                                    <p>{{$team->description}}</p>
                                </div>
                                <div>
                                    <h3 class="tracking-tight text-xl font-semibold mt-6 text-left">
                                        Where you can find us</h3>
                                    <p>
                                        {{ $team->street }} {{ $team->house_number }} <br>
                                        {{ $team->postcode }}  {{ $team->city }}
                                    </p>
                                </div>
                                <div>
                                    <h3 class="tracking-tight text-xl font-semibold mt-6 text-left">
                                        Learn more about us</h3>
                                    <p>Visit our
                                        <a class="text-violet-600 underline font-semibold dark:hover:text-violet-500 hover:text-violet-900"
                                           href="{{ $team->website }}">
                                            website</a>
                                       for more information</p>
                                </div>
                                @if($team->presentations)
                                    <div class="pr-2">
                                        <h3 class="tracking-tight text-xl font-semibold mt-6 pb-1 text-left">
                                            Presentations</h3>
                                        @foreach($team->presentations->unique() as $presentation)
                                            <a href="{{route('programme.presentation.show', $presentation)}}"
                                               class="group relative w-full flex bg-violet-50 dark:bg-violet-600 p-3 border-2 border-violet-100 dark:border-violet-800 rounded-md hover:bg-violet-100 dark:hover:bg-violet-500 transition duration-300 focus:outline-none">
                                                <div class="py-1">
                                                    <dt>
                                                        <div class="p-3 rounded-md absolute bg-violet-200">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                 viewBox="0 0 24 24"
                                                                 stroke-width="1.5" stroke="#8b5cf6"
                                                                 aria-hidden="true" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"/>
                                                            </svg>
                                                        </div>
                                                        <p class="ml-16 font-semibold text-md overflow-hidden text-ellipsis whitespace-nowrap">
                                                            {{substr($presentation->name, 0, 70)}}
                                                        </p>
                                                    </dt>
                                                    <dd class="items-baseline flex ml-16">
                                                        <p class="text-violet-500 dark:text-violet-100 font-medium text-sm">
                                                            Hosted by:
                                                            @php
                                                                $speakers = $presentation->speakers->filter(function ($speaker) {
                                                                    return $speaker->is_main_speaker === 0;
                                                                });

                                                                $cospeakers = [];
                                                                foreach ($speakers as $speaker) {
                                                                    if ($speaker->user && $speaker->user->name) {
                                                                        $cospeakers[] = $speaker->user->name;
                                                                    }
                                                                }

                                                                $cospeakersString = implode(', ', $cospeakers);
                                                                $mainSpeakerName = $presentation->mainSpeaker()->user->name;
                                                                $cospeakers = $cospeakersString ? " (with $cospeakersString)" : '';

                                                                $speakersString = "$mainSpeakerName$cospeakers";
                                                            @endphp
                                                            {{substr($speakersString, 0, 74)}}
                                                        </p>
                                                    </dd>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
