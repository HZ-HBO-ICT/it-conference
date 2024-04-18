<div>
    <!-- TODO: Something with the gold sponsor, will do after reaching requests -->
    {{--@if(Auth::user()->currentTeam->owner->id == Auth::user()->id
                        && Auth::user()->currentTeam->isGoldenSponsor
                        && Auth::user()->currentTeam->allPresentations->count() < 2)
        <div class="px-6 pt-5">
            <div
                class="py-5 px-4 rounded-lg overflow-hidden relative bg-crew-100 dark:bg-crew-800 shadow-md dark:shadow-md">
                <div class="p-3 rounded-md absolute bg-crew-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="white"
                         aria-hidden="true" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                </div>
                <p class="ml-16 font-semibold text-md text-gray-500 dark:text-gray-100 overflow-hidden text-ellipsis">
                    Your company is the gold sponsor for the "We are in IT Together" Conference. As such
                    your
                    company can have two presentations. Currently, you have
                    requested {{Auth::user()->currentTeam->allPresentations->count()}} presentations.
                    <a href="{{route('teams.show', Auth::user()->currentTeam)}}"
                       class="text-partner-500">
                        Invite speakers to host a presentation
                    </a>
                    @if(!Auth::user()->speaker)
                    or
                        <a href="{{route('speakers.request.presentation')}}"
                           class="text-partner-500">
                            host one yourself
                        </a>
                    @endif
                </p>
            </div>
        </div>
    @endif--}}
    <!-- TODO: Edge case with the HZ team -->
    {{--@if(Auth::user()->currentTeam->isHz)
        <x-hz-team-block></x-hz-team-block>
    @endif--}}
    <!-- TODO: Edge case to do with the gold sponsor -->
    {{--@if(Auth::user()->currentTeam->isGoldenSponsor
        && Auth::user()->currentTeam->owner->id != Auth::user()->id
        && !Auth::user()->hasTeamRole(Auth::user()->currentTeam, 'booth owner')
        && !Auth::user()->speaker)
        <x-gold-sponsor-speaker-block></x-gold-sponsor-speaker-block>
    @endif--}}
    <div class="pt-6 px-6 pb-12 rounded-lg overflow-hidden relative">
        <dl class="gap-5 grid-cols-3 grid mt-5">
            <x-dashboards.blocks.company
            :label="'Company status'"
                :icon="'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z'"/>
            <x-dashboards.blocks.company
                :label="'Booth status'"
                :icon="'M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z'"/>
            <x-dashboards.blocks.company
                :label="'Sponsorship status'"
                :icon="'M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z'"/>
        </dl>
    </div>
    <!-- TODO: List of the presentations that the company has -->
    {{--<h3 class="leading-6 font-semibold text-xl dark:text-white">Presentation</h3>
    <dl class="py-11 px-6">
        <div
            class="py-5 px-4 rounded-lg overflow-hidden relative bg-white dark:bg-gray-800 shadow-md dark:shadow-md dark:">
            @if(Auth::user()->currentTeam->allPresentations->count() > 0)
                @foreach(Auth::user()->currentTeam->allPresentations->unique() as $presentation)
                    <div class="py-5">
                        <dt>
                            <div class="p-3 rounded-md absolute bg-purple-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="white"
                                     aria-hidden="true" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"/>
                                </svg>
                            </div>
                            <p class="ml-16 font-semibold text-md text-gray-500 dark:text-gray-100 overflow-hidden text-ellipsis whitespace-nowrap">
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
                                @endphp
                                {{$presentation->name}} <span
                                    class="text-sm">by {{$presentation->mainSpeaker()->user->name}} {{$cospeakersString ? "(with {$cospeakersString})" : '' }}</span>
                            </p>
                        </dt>
                        <dd class="items-baseline flex ml-16">
                            @php
                                $status = $presentation->is_approved ? 'Approved' : 'Awaiting approval';
                                $accentColor = $status === 'Approved' ? 'purple' : 'yellow';
                            @endphp
                            <p class="text-{{$accentColor}}-600 dark:text-{{$accentColor}}-500 font-medium text-md">
                                {{$status}}
                            </p>
                        </dd>
                    </div>
                @endforeach
            @else
                <p class="text-partner-600 font-medium text-md dark:text-partner-500">
                    Your company has not requested any presentations yet
                </p>
            @endif
        </div>
    </dl>--}}
</div>
