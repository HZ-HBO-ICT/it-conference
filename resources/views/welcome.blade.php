<<<<<<< HEAD
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
=======
<x-app-layout>
    <div class="flex flex-col overflow-hidden">
        <!-- The main banner -->
        <div class="relative">
            <div class="relative flex flex-col items-center px-4 py-16">
                <!--Titles-->
                <div
                    class="flex flex-col md:flex-row justify-start items-start w-full max-w-7xl space-y-8 md:space-y-0 md:space-x-8 mt-6">
                    <div
                        class="text-white w-full lg:ml-16 md:w-3/5 font-extrabold text-5xl lg:text-7xl md:text-7xl sm:text-5xl uppercase">
                        <h1 class="leading-extra-tight" style="text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);">
                            We are in IT together Conference
                        </h1>
                        @if($goldSponsor && $edition)
                            <h2 class="mt-3 pl-1 uppercase font-bold text-lg">
                                Co-hosted by {{ $goldSponsor->name }}
                            </h2>
                        @endif
                    </div>
                    <div class="w-full md:w-1/2 pt-1 text-xl font-montserrat">
                        <h2 class="uppercase font-bold">
                            Annual IT Conference
                        </h2>
                        <h2 class="uppercase font-medium mb-8">
                            @if($edition)
                                {{ $edition->start_at->format('j F Y') }}
                            @else
                                The date will be provided soon!
                            @endif
                        </h2>
                        <h2 class="italic">
                            "IT does not only build a bridge, IT involves us all"
                        </h2>
                        <h2 class="italic font-semibold">
                            HZ University of Applied Sciences, Middelburg
                        </h2>
                        @if($edition)
                            <h2 class="flex flex-wrap mt-8 uppercase font-bold text-sm gap-12">
                                <a href="{{ route('companies.index') }}">
                                    View companies
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-1"
                                         fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </a>
                                <a href="{{ route('speakers.index') }}">
                                    View speakers
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-1"
                                         fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </a>
                            </h2>
                        @else
                            <h2 class="flex flex-wrap mt-8 uppercase font-medium text-2xl gap-12">Check back later for
                                updates</h2>
                        @endif
                        <br>
                        @guest()
                            @if(optional($edition)->is_participant_registration_opened)
                                <x-button-link href="{{route('register.participant')}}" class="mt-4 mr-5">
                                    Register as a participant
                                </x-button-link>
                            @endif
                            @if(optional($edition)->is_company_registration_opened)
                                <x-button-link href="{{route('register.company')}}" class="mt-4 mr-5">
                                    Register my company
                                </x-button-link>
                            @endif
                        @endguest
                    </div>
                </div>
                <!-- Countdown Timer -->
                <div
                    class="w-full flex justify-center @if(optional($edition)->is_in_progress) mt-16 @else mt-24 @endif">
                    @if ($edition)
                        <x-countdown :time="$edition->start_at"/>
                    @endif
                </div>
            </div>
>>>>>>> development
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
                            <span class="absolute left-32 text-xl text-white">Co-hosted by YourSurprise</span>
                            <span class="absolute right-32 text-xl text-white">Powered by New Waves</span>
                        </div>
                    </div>
                    <div class="mt-12 text-gray-400">
                        <p class="text-2xl mb-1">14th November 2025</p>
                        <p class="text-2xl">HZ University of Applied Sciences, Middelburg</p>
                    </div>
                    <div class="mt-16 flex justify-center space-x-6">
                        <a href="#register" class="px-8 py-4 bg-[#31F7F1] text-[#0B1221] rounded-xl text-xl font-semibold hover:bg-opacity-90 transition-all">
                            Register Now
                        </a>
                        <a href="#programme" class="px-8 py-4 border-2 border-[#31F7F1] text-[#31F7F1] rounded-xl text-xl font-semibold hover:bg-[#31F7F1] hover:text-[#0B1221] transition-all">
                            View Programme
                        </a>
                    </div>
                </div>

                <!-- Countdown Section -->
                <div class="mt-16 float-animation">
                    <x-countdown :time="$eventDate" />
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
                                <a href="#" class="text-[#31F7F1] flex items-center">
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

<<<<<<< HEAD
                        <!-- Companies Card -->
                        <div class="rounded-lg overflow-hidden bg-gradient-to-b from-[#0B1221] to-[#454515]">
                            <div class="p-8">
                                <h3 class="text-[#E2FF32] text-2xl font-bold mb-4">COMPANIES</h3>
                                <p class="text-white mb-8">Meet the companies that make the IT world move. Find your chance to start your career/internship.</p>
                                <a href="#" class="text-[#E2FF32] flex items-center">
                                    Learn more
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
=======
            <!-- Gradient background -->
            <div
                class="absolute inset-0 bg-linear-to-br from-gradient-light-blue via-gradient-light-pink to-gradient-light-pink dark:from-gradient-dark-blue dark:via-gradient-dark-pink dark:to-gradient-dark-pink opacity-80"></div>

            <h2 class="flex justify-center mt-8 mb-5 uppercase text-xl font-montserrat font-bold relative z-10">
                What to expect during the conference
            </h2>

            {{-- Cards for speakers, presentations, companies --}}
            <div class="flex flex-wrap justify-between mb-16 lg:px-44 md:px-32 sm:px-24">
                <!-- Card 1 -->
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 p-4">
                    <div
                        class="h-[32rem] rounded-lg shadow-md overflow-hidden relative transform transition-transform duration-300 hover:scale-105">
                        <!-- Top dark gradient -->
                        <div
                            class="absolute top-0 left-0 right-0 h-3/4 bg-linear-to-b from-black to-transparent opacity-60"></div>
                        <!-- Bottom dark gradient -->
                        <div
                            class="absolute bottom-0 left-0 right-0 h-3/4 bg-linear-to-t from-black to-transparent opacity-60"></div>
                        <!-- Color gradient -->
                        <div
                            class="absolute inset-0 bg-linear-to-br from-crew-500 to-crew-800 mix-blend-soft-light opacity-60"></div>
                        <div class="bg-cover bg-center h-full"
                             style="background-image: url({{asset('/img/card-speaker.jpg')}});"></div>
                        <div class="text-white text-center absolute bottom-0 left-0 right-0 p-6">
                            <div class="relative">
                                <h2 class="text-2xl font-bold">SPEAKERS</h2>
                                <p class="mt-4">During the conference you will have the chance to meet and speak to
                                    our
                                    speakers.</p>
>>>>>>> development
                            </div>
                        </div>
                    </div>
                </div>

<<<<<<< HEAD
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
=======
                <!-- Card 2 -->
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 p-4">
                    <div
                        class="h-[32rem] rounded-lg shadow-md overflow-hidden relative transform transition-transform duration-300 hover:scale-105">
                        <!-- Top dark gradient -->
                        <div
                            class="absolute top-0 left-0 right-0 h-3/4 bg-linear-to-b from-black to-transparent opacity-60"></div>
                        <!-- Bottom dark gradient -->
                        <div
                            class="absolute bottom-0 left-0 right-0 h-3/4 bg-linear-to-t from-black to-transparent opacity-60"></div>
                        <!-- Color gradient -->
                        <div
                            class="absolute inset-0 bg-linear-to-br from-gradient-blue to-participant-500 mix-blend-soft-light opacity-50"></div>
                        <div class="bg-cover bg-center h-full"
                             style="background-image: url({{asset('/img/card-presentations.jpg')}});"></div>
                        <div class="text-white text-center absolute bottom-0 left-0 right-0 p-6">
                            <div class="relative">
                                <h2 class="text-2xl font-bold">PRESENTATIONS & WORKSHOPS</h2>
                                <p class="mt-4">During the conference you can visit a lot of different workshops and
                                    lectures.</p>
                            </div>
>>>>>>> development
                        </div>
                    </div>

<<<<<<< HEAD
                    <!-- Silver Sponsors -->
                    <div class="mb-12">
                        <span class="inline-block bg-gray-700 text-gray-300 px-4 py-1 rounded-full text-sm font-semibold mb-6">Silver</span>
                        <div class="grid grid-cols-2 gap-6">
                            @foreach($silverSponsors as $sponsor)
                                <div class="border border-gray-300/20 rounded-lg p-6">
                                    <img src="{{ $sponsor->logo_url }}" alt="{{ $sponsor->name }}" class="h-12">
                                </div>
                            @endforeach
=======
                <!-- Card 3 -->
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 p-4">
                    <div
                        class="h-[32rem] rounded-lg shadow-md overflow-hidden relative transform transition-transform duration-300 hover:scale-105">
                        <!-- Top dark gradient -->
                        <div
                            class="absolute top-0 left-0 right-0 h-3/4 bg-linear-to-b from-black to-transparent opacity-60"></div>
                        <!-- Bottom dark gradient -->
                        <div
                            class="absolute bottom-0 left-0 right-0 h-3/4 bg-linear-to-t from-black to-transparent opacity-60"></div>
                        <!-- Color gradient -->
                        <div
                            class="absolute inset-0 bg-linear-to-br from-gradient-purple to-gradient-pink mix-blend-hard-light opacity-60"></div>
                        <div class="bg-cover bg-center h-full"
                             style="background-image: url({{asset('/img/card-companies.png')}});"></div>
                        <div class="text-white text-center absolute bottom-0 left-0 right-0 p-6">
                            <div class="relative">
                                <h2 class="text-2xl font-bold">COMPANIES</h2>
                                <p class="mt-4">During the conference you will have the chance to meet different
                                    companies.</p>
                            </div>
>>>>>>> development
                        </div>
                    </div>

                    <!-- Bronze Sponsors -->
                    <div>
<<<<<<< HEAD
                        <span class="inline-block bg-[#45291A] text-[#CD7F32] px-4 py-1 rounded-full text-sm font-semibold mb-6">Bronze</span>
                        <div class="grid grid-cols-4 gap-6">
                            @foreach($bronzeSponsors as $sponsor)
                                <div class="border border-[#CD7F32]/20 rounded-lg p-6">
                                    <img src="{{ $sponsor->logo_url }}" alt="{{ $sponsor->name }}" class="h-12">
                                </div>
                            @endforeach
=======
                        <h2 class="flex justify-center mt-8 mb-5 uppercase text-3xl font-montserrat font-bold pl-4">
                            A big thank you to our sponsors
                        </h2>
                        <div class="flex flex-col mb-4 text-left pl-4">
                            <div class="text-xl font-montserrat">
                                @if($goldSponsor)
                                    <div class="py-10">
                                        <h2 class="text-3xl mb-5 font-semibold">Gold sponsor</h2>
                                        <div class="flex flex-wrap">
                                            <div class="flex items-center justify-start mr-4 mb-4 w-1/2">
                                                <a href="{{$goldSponsor->website}}"
                                                   class="bg-gray-50 border h-56 p-5 w-full rounded-sm">
                                                    @if($goldSponsor->logo_path)
                                                        <img
                                                            class="object-contain h-full w-full block dark:text-white transition ease-in-out hover:saturate-[1.25]"
                                                            src="{{ url('storage/'. $goldSponsor->logo_path) }}"
                                                            alt="Logo of {{$goldSponsor->name}}">
                                                    @else
                                                        <div
                                                            class="h-full flex text-center items-center justify-center">
                                                            <h2 class="text-6xl font-semibold">{{$goldSponsor->name}}</h2>
                                                        </div>
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($silverSponsors->isNotEmpty())
                                    <div class="pb-10">
                                        <h2 class="text-2xl font-semibold mb-5">Silver sponsor</h2>
                                        <div class="flex flex-wrap">
                                            @foreach($silverSponsors as $company)
                                                <div class="flex items-center justify-start mr-4 mb-4 w-1/3">
                                                    <a href="{{$company->website}}"
                                                       class="bg-gray-50 border h-44 p-5 w-full rounded-sm">
                                                        @if($company->logo_path)
                                                            <img
                                                                class="object-contain h-full w-full block dark:text-white transition ease-in-out hover:saturate-[1.25]"
                                                                src="{{ url('storage/'. $company->logo_path) }}"
                                                                alt="Logo of {{$company->name}}">
                                                        @else
                                                            <div
                                                                class="h-full flex text-center items-center justify-center">
                                                                <h2 class="text-5xl font-semibold">{{$company->name}}</h2>
                                                            </div>
                                                        @endif
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                @if($bronzeSponsors->isNotEmpty())
                                    <div class="pb-10">
                                        <h2 class="text-xl mb-5 font-semibold">Bronze sponsor</h2>
                                        <div class="flex flex-wrap">
                                            @foreach($bronzeSponsors as $company)
                                                <div class="flex items-center justify-start mr-4 mb-4 w-1/4">
                                                    <a href="{{$company->website}}"
                                                       class="bg-gray-50 border h-36 px-5 py-3 w-full rounded-sm">
                                                        @if($company->logo_path)
                                                            <img
                                                                class="object-contain h-full w-full block dark:text-white transition ease-in-out hover:saturate-[1.25]"
                                                                src="{{ url('storage/'. $company->logo_path) }}"
                                                                alt="Logo of {{$company->name}}">
                                                        @else
                                                            <div
                                                                class="h-full flex text-center items-center justify-center">
                                                                <h2 class="text-3xl font-semibold">{{$company->name}}</h2>
                                                            </div>
                                                        @endif
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
>>>>>>> development
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

