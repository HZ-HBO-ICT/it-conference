<x-app-layout>
    <link href="{{ asset('/css/welcome-custom.css') }}" rel="stylesheet">
    <div class="relative min-h-screen bg-primary-dark overflow-hidden">
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
                                <span class="text-accent-yellow" style="text-shadow: 0 0 5px #e2ff32;">WE ARE IN IT</span>
                                <span class="text-accent-pink" style="text-shadow: 0 0 5px #ff3b9a;">TOGETHER</span>
                            </div>
                            <div class="text-8xl font-bold">
                                <span class="text-accent-yellow uppercase" style="text-shadow: 0 0 5px #e2ff32;">Conference</span>
                                <span class="text-accent-pink uppercase" style="text-shadow: 0 0 5px #ff3b9a;">2025</span>
                            </div>
                            <div class="flex justify-center gap-16 mt-10">
                                <span class="text-xl text-white">Co-hosted by YourSurprise</span>
                                <span class="text-xl text-white">Powered by New Waves</span>
                            </div>
                        </div>
                        <div class="mt-12 text-gray-400">
                            <p class="text-2xl mb-1">
                                @if($edition && $edition->start_at)
                                    {{ $edition->start_at->format('j F Y') }}
                                @else
                                    The date will be provided soon!
                                @endif
                            </p>
                            <p class="text-2xl">HZ University of Applied Sciences, Middelburg</p>
                        </div>
                        <div class="mt-16 flex justify-center space-x-6">
                            <a href="{{ route('register.participant') }}" class="px-8 py-4 bg-accent-cyan text-primary-dark rounded-xl text-xl font-semibold hover:bg-opacity-90 transition-all">
                                Register Now
                            </a>
                            <a href="{{ route('programme') }}" class="px-8 py-4 border-2 border-accent-cyan text-accent-cyan rounded-xl text-xl font-semibold hover:bg-accent-cyan hover:text-primary-dark transition-all">
                                View Programme
                            </a>
                        </div>
                    </div>

                    <!-- Countdown Timer -->
                    <div class="w-full flex justify-center @if(optional($edition)->is_in_progress) mt-16 @else mt-24 @endif">
                        @if ($edition)
                            <x-countdown :time="$edition->start_at"/>
                        @endif
                    </div>

                    <!-- Stats Section -->
                    <div class="grid grid-cols-4 gap-8 text-center mt-32 mb-32">
                        <div class="border-2 border-accent-pink rounded-lg p-6">
                            <div class="text-5xl font-bold text-accent-pink">10+</div>
                            <div class="text-white mt-2">SPEAKERS</div>
                        </div>
                        <div class="border-2 border-accent-pink rounded-lg p-6">
                            <div class="text-5xl font-bold text-accent-pink">200+</div>
                            <div class="text-white mt-2">STUDENTS</div>
                        </div>
                        <div class="border-2 border-accent-pink rounded-lg p-6">
                            <div class="text-5xl font-bold text-accent-pink">20+</div>
                            <div class="text-white mt-2">COMPANIES</div>
                        </div>
                        <div class="border-2 border-accent-pink rounded-lg p-6">
                            <div class="text-5xl font-bold text-accent-pink">15+</div>
                            <div class="text-white mt-2">PRESENTATIONS</div>
                        </div>
                    </div>

                    <!-- What to Expect Section -->
                    <div class="mt-32">
                        <h2 class="text-4xl font-bold text-white mb-12">What to expect</h2>
                        <div class="grid grid-cols-3 gap-8">
                            <!-- Speakers Card -->
                            <div class="rounded-lg overflow-hidden bg-gradient-to-b from-primary-dark via-accent-cyan/20 to-accent-cyan/40">
                                <div class="p-8">
                                    <h3 class="text-accent-cyan text-2xl font-bold mb-4">SPEAKERS</h3>
                                    <p class="text-white mb-8">Industry leaders and innovators. Find the chance to connect with the best in our industry.</p>
                                    <a href="{{ route('speakers.index') }}" class="text-accent-cyan flex items-center">
                                        Learn more
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Presentations Card -->
                            <div class="rounded-lg overflow-hidden bg-gradient-to-b from-primary-dark via-accent-pink/20 to-accent-pink/40">
                                <div class="p-8">
                                    <h3 class="text-accent-pink text-2xl font-bold mb-4">PRESENTATIONS & WORKSHOPS</h3>
                                    <p class="text-white mb-8">Cutting edge-topics and hands-on workshops to enhance your skills.</p>
                                    <a href="{{ route('programme') }}" class="text-accent-pink flex items-center">
                                        Learn more
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Companies Card -->
                            <div class="rounded-lg overflow-hidden bg-gradient-to-b from-primary-dark to-accent-olive">
                                <div class="p-8">
                                    <h3 class="text-accent-yellow text-2xl font-bold mb-4">COMPANIES</h3>
                                    <p class="text-white mb-8">Meet the companies that make the IT world move. Find your chance to start your career/internship.</p>
                                    <a href="{{ route('companies.index') }}" class="text-accent-yellow flex items-center">
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
                            <span class="inline-block bg-accent-olive text-accent-yellow px-4 py-1 rounded-full text-sm font-semibold mb-6">Gold</span>
                            <div class="grid grid-cols-1 gap-6">
                                @if($goldSponsor)
                                    <div class="border border-accent-yellow/20 rounded-lg p-6">
                                        <img src="{{ $goldSponsor->logo_path }}" alt="{{ $goldSponsor->name }}" class="h-12">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Silver Sponsors -->
                        <div class="mb-12">
                            <span class="inline-block bg-gray-700 text-gray-300 px-4 py-1 rounded-full text-sm font-semibold mb-6">Silver</span>
                            <div class="grid grid-cols-2 gap-6">
                                @foreach($silverSponsors as $sponsor)
                                    <div class="border border-gray-300/20 rounded-lg p-6">
                                        <img src="{{ $sponsor->logo_path }}" alt="{{ $sponsor->name }}" class="h-12">
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
                                        <img src="{{ $sponsor->logo_path }}" alt="{{ $sponsor->name }}" class="h-12">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
