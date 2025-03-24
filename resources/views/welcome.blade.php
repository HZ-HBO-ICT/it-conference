@php
    use App\Models\Sponsorship;
    $goldSponsors = \App\Models\Sponsorship::find(1)?->companies()->where('is_sponsorship_approved', true)->get();
    $silverSponsors = \App\Models\Sponsorship::find(2)?->companies()->where('is_sponsorship_approved', true)->get();
    $bronzeSponsors = \App\Models\Sponsorship::find(3)?->companies()->where('is_sponsorship_approved', true)->get();

@endphp

<x-app-layout>
    <div class="flex flex-col overflow-hidden relative min-h-screen">

        <!-- Full-page background gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#e9f8ff] via-[#d6f2ff] to-[#f0fbff] -z-10"></div>

        <!-- BUBBLE ANIMATION LAYER -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
        </div>

        <!-- Custom Cursor -->
        <div class="bubble-cursor"></div>

        <!-- Hero Section -->
        <div class="relative z-10">
            <div class="relative flex flex-col items-center px-4 pt-36 pb-24">
                <!-- Date -->
                <div class="mb-6">
                    <span class="bg-blue-100 text-blue-700 py-1 px-3 rounded-full text-sm font-semibold shadow-sm">
                        {{ $edition->start_at->format('F d, Y') }}
                    </span>
                </div>

                <!-- Title -->
                <h1 class="text-center text-5xl md:text-6xl font-bold text-[#0b253f] mb-8 leading-tight max-w-4xl">
                    We Are In IT Together Conference 2026
                </h1>

                <h2 class="text-center text-xl md:text-2xl mb-4 text-[#0b253f] max-w-3xl">
                    Theme: <span class="text-blue-500 font-bold">Water</span> & <span class="text-yellow-400 font-bold">Energy</span> - Co-hosted by {{ $goldSponsorCompany?->name }}
                </h2>

                <p class="text-center text-lg text-[#1f415f] max-w-2xl mb-10">
                    Uniting tech, sustainability, and innovation. Join us for a journey into the future of IT.
                </p>

                <!-- CTAs -->
                <div class="mb-16 flex gap-4 flex-wrap justify-center">
                    <a href="{{ route('companies.index') }}" class="px-6 py-3 rounded-lg bg-blue-500 text-white font-semibold hover:bg-blue-600 transition shadow-lg">
                        View Companies
                    </a>
                    <a href="{{ route('speakers.index') }}" class="px-6 py-3 rounded-lg border border-blue-500 text-blue-500 font-semibold hover:bg-blue-50 transition shadow-md">
                        View Speakers
                    </a>
                </div>

                <!-- Countdown -->
                <div class="w-full flex justify-center mt-8 max-w-xl">
                    <x-countdown :time="$edition->start_at"/>
                </div>
            </div>
        </div>

        <section class="relative z-10 py-24">
            <div class="max-w-[90%] mx-auto px-4 md:px-8">
                <div class="rounded-[16px] bg-white/30 backdrop-blur-lg shadow-2xl border border-white/50 p-16 md:p-20">

                    <!-- Badge -->
                    <div class="text-center mb-4">
                <span class="inline-block bg-white/80 text-blue-500 font-semibold px-4 py-1 rounded-full shadow backdrop-blur-sm">
                    Why Attend
                </span>
                    </div>

                    <!-- Title -->
                    <h2 class="text-center text-4xl md:text-5xl font-bold text-[#0b253f] mb-4">
                        The Future of IT in <span class="text-blue-500">Water & Energy</span>
                    </h2>

                    <!-- Subtitle -->
                    <p class="text-center text-lg text-gray-700 max-w-3xl mx-auto mb-8">
                        Discover how technology is transforming the water and energy sectors, creating sustainable solutions for our future.
                    </p>

                    <!-- Divider -->
                    <div class="w-24 h-1 bg-blue-400 mx-auto rounded-full mb-12"></div>

                    <!-- Cards -->
                    <div class="grid md:grid-cols-3 gap-6 text-center">
                        <div class="bg-white rounded-xl shadow-md px-6 py-8">
                            <div class="flex flex-col items-center mb-4">
                                <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center mb-2"></div>
                                <h3 class="text-2xl font-bold text-blue-500">50+</h3>
                            </div>
                            <h4 class="text-lg font-semibold text-[#0b253f]">Expert Speakers</h4>
                            <p class="text-gray-600 mt-2">Industry leaders and innovators sharing insights</p>
                        </div>
                        <div class="bg-white rounded-xl shadow-md px-6 py-8">
                            <div class="flex flex-col items-center mb-4">
                                <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center mb-2"></div>
                                <h3 class="text-2xl font-bold text-blue-500">1000+</h3>
                            </div>
                            <h4 class="text-lg font-semibold text-[#0b253f]">Attendees</h4>
                            <p class="text-gray-600 mt-2">IT professionals, developers, and decision makers</p>
                        </div>
                        <div class="bg-white rounded-xl shadow-md px-6 py-8">
                            <div class="flex flex-col items-center mb-4">
                                <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center mb-2"></div>
                                <h3 class="text-2xl font-bold text-blue-500">30+</h3>
                            </div>
                            <h4 class="text-lg font-semibold text-[#0b253f]">Workshops</h4>
                            <p class="text-gray-600 mt-2">Hands-on sessions on cutting-edge technologies</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="flex flex-col overflow-hidden relative min-h-screen">
                <!-- Full-page background gradient -->
                <div class="absolute inset-0 bg-gradient-to-br from-[#e9f8ff] via-[#d6f2ff] to-[#f0fbff] -z-10"></div>

                <!-- Custom Cursor -->
                <div class="bubble-cursor"></div>

{{--                <section class="relative z-10 py-24 overflow-hidden bg-gradient-to-br from-[#89d4f6] via-[#e7efff] to-[#ffffff] backdrop-blur-sm">--}}
                    <div class="flex flex-col overflow-hidden relative min-h-screen">

                        <!-- Full-page background gradient -->
{{--                        <div class="absolute inset-0 bg-gradient-to-br from-[#e9f8ff] via-[#d6f2ff] to-[#f0fbff] -z-10"></div>--}}

                        <!-- BUBBLE ANIMATION LAYER -->
                        <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
                            <div class="bubble"></div>
                            <div class="bubble"></div>
                            <div class="bubble"></div>
                            <div class="bubble"></div>
                            <div class="bubble"></div>
                            <div class="bubble"></div>

                        </div>

                        <div class="max-w-7xl mx-auto px-8 flex flex-col items-center space-y-24">

                            <!-- Gold Sponsors -->
                            @if($goldSponsors->count())
                                <div class="w-full text-center mt-16">
                                    <h3 class="text-4xl font-bold text-yellow-500 mb-8">Gold Sponsors</h3>
                                    <div class="flex justify-center gap-8 flex-wrap">
                                        @foreach($goldSponsors as $company)
                                            <a href="{{ $company->website }}" class="group relative bg-white/80 rounded-3xl shadow-xl p-8 w-72 flex flex-col items-center justify-center transition-transform hover:scale-105 hover:shadow-2xl border border-yellow-300">
                                                <span class="absolute top-4 left-4 text-xs uppercase font-bold px-3 py-1 rounded-full bg-yellow-400 text-white shadow">Gold</span>
                                                <img src="{{ url('storage/' . $company->logo_path) }}" alt="Logo of {{ $company->name }}" class="object-contain h-24 w-auto transition-transform group-hover:scale-110">
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Silver Sponsors -->
                            @if($silverSponsors->count())
                                <div class="w-full text-center mt-16">
                                    <h3 class="text-4xl font-bold text-gray-500 mb-8">Silver Sponsors</h3>
                                    <div class="flex justify-center gap-8 flex-wrap">
                                        @foreach($silverSponsors as $company)
                                            <a href="{{ $company->website }}" class="group relative bg-white/80 rounded-3xl shadow-xl p-8 w-64 flex flex-col items-center justify-center transition-transform hover:scale-105 hover:shadow-2xl border border-gray-400">
                                                <span class="absolute top-4 left-4 text-xs uppercase font-bold px-3 py-1 rounded-full bg-gray-500 text-white shadow">Silver</span>
                                                <img src="{{ url('storage/' . $company->logo_path) }}" alt="Logo of {{ $company->name }}" class="object-contain h-20 w-auto transition-transform group-hover:scale-110">
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Bronze Sponsors -->
                            @if($bronzeSponsors->count())
                                <div class="w-full text-center mt-16 mb-24">
                                    <h3 class="text-4xl font-bold text-orange-500 mb-8">Bronze Sponsors</h3>
                                    <div class="flex justify-center gap-8 flex-wrap">
                                        @foreach($bronzeSponsors as $company)
                                            <a href="{{ $company->website }}" class="group relative bg-white/80 rounded-3xl shadow-xl p-8 w-60 flex flex-col items-center justify-center transition-transform hover:scale-105 hover:shadow-2xl border border-orange-400">
                                                <span class="absolute top-4 left-4 text-xs uppercase font-bold px-3 py-1 rounded-full bg-orange-400 text-white shadow">Bronze</span>
                                                <img src="{{ url('storage/' . $company->logo_path) }}" alt="Logo of {{ $company->name }}" class="object-contain h-16 w-auto transition-transform group-hover:scale-110">
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
{{--                </section>--}}

            </div>
        <style>
            .glow-effect::before {
                content: "";
                position: absolute;
                width: 200%;
                height: 200%;
                top: -50%;
                left: -50%;
                background: radial-gradient(circle, rgba(255, 234, 0, 0.15) 0%, rgba(255, 234, 0, 0) 70%);
                opacity: 0.6;
                animation: soft-glow 2.5s infinite;
                pointer-events: none;
            }

            @keyframes soft-glow {
                0% { transform: scale(1); opacity: 0.6; }
                50% { transform: scale(1.15); opacity: 0.4; }
                100% { transform: scale(1); opacity: 0.6; }
            }

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
    @keyframes bubble-rise {
        0% { transform: translateY(0) scale(1); opacity: 1; }
        100% { transform: translateY(-150%) scale(0.8); opacity: 0; }
    }
    body {
        cursor: none;
    }

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
        background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.95) 20%, rgba(0, 175, 255, 0.3) 70%, rgba(0, 175, 255, 0.1) 100%);
        box-shadow: inset -8px -8px 20px rgba(255, 255, 255, 0.6), 0 0 30px rgba(0, 175, 255, 0.4);
        opacity: 0.9;
        backdrop-filter: blur(1px);
    }

    /* Optional: scale effect when hovering clickable elements */
    a:hover ~ .bubble-cursor,
    button:hover ~ .bubble-cursor {
        transform: scale(1.2);
    }

            /* Bottom to Top */
            .bubble:nth-child(1)  { width: 60px; height: 60px; left: 5%; bottom: -100px; animation: rise-up 8s infinite ease-in-out; }
            .bubble:nth-child(2)  { width: 80px; height: 80px; left: 20%; bottom: -100px; animation: rise-up 10s infinite ease-in-out; }
            .bubble:nth-child(3)  { width: 50px; height: 50px; left: 75%; bottom: -100px; animation: rise-up 9s infinite ease-in-out; }

            /* Left to Top-Right */
            .bubble:nth-child(4)  { width: 70px; height: 70px; left: -80px; top: 20%; animation: rise-diagonal-right 15s infinite ease-in-out; }
            .bubble:nth-child(5)  { width: 45px; height: 45px; left: -80px; top: 50%; animation: rise-diagonal-right 12s infinite ease-in-out; }

            /* Right to Top-Left */
            .bubble:nth-child(6)  { width: 60px; height: 60px; right: -80px; top: 15%; animation: rise-diagonal-left 13s infinite ease-in-out; }
            .bubble:nth-child(7)  { width: 35px; height: 35px; right: -80px; top: 70%; animation: rise-diagonal-left 10s infinite ease-in-out; }

            /* Top to Bottom-Right */
            .bubble:nth-child(8)  { width: 65px; height: 65px; left: 25%; top: -100px; animation: float-down-right 14s infinite ease-in-out; }

            /* Top to Bottom-Left */
            .bubble:nth-child(9)  { width: 55px; height: 55px; left: 65%; top: -100px; animation: float-down-left 12s infinite ease-in-out; }

            /* Extra bottom bubbles */
            .bubble:nth-child(10) { width: 50px; height: 50px; left: 50%; bottom: -100px; animation: rise-up 11s infinite ease-in-out; }
            .bubble:nth-child(11) { width: 40px; height: 40px; left: 90%; bottom: -100px; animation: rise-up 9s infinite ease-in-out; }
            .bubble:nth-child(12) { width: 70px; height: 70px; left: 35%; bottom: -100px; animation: rise-up 8s infinite ease-in-out; }

            /* Animations */
    @keyframes rise-up {
        0% { transform: translateY(0) scale(1); opacity: 0.9; }
        50% { transform: translateY(-50vh) scale(1.05); opacity: 0.6; }
        100% { transform: translateY(-120vh) scale(1); opacity: 0; }
    }

    @keyframes rise-diagonal-right {
        0% { transform: translate(0, 0) scale(1); opacity: 0.9; }
        50% { transform: translate(50vw, -40vh) scale(1.05); opacity: 0.6; }
        100% { transform: translate(100vw, -90vh) scale(0.95); opacity: 0; }
    }

    @keyframes rise-diagonal-left {
        0% { transform: translate(0, 0) scale(1); opacity: 0.9; }
        50% { transform: translate(-50vw, -40vh) scale(1.05); opacity: 0.6; }
        100% { transform: translate(-100vw, -90vh) scale(0.95); opacity: 0; }
    }

    @keyframes float-down-right {
        0% { transform: translate(0, 0) scale(1); opacity: 0.9; }
        50% { transform: translate(20vw, 40vh) scale(1.05); opacity: 0.6; }
        100% { transform: translate(50vw, 90vh) scale(0.95); opacity: 0; }
    }

    @keyframes float-down-left {
        0% { transform: translate(0, 0) scale(1); opacity: 0.9; }
        50% { transform: translate(-20vw, 40vh) scale(1.05); opacity: 0.6; }
        100% { transform: translate(-50vw, 90vh) scale(0.95); opacity: 0; }
    }
</style>

<script>
    document.addEventListener('mousemove', e => {
        const bubbleCursor = document.querySelector('.bubble-cursor');
        bubbleCursor.style.left = `${e.clientX}px`;
        bubbleCursor.style.top = `${e.clientY}px`;
    });
</script>
</x-app-layout>

