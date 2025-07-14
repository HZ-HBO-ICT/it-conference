@php
    use App\Models\Company;
    use App\Models\Booth;
    use App\Models\Presentation;
    use App\Models\User;
    use App\Models\Edition;
    use Illuminate\Support\Facades\Auth;
@endphp

<x-hub-layout>
    <div class="relative min-h-screen w-full bg-waitt-dark overflow-hidden">
        <!-- Decorative Blobs -->
        <div class="absolute top-1/2 left-1/10 w-sm h-[24rem] bg-[#31F7F1] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
        <div class="absolute top-2/3 left-4/7 w-sm h-[24rem] bg-[#E2FF32] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
        <div class="absolute top-1/5 left-3/7 w-sm h-[24rem] bg-[#FF3B9A] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
        <!-- Main Dashboard Content -->
        <div class="relative z-10 py-12 px-4 md:px-8 mx-auto max-w-7xl">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Cards Area -->
                <div class="lg:col-span-2">
                    <div class="rounded-3xl bg-gradient-to-br from-[#2a0845] via-[#6441a5] to-[#1b1b2f] p-8 shadow-2xl">
                        <div class="mb-8">
                            <h1 class="text-3xl font-extrabold text-white mb-2">Welcome back, {{ Auth::user()->name }}</h1>
                            <p class="text-white/80 text-lg">Manage your team, presentations, and booth — all in one place.</p>
                        </div>
                        <!-- Pending Requests -->
                        <div class="mb-10">
                            <h2 class="text-2xl font-bold text-white mb-4">Pending requests</h2>
                            <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                                <div class="rounded-2xl bg-gradient-to-br from-orange-400 via-pink-500 to-purple-600 p-6 text-white shadow flex flex-col items-center">
                                    <span class="text-4xl font-extrabold mb-2">{{ Company::hasStatus('awaiting_approval')->count() }}</span>
                                    <span class="font-semibold">Companies</span>
                                    <a href="#" class="mt-4 px-4 py-1 border border-white/40 rounded-lg text-white/90 hover:bg-white/10 transition">View all</a>
                                </div>
                                <div class="rounded-2xl bg-gradient-to-br from-orange-400 via-pink-500 to-purple-600 p-6 text-white shadow flex flex-col items-center">
                                    <span class="text-4xl font-extrabold mb-2">{{ Booth::hasStatus('awaiting_approval')->count() }}</span>
                                    <span class="font-semibold">Booths</span>
                                    <a href="#" class="mt-4 px-4 py-1 border border-white/40 rounded-lg text-white/90 hover:bg-white/10 transition">View all</a>
                                </div>
                                <div class="rounded-2xl bg-gradient-to-br from-orange-400 via-pink-500 to-purple-600 p-6 text-white shadow flex flex-col items-center">
                                    <span class="text-4xl font-extrabold mb-2">0</span>
                                    <span class="font-semibold">Sponsorships</span>
                                    <a href="#" class="mt-4 px-4 py-1 border border-white/40 rounded-lg text-white/90 hover:bg-white/10 transition">View all</a>
                                </div>
                                <div class="rounded-2xl bg-gradient-to-br from-orange-400 via-pink-500 to-purple-600 p-6 text-white shadow flex flex-col items-center">
                                    <span class="text-4xl font-extrabold mb-2">{{ Presentation::hasStatus('awaiting_approval')->count() }}</span>
                                    <span class="font-semibold">Presentations</span>
                                    <a href="#" class="mt-4 px-4 py-1 border border-white/40 rounded-lg text-white/90 hover:bg-white/10 transition">View all</a>
                                </div>
                                <div class="rounded-2xl bg-gradient-to-br from-orange-400 via-pink-500 to-purple-600 p-6 text-white shadow flex flex-col items-center">
                                    <span class="text-4xl font-extrabold mb-2">0</span>
                                    <span class="font-semibold">Schedule presentations</span>
                                    <a href="#" class="mt-4 px-4 py-1 border border-white/40 rounded-lg text-white/90 hover:bg-white/10 transition">View all</a>
                                </div>
                            </div>
                        </div>
                        <!-- Current Totals -->
                        <div>
                            <h2 class="text-2xl font-bold text-white mb-4">Current totals</h2>
                            <div class="grid grid-cols-2 md:grid-cols-6 gap-6">
                                <div class="rounded-2xl bg-gradient-to-br from-orange-400 via-pink-500 to-purple-600 p-6 text-white shadow flex flex-col items-center">
                                    <span class="text-4xl font-extrabold mb-2">{{ User::role('participant')->count() }}</span>
                                    <span class="font-semibold">Participants</span>
                                    <a href="#" class="mt-4 px-4 py-1 border border-white/40 rounded-lg text-white/90 hover:bg-white/10 transition">View all</a>
                                </div>
                                <div class="rounded-2xl bg-gradient-to-br from-orange-400 via-pink-500 to-purple-600 p-6 text-white shadow flex flex-col items-center">
                                    <span class="text-4xl font-extrabold mb-2">{{ \App\Models\UserPresentation::where('role', 'speaker')->count() }}</span>
                                    <span class="font-semibold">Speakers</span>
                                    <a href="#" class="mt-4 px-4 py-1 border border-white/40 rounded-lg text-white/90 hover:bg-white/10 transition">View all</a>
                                </div>
                                <div class="rounded-2xl bg-gradient-to-br from-orange-400 via-pink-500 to-purple-600 p-6 text-white shadow flex flex-col items-center">
                                    <span class="text-4xl font-extrabold mb-2">{{ User::count() }}</span>
                                    <span class="font-semibold">All users</span>
                                    <a href="#" class="mt-4 px-4 py-1 border border-white/40 rounded-lg text-white/90 hover:bg-white/10 transition">View all</a>
                                </div>
                                <div class="rounded-2xl bg-gradient-to-br from-orange-400 via-pink-500 to-purple-600 p-6 text-white shadow flex flex-col items-center">
                                    <span class="text-4xl font-extrabold mb-2">{{ Booth::count() }}</span>
                                    <span class="font-semibold">Booths</span>
                                    <a href="#" class="mt-4 px-4 py-1 border border-white/40 rounded-lg text-white/90 hover:bg-white/10 transition">View all</a>
                                </div>
                                <div class="rounded-2xl bg-gradient-to-br from-orange-400 via-pink-500 to-purple-600 p-6 text-white shadow flex flex-col items-center">
                                    <span class="text-4xl font-extrabold mb-2">{{ Presentation::count() }}</span>
                                    <span class="font-semibold">Presentations</span>
                                    <a href="#" class="mt-4 px-4 py-1 border border-white/40 rounded-lg text-white/90 hover:bg-white/10 transition">View all</a>
                                </div>
                                <div class="rounded-2xl bg-gradient-to-br from-orange-400 via-pink-500 to-purple-600 p-6 text-white shadow flex flex-col items-center">
                                    <span class="text-4xl font-extrabold mb-2">{{ Company::hasStatus('approved')->count() }}</span>
                                    <span class="font-semibold">Companies</span>
                                    <a href="#" class="mt-4 px-4 py-1 border border-white/40 rounded-lg text-white/90 hover:bg-white/10 transition">View all</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Side Widgets -->
                <div class="flex flex-col gap-8">
                    <!-- Event Schedule -->
                    <div class="w-full h-full">
                        <livewire:dashboards.widgets.schedule :user="Auth::user()" :startHour="8" :endHour="17" />
                    </div>
                    <!-- Rooms Overview -->
                    <div class="rounded-3xl bg-gradient-to-br from-gray-800 via-gray-700 to-gray-900 p-6 shadow-2xl text-white">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold">Rooms Overview</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                            </svg>
                        </div>
                        @php
                            $rooms = \App\Models\Room::latest()->take(3)->get();
                            $totalRooms = \App\Models\Room::count();
                        @endphp
                        <div class="mb-4">
                            <div class="text-3xl font-bold text-white mb-1">{{ $totalRooms }}</div>
                            <div class="text-sm text-white/70">Total Rooms</div>
                        </div>
                        @if($rooms->count())
                            <div class="space-y-3 mb-4">
                                @foreach($rooms as $room)
                                    <div class="flex items-center justify-between p-3 bg-white/10 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 bg-cyan-400 rounded-full mr-3"></div>
                                            <div>
                                                <div class="font-semibold text-sm">{{ $room->name }}</div>
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
                </div>
            </div>
        </div>
    </div>
</x-hub-layout>
