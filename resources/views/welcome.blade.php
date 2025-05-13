@php
    use App\Models\Sponsorship;
    use Carbon\Carbon;
    $goldSponsors = \App\Models\Sponsorship::find(1)?->companies()->where('is_sponsorship_approved', true)->get() ?? collect();
    $silverSponsors = \App\Models\Sponsorship::find(2)?->companies()->where('is_sponsorship_approved', true)->get() ?? collect();
    $bronzeSponsors = \App\Models\Sponsorship::find(3)?->companies()->where('is_sponsorship_approved', true)->get() ?? collect();
    $eventDate = Carbon::create(2025, 11, 14, 9, 0, 0);
@endphp

<x-app-layout>
    <div class="relative min-h-screen bg-[#0B1221] overflow-hidden">
        <!-- Animated Blobs Background (fixed, covers whole viewport) -->
        <div class="fixed inset-0 pointer-events-none z-0">
            <!-- Yellow Blob -->
            <div class="absolute left-[8%] top-[12%] w-[400px] h-[400px] rounded-full animate-blob1"
                 style="background: radial-gradient(circle, #e2ff32 0%, transparent 70%); filter: blur(40px); opacity: 0.55;"></div>
            <!-- Pink Blob -->
            <div class="absolute right-[8%] top-[30%] w-[350px] h-[350px] rounded-full animate-blob2"
                 style="background: radial-gradient(circle, #ff3b9a 0%, transparent 70%); filter: blur(50px); opacity: 0.38;"></div>
            <!-- Blue Blob -->
            <div class="absolute left-1/2 bottom-[10%] w-[500px] h-[500px] -translate-x-1/2 rounded-full animate-blob3"
                 style="background: radial-gradient(circle, #31f7f1 0%, transparent 70%); filter: blur(60px); opacity: 0.32;"></div>
        </div>
        <!-- Main content (z-10 or higher) -->
        <div class="flex flex-col overflow-hidden relative min-h-screen z-10">
            <!-- Hero Section -->
            <div class="relative z-10">
                <div class="relative max-w-7xl mx-auto px-4 pt-24 pb-24">
                    <!-- Main Hero Content -->
                    <div class="text-center mb-16">
                        <h2 class="text-2xl text-white mb-8">Discover your spark in the IT Wave</h2>
                        <div class="relative space-y-2">
                            <div class="text-8xl font-bold" style="text-shadow: 0 0 5px #e2ff32;">
                                <span class="text-[#E2FF32]" style="text-shadow: 0 0 5px #e2ff32;">WE ARE IN IT</span>
                                <span class="text-[#FF3B9A]" style="text-shadow: 0 0 5px #ff3b9a;">TOGETHER</span>
                            </div>
                            <div class="text-8xl font-bold">
                                <span class="text-[#E2FF32]" style="text-shadow: 0 0 5px #e2ff32;">CONFERENCE</span>
                                <span class="text-[#FF3B9A]" style="text-shadow: 0 0 5px #ff3b9a;">2025</span>
                            </div>
                            <div class="relative w-full">
                                <span class="absolute left-32 text-xl text-white">Co-hosted by YourSurprise</span>
                                <span class="absolute right-32 text-xl text-white">Powered by New Waves</span>
                            </div>
                        </div>
                        <div class="mt-12 text-gray-400">
                            <p class="text-2xl mb-1">14th November 2025</p>
                            <p class="text-2xl">HZ University of Applied Sciences, Middelburg</p>
                        </div>
                        <div class="mt-16 flex justify-center space-x-6">
                            <a href="{{ route('register.participant') }}" class="px-8 py-4 bg-[#31F7F1] text-[#0B1221] rounded-xl text-xl font-semibold hover:bg-opacity-90 transition-all">
                                Register Now
                            </a>
                            <a href="{{ route('programme') }}" class="px-8 py-4 border-2 border-[#31F7F1] text-[#31F7F1] rounded-xl text-xl font-semibold hover:bg-[#31F7F1] hover:text-[#0B1221] transition-all">
                                View Programme
                            </a>
                        </div>
                    </div>

                    <!-- Countdown Section -->
                    <div class="mt-16">
                        <div class="flex justify-center space-x-6" id="countdown">
                            <div class="text-center">
                                <div class="text-4xl font-bold text-white" id="months">00</div>
                                <div class="text-sm text-white tracking-widest mt-2">MONTHS</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold text-white" id="days">00</div>
                                <div class="text-sm text-white tracking-widest mt-2">DAYS</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold text-white" id="hours">00</div>
                                <div class="text-sm text-white tracking-widest mt-2">HOURS</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold text-white" id="minutes">00</div>
                                <div class="text-sm text-white tracking-widest mt-2">MINUTES</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold text-white" id="seconds">00</div>
                                <div class="text-sm text-white tracking-widest mt-2">SECONDS</div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -->
                    <div class="grid grid-cols-4 gap-8 text-center mt-32 mb-32">
                        <div class="border-2 border-[#FF3B9A] rounded-lg p-6">
                            <div class="text-5xl font-bold text-[#FF3B9A]">10+</div>
                            <div class="text-white mt-2">SPEAKERS</div>
                        </div>
                        <div class="border-2 border-[#FF3B9A] rounded-lg p-6">
                            <div class="text-5xl font-bold text-[#FF3B9A]">200+</div>
                            <div class="text-white mt-2">STUDENTS</div>
                        </div>
                        <div class="border-2 border-[#FF3B9A] rounded-lg p-6">
                            <div class="text-5xl font-bold text-[#FF3B9A]">20+</div>
                            <div class="text-white mt-2">COMPANIES</div>
                        </div>
                        <div class="border-2 border-[#FF3B9A] rounded-lg p-6">
                            <div class="text-5xl font-bold text-[#FF3B9A]">15+</div>
                            <div class="text-white mt-2">PRESENTATIONS</div>
                        </div>
                    </div>

                    <!-- What to Expect Section -->
                    <div class="mt-32">
                        <h2 class="text-4xl font-bold text-white mb-12">What to expect</h2>
                        <div class="grid grid-cols-3 gap-8">
                            <!-- Speakers Card -->
                            <div class="rounded-lg overflow-hidden bg-gradient-to-b from-[#0B1221] to-[#1A4145]">
                                <div class="p-8">
                                    <h3 class="text-[#31F7F1] text-2xl font-bold mb-4">SPEAKERS</h3>
                                    <p class="text-white mb-8">Industry leaders and innovators. Find the chance to connect with the best in our industry.</p>
                                    <a href="{{ route('speakers.index') }}" class="text-[#31F7F1] flex items-center">
                                        Learn more
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Presentations Card -->
                            <div class="rounded-lg overflow-hidden bg-gradient-to-b from-[#0B1221] to-[#45154A]">
                                <div class="p-8">
                                    <h3 class="text-[#FF3B9A] text-2xl font-bold mb-4">PRESENTATIONS & WORKSHOPS</h3>
                                    <p class="text-white mb-8">Cutting edge-topics and hands-on workshops to enhance your skills.</p>
                                    <a href="{{ route('programme') }}" class="text-[#FF3B9A] flex items-center">
                                        Learn more
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Companies Card -->
                            <div class="rounded-lg overflow-hidden bg-gradient-to-b from-[#0B1221] to-[#454515]">
                                <div class="p-8">
                                    <h3 class="text-[#E2FF32] text-2xl font-bold mb-4">COMPANIES</h3>
                                    <p class="text-white mb-8">Meet the companies that make the IT world move. Find your chance to start your career/internship.</p>
                                    <a href="{{ route('companies.index') }}" class="text-[#E2FF32] flex items-center">
                                        Learn more
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sponsors Section -->
                    <div class="mt-32">
                        <h2 class="text-4xl font-bold text-white mb-12">Thank you to our Sponsors</h2>
                        <!-- Gold Sponsors -->
                        <div class="mb-12">
                            <span class="inline-block bg-[#454515] text-[#E2FF32] px-4 py-1 rounded-full text-sm font-semibold mb-6">Gold</span>
                            <div class="grid grid-cols-1 gap-6">
                                @foreach($goldSponsors as $sponsor)
                                    <div class="border border-[#E2FF32]/20 rounded-lg p-6">
                                        <img src="{{ $sponsor->logo_url }}" alt="{{ $sponsor->name }}" class="h-12">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Silver Sponsors -->
                        <div class="mb-12">
                            <span class="inline-block bg-gray-700 text-gray-300 px-4 py-1 rounded-full text-sm font-semibold mb-6">Silver</span>
                            <div class="grid grid-cols-2 gap-6">
                                @foreach($silverSponsors as $sponsor)
                                    <div class="border border-gray-300/20 rounded-lg p-6">
                                        <img src="{{ $sponsor->logo_url }}" alt="{{ $sponsor->name }}" class="h-12">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Bronze Sponsors -->
                        <div>
                            <span class="inline-block bg-[#45291A] text-[#CD7F32] px-4 py-1 rounded-full text-sm font-semibold mb-6">Bronze</span>
                            <div class="grid grid-cols-4 gap-6">
                                @foreach($bronzeSponsors as $sponsor)
                                    <div class="border border-[#CD7F32]/20 rounded-lg p-6">
                                        <img src="{{ $sponsor->logo_url }}" alt="{{ $sponsor->name }}" class="h-12">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes float-slow {
            0%, 100% {
                transform: translate(0, 0);
            }
            50% {
                transform: translate(100px, 50px);
            }
        }
        @keyframes float-slower {
            0%, 100% {
                transform: translate(0, 0);
            }
            50% {
                transform: translate(-100px, -50px);
            }
        }
        .animate-float-slow {
            animation: float-slow 20s ease-in-out infinite;
        }
        .animate-float-slower {
            animation: float-slower 25s ease-in-out infinite;
        }
        .bg-gradient-radial {
            background: radial-gradient(circle at center, var(--tw-gradient-stops));
        }
        @keyframes blob1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            20% { transform: translate(80px, 60px) scale(1.12); }
            40% { transform: translate(-60px, 100px) scale(0.95); }
            60% { transform: translate(-100px, -40px) scale(1.08); }
            80% { transform: translate(60px, -80px) scale(1.03); }
        }
        @keyframes blob2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            15% { transform: translate(-60px, 80px) scale(1.13); }
            35% { transform: translate(90px, -60px) scale(0.92); }
            55% { transform: translate(-80px, 60px) scale(1.09); }
            75% { transform: translate(40px, -100px) scale(1.05); }
        }
        @keyframes blob3 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(100px, -60px) scale(1.15); }
            50% { transform: translate(-80px, 80px) scale(0.9); }
            75% { transform: translate(60px, 100px) scale(1.12); }
        }
        .animate-blob1 { animation: blob1 22s ease-in-out infinite; }
        .animate-blob2 { animation: blob2 28s ease-in-out infinite; }
        .animate-blob3 { animation: blob3 25s ease-in-out infinite; }
    </style>

    <script>
        // Set the date you're counting down to
        const eventDate = new Date("2025-11-14T09:00:00");

        function updateCountdown() {
            const now = new Date();
            let diff = eventDate - now;

            if (diff < 0) diff = 0;

            const months = Math.floor(diff / (1000 * 60 * 60 * 24 * 30));
            const days = Math.floor((diff / (1000 * 60 * 60 * 24)) % 30);
            const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
            const minutes = Math.floor((diff / (1000 * 60)) % 60);
            const seconds = Math.floor((diff / 1000) % 60);

            document.getElementById('months').textContent = String(months).padStart(2, '0');
            document.getElementById('days').textContent = String(days).padStart(2, '0');
            document.getElementById('hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    </script>
</x-app-layout>