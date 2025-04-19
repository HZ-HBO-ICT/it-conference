@php
    use App\Models\Sponsorship;
    $goldSponsors = \App\Models\Sponsorship::find(1)?->companies()->where('is_sponsorship_approved', true)->get();
    $silverSponsors = \App\Models\Sponsorship::find(2)?->companies()->where('is_sponsorship_approved', true)->get();
    $bronzeSponsors = \App\Models\Sponsorship::find(3)?->companies()->where('is_sponsorship_approved', true)->get();
@endphp

<x-app-layout>
    <div class="flex flex-col overflow-hidden relative min-h-screen">
        <!-- Multi-layered background -->
        <div class="fixed inset-0 -z-10">
            <!-- Base gradient -->
            <div class="absolute inset-0 bg-gradient-to-br from-[#e8f7ff] via-[#dcf2ff] to-[#f0fbff] dark:from-gray-900 dark:via-gray-800 dark:to-gray-900"></div>
            
            <!-- Subtle pattern overlay -->
            <div class="absolute inset-0 opacity-30 bg-[radial-gradient(circle_at_50%_50%,rgba(255,255,255,0.8),transparent_1px)] [background-size:20px_20px]"></div>
            
            <!-- Dynamic color accents -->
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-0 left-0 w-1/2 h-1/2 bg-gradient-to-br from-blue-200/40 via-transparent to-transparent transform -translate-y-1/2"></div>
                <div class="absolute top-1/2 right-0 w-1/2 h-1/2 bg-gradient-to-tl from-teal-200/30 via-transparent to-transparent transform translate-y-1/2"></div>
                <div class="absolute bottom-0 left-1/4 w-1/2 h-1/2 bg-gradient-to-tr from-purple-200/20 via-transparent to-transparent"></div>
            </div>
            
            <!-- Soft light rays -->
            <div class="absolute inset-0 opacity-30 bg-[conic-gradient(from_0deg_at_50%_50%,transparent_0deg,rgba(255,255,255,0.8)_90deg,transparent_180deg,rgba(255,255,255,0.8)_270deg,transparent_360deg)]"></div>
        </div>

        <!-- BUBBLE ANIMATION LAYER -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
            @for ($i = 1; $i <= 14; $i++)
                <div class="bubble"></div>
            @endfor
        </div>

        <!-- Custom Cursor -->
        <div class="bubble-cursor"></div>

        <!-- Sponsors Section -->
        <section class="relative py-32">
            <!-- Full-width background with overlay -->
            <div class="absolute inset-x-0 inset-y-0 bg-white/20 dark:bg-gray-900/20 backdrop-blur-sm"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-[#0b253f] dark:text-white mb-4">Our Sponsors</h2>
                    <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        Join industry leaders who are shaping the future of technology and sustainability
                    </p>
                </div>

                <!-- Sponsors Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Gold Sponsors -->
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/20 to-yellow-600/20 rounded-2xl blur-xl group-hover:blur-2xl transition-all duration-500"></div>
                        <div class="relative bg-white/20 dark:bg-gray-900/20 backdrop-blur-xl rounded-2xl p-8 shadow-lg border border-yellow-200/30 dark:border-yellow-900/30 hover:shadow-xl transition-all duration-300">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-yellow-400/20 to-yellow-600/20 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                            <div class="relative">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-xl font-bold text-[#0b253f]">Gold Sponsors</h3>
                                    <div class="flex space-x-1">
                                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                    </div>
                                </div>
                                <p class="text-gray-600 mb-6">
                                    Premium visibility and exclusive networking opportunities at the highest tier
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-yellow-600">Starting at €5,000</span>
                                    <a href="{{ route('contact') }}" class="text-blue-600 hover:text-blue-700 font-medium flex items-center">
                                        Learn more
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Silver Sponsors -->
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-400/20 to-gray-600/20 rounded-2xl blur-xl group-hover:blur-2xl transition-all duration-500"></div>
                        <div class="relative bg-white/20 dark:bg-gray-900/20 backdrop-blur-xl rounded-2xl p-8 shadow-lg border border-gray-200/30 dark:border-gray-700/30 hover:shadow-xl transition-all duration-300">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-gray-400/20 to-gray-600/20 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                            <div class="relative">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-xl font-bold text-[#0b253f]">Silver Sponsors</h3>
                                    <div class="flex space-x-1">
                                        <div class="w-3 h-3 rounded-full bg-gray-400"></div>
                                        <div class="w-3 h-3 rounded-full bg-gray-400"></div>
                                    </div>
                                </div>
                                <p class="text-gray-600 mb-6">
                                    Strong presence and valuable connections at a competitive investment level
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-600">Starting at €2,500</span>
                                    <a href="{{ route('contact') }}" class="text-blue-600 hover:text-blue-700 font-medium flex items-center">
                                        Learn more
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bronze Sponsors -->
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-amber-700/20 to-amber-900/20 rounded-2xl blur-xl group-hover:blur-2xl transition-all duration-500"></div>
                        <div class="relative bg-white/20 dark:bg-gray-900/20 backdrop-blur-xl rounded-2xl p-8 shadow-lg border border-amber-200/30 dark:border-amber-900/30 hover:shadow-xl transition-all duration-300">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-amber-700/20 to-amber-900/20 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                            <div class="relative">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-xl font-bold text-[#0b253f]">Bronze Sponsors</h3>
                                    <div class="flex space-x-1">
                                        <div class="w-3 h-3 rounded-full bg-amber-700"></div>
                                    </div>
                                </div>
                                <p class="text-gray-600 mb-6">
                                    Quality exposure and networking opportunities at an accessible investment level
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-amber-700">Starting at €1,000</span>
                                    <a href="{{ route('contact') }}" class="text-blue-600 hover:text-blue-700 font-medium flex items-center">
                                        Learn more
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA Section -->
                <div class="mt-16 text-center">
                    <p class="text-gray-600 mb-6">Ready to become a sponsor? Contact us to learn more about our sponsorship opportunities.</p>
                    <a href="{{ route('contact') }}" 
                       class="inline-flex items-center px-6 py-3 rounded-lg bg-gradient-to-r from-blue-600 to-teal-500 text-white font-medium hover:from-blue-700 hover:to-teal-600 transition-all duration-200 shadow-md hover:shadow-lg">
                        Become a Sponsor
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    </div>

    <style>
        .bubble-cursor {
            position: fixed;
            width: 30px;
            height: 30px;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.95) 20%, rgba(0, 175, 255, 0.4) 70%, rgba(0, 175, 255, 0.1) 100%);
            border-radius: 50%;
            box-shadow: inset -4px -4px 10px rgba(255, 255, 255, 0.6), 0 0 15px rgba(0, 175, 255, 0.4);
            pointer-events: none;
            z-index: 50;
            transform: translate(-50%, -50%);
            transition: transform 0.05s ease;
            backdrop-filter: blur(1px);
        }

        .bubble {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.98) 20%, rgba(0, 175, 255, 0.4) 70%, rgba(0, 175, 255, 0.2) 100%);
            box-shadow: inset -8px -8px 20px rgba(255, 255, 255, 0.8), 0 0 30px rgba(0, 175, 255, 0.6);
            opacity: 0.95;
            backdrop-filter: blur(1px);
            animation: float 15s infinite ease-in-out;
        }

        .bubble:nth-child(1) { width: 80px; height: 80px; left: 5%; animation-duration: 13s; }
        .bubble:nth-child(2) { width: 100px; height: 100px; left: 20%; animation-duration: 17s; }
        .bubble:nth-child(3) { width: 60px; height: 60px; left: 35%; animation-duration: 11s; }
        .bubble:nth-child(4) { width: 90px; height: 90px; left: 50%; animation-duration: 15s; }
        .bubble:nth-child(5) { width: 70px; height: 70px; left: 65%; animation-duration: 14s; }
        .bubble:nth-child(6) { width: 110px; height: 110px; left: 80%; animation-duration: 16s; }
        .bubble:nth-child(7) { width: 65px; height: 65px; left: 90%; animation-duration: 12s; }

        @keyframes float {
            0%, 100% {
                transform: translateY(100vh) translateX(-20px);
                opacity: 0.2;
            }
            50% {
                transform: translateY(50vh) translateX(20px);
                opacity: 0.95;
            }
            75% {
                transform: translateY(25vh) translateX(-20px);
                opacity: 0.6;
            }
        }

        body {
            cursor: none;
        }

        a:hover ~ .bubble-cursor,
        button:hover ~ .bubble-cursor {
            transform: scale(1.2);
        }
    </style>
    <script>
        document.addEventListener('mousemove', e => {
            const cursor = document.querySelector('.bubble-cursor');
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
        });

        // Initialize bubbles at random positions
        document.querySelectorAll('.bubble').forEach(bubble => {
            bubble.style.left = Math.random() * 100 + '%';
            bubble.style.animationDelay = Math.random() * 10 + 's';
        });
    </script>
</x-app-layout> 