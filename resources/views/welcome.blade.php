@php
    use App\Models\Sponsorship;
    use Carbon\Carbon;
    $goldSponsors = \App\Models\Sponsorship::find(1)?->companies()->where('is_sponsorship_approved', true)->get();
    $silverSponsors = \App\Models\Sponsorship::find(2)?->companies()->where('is_sponsorship_approved', true)->get();
    $bronzeSponsors = \App\Models\Sponsorship::find(3)?->companies()->where('is_sponsorship_approved', true)->get();
    $eventDate = Carbon::create(2025, 11, 14, 9, 0, 0);
@endphp

<x-app-layout>
    <div class="flex flex-col overflow-hidden relative min-h-screen bg-[#0B1221]">
        <!-- Animated background gradients -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- First gradient circle -->
            <div class="absolute top-0 -left-1/4 w-[800px] h-[800px] bg-gradient-radial from-[#31F7F1]/30 via-[#3B82F6]/20 to-transparent rounded-full blur-3xl animate-float-slow"></div>
            
            <!-- Second gradient circle -->
            <div class="absolute bottom-0 -right-1/4 w-[800px] h-[800px] bg-gradient-radial from-[#E2FF32]/30 via-[#31F7F1]/20 to-transparent rounded-full blur-3xl animate-float-slower"></div>
        </div>

        <!-- Hero Section -->
        <div class="relative z-10">
            <div class="relative max-w-7xl mx-auto px-4 pt-24 pb-24">
                <!-- Main Hero Content -->
                <div class="text-center mb-16">
                    <h2 class="text-2xl text-white mb-8">Discover your spark in the IT Wave</h2>
                    <div class="relative space-y-2">
                        <div class="text-8xl font-bold" style="text-shadow: 0 0 40px rgba(226, 255, 50, 0.8);">
                            <span class="text-[#E2FF32]">WE ARE IN IT</span>
                            <span class="text-[#FF3B9A]" style="text-shadow: 0 0 40px rgba(255, 59, 154, 0.8);">TOGETHER</span>
                        </div>
                        <div class="text-8xl font-bold">
                            <span class="text-[#E2FF32]" style="text-shadow: 0 0 40px rgba(226, 255, 50, 0.8);">CONFERENCE</span>
                            <span class="text-[#FF3B9A]" style="text-shadow: 0 0 40px rgba(255, 59, 154, 0.8);">2025</span>
                        </div>
                        <div class="relative w-full">
                            @if($goldSponsors && $goldSponsors->isNotEmpty())
                                <span class="absolute left-32 text-xl text-white">Co-hosted by {{ $goldSponsors->first()->name }}</span>
                            @endif
                            <span class="absolute right-32 text-xl text-white">Powered by New Waves</span>
                        </div>
                    </div>
                    <div class="mt-12 text-gray-400">
                        <p class="text-2xl mb-1">14th November 2025</p>
                        <p class="text-2xl">HZ University of Applied Sciences, Middelburg</p>
                    </div>
                    <div class="mt-16 flex justify-center space-x-6">
                        @guest()
                            @if(optional($edition)->is_participant_registration_opened)
                                <a href="{{route('register.participant')}}" class="px-8 py-4 bg-[#31F7F1] text-[#0B1221] rounded-xl text-xl font-semibold hover:bg-opacity-90 transition-all">
                                    Register as Participant
                                </a>
                            @endif
                            @if(optional($edition)->is_company_registration_opened)
                                <a href="{{route('register.company')}}" class="px-8 py-4 border-2 border-[#31F7F1] text-[#31F7F1] rounded-xl text-xl font-semibold hover:bg-[#31F7F1] hover:text-[#0B1221] transition-all">
                                    Register Company
                                </a>
                            @endif
                        @endguest
                        @if($edition)
                            <a href="{{ route('companies.index') }}" class="px-8 py-4 border-2 border-[#31F7F1] text-[#31F7F1] rounded-xl text-xl font-semibold hover:bg-[#31F7F1] hover:text-[#0B1221] transition-all">
                                View Companies
                            </a>
                            <a href="{{ route('speakers.index') }}" class="px-8 py-4 border-2 border-[#31F7F1] text-[#31F7F1] rounded-xl text-xl font-semibold hover:bg-[#31F7F1] hover:text-[#0B1221] transition-all">
                                View Speakers
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Countdown Section -->
                <div class="mt-16 float-animation">
                    @if ($edition)
                        <x-countdown :time="$edition->start_at"/>
                    @else
                        <x-countdown :time="$eventDate"/>
                    @endif
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
                                <a href="#" class="text-[#FF3B9A] flex items-center">
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
    </style>
</x-app-layout>

