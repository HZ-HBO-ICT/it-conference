@props(['speakersStats', 'boothsStats', 'presentationsStats', 'companiesStats'])

@php
    use App\Models\Booth;
    use App\Models\Company;
    use App\Models\User;
    use App\Models\UserPresentation;
    use App\Models\Edition;
    use App\Models\Room;
    use App\Models\Feedback;
    use App\Models\Presentation;
    use App\Enums\ApprovalStatus;
@endphp

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

<div>
    @if(Edition::current())
        <!-- Main Dashboard Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
            <!-- Left Column - Main Stats -->
            <div class="lg:col-span-2 space-y-4 sm:space-y-6 lg:space-y-8">
                <!-- Pending Requests Section -->
                <div class="bg-gradient-to-br from-[#2a0845] via-[#6441a5] to-[#1b1b2f] rounded-3xl p-4 sm:p-6 md:p-8 shadow-2xl">
                    <h3 class="text-xl sm:text-2xl font-bold text-white mb-4 sm:mb-6">Pending requests</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-3 sm:gap-4 md:gap-5">
                        <x-dashboards.blocks.crew
                            :label="'Companies'"
                            :count="Company::hasStatus(ApprovalStatus::AWAITING_APPROVAL)->count()"
                            :route="'moderator.companies.index'"
                            :icon="'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z'"
                            :roleColour="Auth::user()->role_colour"/>
                        <x-dashboards.blocks.crew
                            :label="'Booths'"
                            :count="Booth::hasStatus(ApprovalStatus::AWAITING_APPROVAL)->count()"
                            :route="'moderator.booths.index'"
                            :icon="'M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z'"
                            :roleColour="Auth::user()->role_colour"/>
                        <x-dashboards.blocks.crew
                            :label="'Sponsorships'"
                            :count="Company::hasStatus(ApprovalStatus::AWAITING_APPROVAL, 'sponsorship_approval_status')->count()"
                            :route="'moderator.sponsorships.index'"
                            :icon="'M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z'"
                            :roleColour="Auth::user()->role_colour"/>
                        <x-dashboards.blocks.crew
                            :label="'Presentations'"
                            :count="$numberOfPresentationRequests"
                            :route="'moderator.presentations.index'"
                            :icon="'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6'"
                            :roleColour="Auth::user()->role_colour"/>
                        <x-dashboards.blocks.crew
                            :label="'Schedule presentations'"
                            :count="$numberOfUnscheduledPresentations"
                            :route="'moderator.schedule.index'"
                            :icon="'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5'"
                            :roleColour="Auth::user()->role_colour"/>
                    </div>
                </div>

                <!-- Current Totals Section -->
                <div class="bg-gradient-to-br from-[#2a0845] via-[#6441a5] to-[#1b1b2f] rounded-3xl p-4 sm:p-6 md:p-8 shadow-2xl">
                    <h3 class="text-xl sm:text-2xl font-bold text-white mb-4 sm:mb-6">Current totals</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-3 sm:gap-4 md:gap-5">
                        <x-dashboards.blocks.crew
                            :label="'Participants'"
                            :count="User::role('participant')->get()->count()"
                            :icon="'M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z'"
                            :route="'moderator.users.index'"
                            :param="'participant'"
                            :roleColour="Auth::user()->role_colour"
                            :styleMode="'alternate'"/>
                        <x-dashboards.blocks.crew
                            :label="'Speakers'"
                            :count="UserPresentation::where('role', 'speaker')->count()"
                            :icon="'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6'"
                            :route="'moderator.users.index'"
                            :param="'speaker'"
                            :roleColour="Auth::user()->role_colour"
                            :styleMode="'alternate'"/>
                        <x-dashboards.blocks.crew
                            :label="'All users'"
                            :count="User::all()->count()"
                            :icon="'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z'"
                            :route="'moderator.users.index'"
                            :roleColour="Auth::user()->role_colour"
                            :styleMode="'alternate'"/>
                        <x-dashboards.blocks.crew
                            :label="'Booths'"
                            :count="Booth::hasStatus(ApprovalStatus::APPROVED)->count()"
                            :icon="'M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z'"
                            :route="'moderator.booths.index'"
                            :param="'booths'"
                            :roleColour="Auth::user()->role_colour"
                            :styleMode="'alternate'"/>
                        <x-dashboards.blocks.crew
                            :label="'Presentations'"
                            :count="$numberOfScheduledPresentations"
                            :icon="'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605'"
                            :route="'moderator.presentations.index'"
                            :roleColour="Auth::user()->role_colour"
                            :styleMode="'alternate'"/>
                        <x-dashboards.blocks.crew
                            :label="'Companies'"
                            :count="Company::hasStatus(ApprovalStatus::APPROVED)->count()"
                            :icon="'M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21'"
                            :route="'moderator.companies.index'"
                            :roleColour="Auth::user()->role_colour"
                            :styleMode="'alternate'"/>
                    </div>
                </div>

                <!-- Upcoming Presentations Section -->
                <div class="bg-gradient-to-br from-[#2a0845] via-[#6441a5] to-[#1b1b2f] rounded-3xl p-4 sm:p-6 md:p-8 shadow-2xl">
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <h3 class="text-xl sm:text-2xl font-bold text-white">Upcoming Presentations</h3>
                        <a href="{{ route('moderator.schedule.index') }}" class="text-cyan-400 hover:text-cyan-300 text-sm font-medium transition">
                            View All →
                        </a>
                    </div>
                    @php
                        $upcomingPresentations = Presentation::where('approval_status', ApprovalStatus::APPROVED)
                            ->whereHas('timeslot')
                            ->join('timeslots', 'presentations.timeslot_id', '=', 'timeslots.id')
                            ->with(['timeslot', 'speakers'])
                            ->orderBy('timeslots.start')
                            ->select('presentations.*')
                            ->take(5)
                            ->get();
                    @endphp
                    @if($upcomingPresentations->count())
                        <div class="space-y-3">
                            @foreach($upcomingPresentations as $presentation)
                                <div class="flex items-center justify-between p-3 bg-white/10 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                        <div>
                                            <div class="font-semibold text-sm text-white">{{ $presentation->name }}</div>
                                            <div class="text-xs text-white/70">
                                                {{ $presentation->timeslot->start ?? 'TBD' }} • 
                                                {{ $presentation->speakers->first()?->name ?? 'TBD' }}
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('moderator.presentations.show', $presentation) }}" class="text-cyan-400 hover:text-cyan-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-white/70 text-sm">No upcoming presentations scheduled.</p>
                        </div>
                    @endif
                </div>

                <!-- Quick Actions Section -->
                <div class="bg-gradient-to-br from-[#2a0845] via-[#6441a5] to-[#1b1b2f] rounded-3xl p-4 sm:p-6 md:p-8 shadow-2xl">
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <h3 class="text-xl sm:text-2xl font-bold text-white">Quick Actions</h3>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <a href="{{ route('moderator.rooms.create') }}" class="flex items-center p-3 bg-white/10 rounded-lg hover:bg-white/20 transition">
                            <svg class="w-5 h-5 text-cyan-400 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            <span class="text-white text-sm font-medium">Add Room</span>
                        </a>
                        <a href="{{ route('moderator.faqs.create') }}" class="flex items-center p-3 bg-white/10 rounded-lg hover:bg-white/20 transition">
                            <svg class="w-5 h-5 text-cyan-400 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-white text-sm font-medium">Add FAQ</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column - Widgets -->
            <div class="space-y-4 sm:space-y-6 lg:space-y-8">
                <!-- Event Schedule Widget -->
                <div class="bg-gradient-to-br from-[#2a0845] via-[#6441a5] to-[#1b1b2f] rounded-3xl p-4 sm:p-6 shadow-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg sm:text-xl font-bold text-white">Event Schedule</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                    </div>
                    <div class="h-64 sm:h-80">
                        <livewire:dashboards.widgets.schedule :user="Auth::user()" :startHour="8" :endHour="17" />
                    </div>
                </div>

                <!-- Rooms Overview Widget -->
                <div class="bg-gradient-to-br from-[#2a0845] via-[#6441a5] to-[#1b1b2f] rounded-3xl p-4 sm:p-6 shadow-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg sm:text-xl font-bold text-white">Rooms Overview</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                        </svg>
                    </div>
                    @php
                        $rooms = Room::latest()->take(5)->get();
                        $totalRooms = Room::count();
                    @endphp
                    <div class="mb-4">
                        <div class="text-2xl sm:text-3xl font-bold text-white mb-1">{{ $totalRooms }}</div>
                        <div class="text-sm text-white/70">Total Rooms</div>
                    </div>
                    @if($rooms->count())
                        <div class="space-y-2 sm:space-y-3 mb-4">
                            @foreach($rooms as $room)
                                <div class="flex items-center justify-between p-2 sm:p-3 bg-white/10 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="w-2 h-2 bg-cyan-400 rounded-full mr-2 sm:mr-3"></div>
                                        <div>
                                            <div class="font-semibold text-xs sm:text-sm text-white">{{ $room->name }}</div>
                                            <div class="text-xs text-white/70">{{ $room->max_participants }} max participants</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-white/70 text-sm mb-4">No rooms available.</div>
                    @endif
                    <a href="{{ route('moderator.rooms.index') }}" class="block text-center text-sm text-cyan-400 hover:text-cyan-300 transition">
                        View All Rooms →
                    </a>
                </div>

                <!-- Recent Feedback Widget -->
                <div class="bg-gradient-to-br from-[#2a0845] via-[#6441a5] to-[#1b1b2f] rounded-3xl p-4 sm:p-6 shadow-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg sm:text-xl font-bold text-white">Recent Feedback</h3>
                        <a href="{{ route('moderator.feedback.index') }}" class="text-cyan-400 hover:text-cyan-300 text-sm font-medium transition">
                            View All →
                        </a>
                    </div>
                    @php
                        $recentFeedback = Feedback::latest()->take(3)->get();
                    @endphp
                    @if($recentFeedback->count())
                        <div class="space-y-3">
                            @foreach($recentFeedback as $feedback)
                                <div class="p-3 bg-white/10 rounded-lg">
                                    <div class="flex items-start justify-between mb-2">
                                        <div class="font-semibold text-sm text-white">{{ $feedback->user->name }}</div>
                                        <div class="text-xs text-white/70">{{ $feedback->created_at->diffForHumans() }}</div>
                                    </div>
                                    <p class="text-xs text-white/80 line-clamp-2">{{ Str::limit($feedback->message, 80) }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6">
                            <p class="text-white/70 text-sm">No recent feedback.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="flex items-center justify-center min-h-64">
            <div class="text-center">
                <p class="text-apricot-peach-400 text-lg mb-4">There is no active edition, statistics is unavailable.</p>
                <a href="{{ route('moderator.editions.create') }}" class="inline-flex items-center px-4 py-2 bg-waitt-pink-500 hover:bg-waitt-pink-600 text-white font-bold rounded-xl transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create Edition
                </a>
            </div>
        </div>
    @endif
</div>

@stack('scripts')
