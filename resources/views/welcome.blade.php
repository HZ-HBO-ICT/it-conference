<x-app-layout>
    <link href="{{ asset('/css/welcome-custom.css') }}" rel="stylesheet">
    <div class="relative min-h-screen overflow-hidden">
        <!-- Blobs adjusted for mobile -->
        <div class="fixed inset-0 pointer-events-none z-0">
            <!-- Yellow Blob -->
            <div class="absolute left-[8%] top-[20%] w-[400px] h-[400px] max-sm:w-[200px] max-sm:h-[200px] rounded-full animate-blob1"
                 style="background: radial-gradient(circle, #e2ff32 0%, transparent 70%); filter: blur(40px); opacity: 0.55;"></div>
            <!-- Pink Blob -->
            <div class="absolute right-[8%] top-[35%] w-[350px] h-[350px] max-sm:w-[180px] max-sm:h-[180px] rounded-full animate-blob2"
                 style="background: radial-gradient(circle, #ff3b9a 0%, transparent 70%); filter: blur(50px); opacity: 0.38;"></div>
            <!-- Blue Blob -->
            <div class="absolute left-1/2 bottom-[10%] w-[500px] h-[500px] max-sm:w-[250px] max-sm:h-[250px] -translate-x-1/2 rounded-full animate-blob3"
                 style="background: radial-gradient(circle, #31f7f1 0%, transparent 70%); filter: blur(60px); opacity: 0.32;"></div>
        </div>

        <div class="flex flex-col overflow-hidden relative min-h-screen z-10">
            <!-- Hero Section -->
            <div class="relative z-10">
                <div class="relative max-w-7xl mx-auto px-4 pt-24 pb-24 max-sm:pt-16 max-sm:pb-16">
                    <!-- Main Hero Content -->
                    <div class="text-center mb-16">
                        <h2 class="text-2xl text-white mb-8 max-sm:text-lg">Discover your spark in the digital wave</h2>
                        <div class="relative space-y-2">
                            <div class="text-8xl font-bold max-sm:text-4xl">
                                <span class="text-waitt-yellow uppercase text-shadow-none sm:waitt-yellow-glow-title">We Are in IT</span>
                                <span class="text-waitt-yellow uppercase sm:waitt-pink-glow-title sm:text-waitt-pink">Together</span>
                            </div>
                            <div class="text-8xl font-bold max-sm:text-4xl">
                                <span class="text-waitt-pink uppercase sm:waitt-yellow-glow-title sm:text-waitt-yellow">conference</span>
                                <span class="text-waitt-pink uppercase sm:waitt-pink-glow-title sm:text-waitt-pink">2025</span>
                            </div>
                            <div class="flex justify-center gap-16 mt-10 max-sm:flex-col max-sm:gap-4 max-sm:mt-6">
                                @if($goldSponsor)
                                    <span class="text-xl text-white max-sm:text-base">Co-hosted by {{ $goldSponsor->name }}</span>
                                @endif
                                <span class="text-xl text-white max-sm:text-base">Powered by New Waves</span>
                            </div>
                        </div>
                        <div class="mt-12 text-gray-400 max-sm:mt-6">
                            <p class="text-2xl mb-1 max-sm:text-lg">
                                @if($edition && $edition->start_at)
                                    {{ $edition->start_at->format('j F Y') }}
                                @else
                                    The date will be provided soon!
                                @endif
                            </p>
                            <p class="text-2xl max-sm:text-lg">HZ University of Applied Sciences, Middelburg</p>
                        </div>
                        <div class="mt-16 flex justify-center space-x-6 max-sm:flex-col max-sm:space-x-0 max-sm:space-y-4 max-sm:mt-8">
                            @if(optional($edition)->is_participant_registration_opened)
                                <a href="{{ route('register.participant') }}" class="px-8 py-4 max-sm:px-6 max-sm:py-3 bg-waitt-cyan text-primary-dark rounded-xl text-xl max-sm:text-lg font-semibold hover:bg-opacity-90 transition-all">
                                    Register Now
                                </a>
                            @endif
                            @if(optional($edition)->is_final_programme_released)
                                <a href="{{ route('programme') }}" class="px-8 py-4 max-sm:px-6 max-sm:py-3 border-2 border-waitt-cyan text-waitt-cyan rounded-xl text-xl max-sm:text-lg font-semibold hover:bg-waitt-cyan hover:text-primary-dark transition-all">
                                    View Programme
                                </a>
                            @endif
                        </div>
                    </div>

                    @php
                        $showButtons = optional($edition)->is_participant_registration_opened || optional($edition)->is_final_programme_released;
                    @endphp

                        <!-- Countdown adjusted for mobile -->
                    <div class="w-full flex justify-center @if(optional($edition)->is_in_progress) mt-8 @else mt-16 @endif max-sm:mt-6">
                        @if ($edition)
                            <x-countdown :time="$edition->start_at" class="max-sm:text-sm"/>
                        @endif
                    </div>

                    <!-- Stats Grid adjusted for mobile -->
                    <div class="grid grid-cols-4 gap-8 text-center mt-32 mb-32 max-sm:grid-cols-2 max-sm:mt-12 max-sm:mb-12">
                        <div class="border-2 border-waitt-pink rounded-lg p-6 max-sm:p-2">
                            <div class="text-5xl max-sm:text-xl font-bold text-waitt-pink">10+</div>
                            <div class="text-white mt-2 uppercase max-sm:text-sm">speakers</div>
                        </div>
                        <div class="border-2 border-waitt-pink rounded-lg p-6 max-sm:p-2">
                            <div class="text-5xl max-sm:text-xl font-bold text-waitt-pink">200+</div>
                            <div class="text-white mt-2 uppercase max-sm:text-sm">students</div>
                        </div>
                        <div class="border-2 border-waitt-pink rounded-lg p-6 max-sm:p-2">
                            <div class="text-5xl max-sm:text-xl font-bold text-waitt-pink">20+</div>
                            <div class="text-white mt-2 uppercase max-sm:text-sm">companies</div>
                        </div>
                        <div class="border-2 border-waitt-pink rounded-lg p-6 max-sm:p-2">
                            <div class="text-5xl max-sm:text-xl font-bold text-waitt-pink">15+</div>
                            <div class="text-white mt-2 uppercase max-sm:text-sm">presentations</div>
                        </div>
                    </div>

                    <!-- What to Expect adjusted for mobile -->
                    <div class="mt-32 max-sm:mt-16">
                        <h2 class="text-4xl max-sm:text-2xl font-bold text-white mb-12 max-sm:mb-6">What to expect</h2>
                        <div class="grid grid-cols-3 gap-8 max-sm:grid-cols-1">
                            <!-- Speakers Card -->
                            <div class="rounded-lg overflow-hidden bg-gradient-to-b from-primary-dark via-waitt-cyan/20 to-waitt-cyan/40 max-sm:p-4">
                                <div class="p-8 max-sm:p-4">
                                    <h3 class="text-waitt-cyan text-2xl max-sm:text-lg font-bold mb-4 uppercase">speakers</h3>
                                    <p class="text-white mb-8 max-sm:mb-4 max-sm:text-sm">Industry leaders and innovators. Find the chance to connect with the best in our industry.</p>
                                    <a href="{{ route('speakers.index') }}" class="text-waitt-cyan flex items-center max-sm:text-sm">
                                        Learn more
                                        <svg class="w-5 h-5 ml-2 max-sm:w-4 max-sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Presentations Card -->
                            <div class="rounded-lg overflow-hidden bg-gradient-to-b from-primary-dark via-waitt-pink/20 to-waitt-pink/40 max-sm:p-4">
                                <div class="p-8 max-sm:p-4">
                                    <h3 class="text-waitt-pink text-2xl max-sm:text-lg font-bold mb-4 uppercase">presentations & workshops</h3>
                                    <p class="text-white mb-8 max-sm:mb-4 max-sm:text-sm">Cutting edge-topics and hands-on workshops to enhance your skills.</p>
                                    @if(optional($edition)->is_final_programme_released)
                                        <a href="{{ route('programme') }}" class="text-waitt-pink flex items-center max-sm:text-sm">
                                            Learn more
                                            <svg class="w-5 h-5 ml-2 max-sm:w-4 max-sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Companies Card -->
                            <div class="rounded-lg overflow-hidden bg-gradient-to-b from-primary-dark to-accent-olive max-sm:p-4">
                                <div class="p-8 max-sm:p-4">
                                    <h3 class="text-waitt-yellow text-2xl max-sm:text-lg font-bold mb-4 uppercase">companies</h3>
                                    <p class="text-white mb-8 max-sm:mb-4 max-sm:text-sm">Meet the companies that make the IT world move. Find your chance to start your career/internship.</p>
                                    <a href="{{ route('companies.index') }}" class="text-waitt-yellow flex items-center max-sm:text-sm">
                                        Learn more
                                        <svg class="w-5 h-5 ml-2 max-sm:w-4 max-sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sponsors Section adjusted for mobile -->
                    <div class="mt-32 max-sm:mt-16">
                        @if ($goldSponsor || $silverSponsors->isNotEmpty() || $bronzeSponsors->isNotEmpty())
                            <h2 class="text-4xl max-sm:text-2xl font-bold text-white mb-12 max-sm:mb-6">Thank you to our Sponsors</h2>
                        @endif

                        <!-- Gold Sponsors -->
                        @if ($goldSponsor)
                            <div class="mb-12">
                                <x-waitt.tag title="Gold" />
                                <div class="grid grid-cols-1 gap-6 mt-6 w-3/5">
                                    <div class="bg-waitt-dark/70 backdrop-blur-sm border-2 border-gold rounded-lg p-6 max-sm:p-4">
                                        <img src="{{ url('storage/' . $goldSponsor->logo_path) }}" alt="{{ $goldSponsor->name }}" class="w-full h-56 max-sm:h-8">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Silver Sponsors -->
                        @if($silverSponsors->isNotEmpty())
                            <div class="mb-12">
                                <x-waitt.tag title="Silver" />
                                <div class="grid grid-cols-2 gap-6 mt-6 max-sm:grid-cols-1">
                                    @foreach($silverSponsors as $sponsor)
                                        <div class="bg-waitt-dark/70 backdrop-blur-sm border-2 border-silver rounded-lg p-6 max-sm:p-4">
                                            <img src="{{ url('storage/' . $sponsor->logo_path) }}" alt="{{ $sponsor->name }}" class="w-full h-40 max-sm:h-8">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Bronze Sponsors -->
                        @if($bronzeSponsors->isNotEmpty())
                            <div>
                                <x-waitt.tag title="Bronze" />
                                <div class="grid grid-cols-4 gap-6 mt-6 max-sm:grid-cols-2">
                                    @foreach($bronzeSponsors as $sponsor)
                                        <div class="bg-waitt-dark/70 backdrop-blur-sm border-2 border-bronze rounded-lg p-6 max-sm:p-4">
                                            <img src="{{ url('storage/' . $sponsor->logo_path) }}" alt="{{ $sponsor->name }}" class="w-full h-20 max-sm:h-8">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
