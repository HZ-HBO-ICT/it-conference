<x-app-layout>
    <div class="flex flex-col overflow-hidden">
        <!-- The main banner -->
        <div class="relative">
            <div
                class="absolute inset-0 bg-gradient-to-br from-gradient-blue to-gradient-pink mix-blend-hard-light"></div>
            <div class="relative flex flex-col items-center px-4 py-16">
                <!--Titles-->
                <div
                    class="flex flex-col md:flex-row justify-start items-start w-full max-w-7xl space-y-8 md:space-y-0 md:space-x-8 mt-10">
                    <div class="text-white w-full lg:ml-16 md:w-3/5 font-extrabold lg:text-7xl md:text-6xl sm:text-3xl uppercase">
                        <h1 class="leading-snug" style="text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);">
                            We are in IT together Conference
                        </h1>
                    </div>
                    <div class="w-full md:w-1/2 pt-1 text-xl font-montserrat">
                        <h2 class="uppercase font-bold">
                            Annual IT Conference
                        </h2>
                        <h2 class="uppercase font-medium mb-8">
                            November 15, 2024
                        </h2>
                        <h2 class="italic">
                            "It does not only build a bridge, it involves us all"
                        </h2>
                        <h2 class="italic font-semibold">
                            HZ University of Applied Sciences, Middelburg
                        </h2>
                        <h2 class="flex flex-wrap mt-8 uppercase font-bold text-sm">
                            <a href="#">
                                View companies
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-1" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                            <a href="#">
                                View speakers
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-1" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        </h2>
                        <br>
                        <x-button class="mt-4">
                            <a href="{{route('register')}}">Register</a>
                        </x-button>
                    </div>
                </div>
                <!-- Countdown Timer -->
                <div class="w-full flex justify-center mt-24">
                    <x-countdown/>
                </div>
                {{--                    <div class="flex flex-row">--}}
                {{--                        <div class="md:basis-1/2 basis-full md:pr-6 hidden md:flex lg:flex">--}}
                {{--                            <div class="flex flex-col items-start pt-10">--}}
                {{--                                <p class="text-black uppercase pb-2">15 November 2024</p>--}}
                {{--                                <x-countdown/>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                <!-- The div for the logo of the sponsor -->
                <!-- TODO: Fix when database gets rebuilt -->
                {{--@if($goldSponsor && $goldSponsor->is_sponsor_approved)
                    <div class="basis-1/3 pt-16">
                        <p class="uppercase pt-2 pl-24 text-gray-200">sponsored by</p>
                    </div>
                    <div class="basis-1/3 pt-16">
                        <p class="uppercase text-xl pt-1 pl-4 text-gold">{{ $goldSponsor->name }}</p>
                    </div>
                @endif--}}
                {{--                    </div>--}}
                <!-- TODO: Fix when authentication gets implemented -->
                {{--@guest()
                    <div class="my-4 md:mt-16 lg:mt-16 xl:mt-16 flex flex-col items-center md:pb-12 lg:pb-0">
                        <x-custom-button-link href="{{ route('register') }}">Register now</x-custom-button-link>
                    </div>
                @endguest--}}
            </div>
        </div>

        <!--Statistics-->
        <div class="bg-white dark:bg-gray-900 w-full min-h-32 px-4 py-4">
            <div class="grid md:grid-cols-4 mt-5 lg:mr-40 lg:ml-40">
                <div class="text-center mb-5">
                    <p class="text-5xl font-bold text-center text-crew-500">10+</p>
                    <p class="uppercase font-bold text-sm">Speakers</p>
                </div>
                <div class="text-center mb-5">
                    <p class="text-5xl font-bold text-center text-partner-600">200+</p>
                    <p class="uppercase font-bold text-sm">Students</p>
                </div>
                <div class="text-center mb-5">
                    <p class="text-5xl font-bold text-center text-participant-500">20+</p>
                    <p class="uppercase font-bold text-sm">Companies</p>
                </div>
                <div class="text-center">
                    <p class="text-5xl font-bold text-center text-pink-500">5+</p>
                    <p class="uppercase font-bold text-sm">Sponsors</p>
                </div>
            </div>
        </div>

        <!-- Second banner + third banner inside it (to use the gradient) -->
        <div class="relative">
            <!-- Blob -->
            <!-- the auth/guest is necessary because the register now button changes the layout -->
            @auth()
                <img src="/img/rose-blob.png"
                     class="absolute -top-72 -left-96 md:-top-48 md:-left-80 lg:-top-72 lg:-left-72 xl:-top-88 xl:-left-48 h-[28rem] transform translate-x-1/2 translate-y-1/2 z-10 opacity-100"
                     style="transform: rotate(-90deg)">
            @endauth
            @guest()
                <img src="/img/rose-blob.png"
                     class="absolute -top-88 -left-96 md:-top-56 md:-left-80 lg:-top-88 lg:-left-72 xl:-top-88 xl:-left-48 h-[28rem] transform translate-x-1/2 translate-y-1/2 z-10 opacity-100"
                     style="transform: rotate(-90deg)">
            @endguest

            <!-- Blob -->
            <img src="/img/blue-blob.png"
                 class="absolute -top-48 -right-36 h-[20rem] transform translate-x-1/2 translate-y-1/2 z-10 opacity-100"
                 style="transform: rotate(61deg)">

            <h2 class="flex justify-center mt-8 mb-5 uppercase text-xl font-montserrat font-bold">What to expect on this
                year's
                conference?</h2>

            <!-- Background Gradient -->
            <div
                class="absolute inset-0 bg-gradient-to-br from-gradient-blue to-gradient-pink mix-blend-hard-light"></div>

            <div class="flex flex-wrap justify-center ml-12 mr-12 mb-16">
                <!-- Card 1 -->
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 p-4">
                    <div class="h-96 rounded-lg shadow-md overflow-hidden relative">
                        <!-- Top dark gradient -->
                        <div class="absolute top-0 left-0 right-0 h-3/4 bg-gradient-to-b from-black to-transparent opacity-60"></div>
                        <!-- Bottom dark gradient -->
                        <div class="absolute bottom-0 left-0 right-0 h-3/4 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                        <!-- Color gradient -->
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-crew-500 to-crew-800 mix-blend-soft-light opacity-60"></div>
                        <div class="bg-cover bg-center h-full"
                             style="background-image: url({{asset('/img/people-talking.jpg')}});"></div>
                        <div class="text-white text-center absolute bottom-0 left-0 right-0 p-6">
                            <div class="relative">
                                <h2 class="text-2xl font-bold">SPEAKERS</h2>
                                <p class="mt-4">During the conference you will have the chance to meet and speak to our
                                    speakers.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 p-4">
                    <div class="h-96 rounded-lg shadow-md overflow-hidden relative">
                        <!-- Top dark gradient -->
                        <div class="absolute top-0 left-0 right-0 h-3/4 bg-gradient-to-b from-black to-transparent opacity-60"></div>
                        <!-- Bottom dark gradient -->
                        <div class="absolute bottom-0 left-0 right-0 h-3/4 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                        <!-- Color gradient -->
                        <div class="absolute inset-0 bg-gradient-to-br from-gradient-blue to-participant-500 mix-blend-color opacity-50"></div>
                        <div class="bg-cover bg-center h-full"
                             style="background-image: url({{asset('/img/lectures-min.jpg')}});"></div>
                        <div class="text-white text-center absolute bottom-0 left-0 right-0 p-6">
                            <div class="relative">
                                <h2 class="text-2xl font-bold">PRESENTATIONS & WORKSHOPS</h2>
                                <p class="mt-4">During the conference you can visit a lot of different workshops and
                                    lectures.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 p-4">
                    <div class="h-96 rounded-lg shadow-md overflow-hidden relative">
                        <!-- Top dark gradient -->
                        <div class="absolute top-0 left-0 right-0 h-3/4 bg-gradient-to-b from-black to-transparent opacity-60"></div>
                        <!-- Bottom dark gradient -->
                        <div class="absolute bottom-0 left-0 right-0 h-3/4 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                        <!-- Color gradient -->
                        <div class="absolute inset-0 bg-gradient-to-br from-gradient-purple to-gradient-pink mix-blend-hard-light opacity-60"></div>
                        <div class="bg-cover bg-center h-full"
                             style="background-image: url({{asset('/img/companies.jpg')}});"></div>
                        <div class="text-white text-center absolute bottom-0 left-0 right-0 p-6">
                            <div class="relative">
                                <h2 class="text-2xl font-bold">COMPANIES</h2>
                                <p class="mt-4">During the conference you will have the chance to meet different companies.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Third banner-->
            <div class="relative">
                <h2 class="flex justify-center mt-8 mb-5 uppercase text-xl font-montserrat font-bold">Thanks to our
                    sponsors</h2>
                <div class="flex flex-wrap justify-center mb-16 text-center">
                    <div class="text-xl font-montserrat">
                        <h2>Golden sponsor</h2>

                        <h2>Silver sponsors</h2>
                        <h2>Bronze sponsors</h2>
                    </div>
                </div>
                <!-- TODO: Fix when database gets rebuilt -->
                {{--@if(!$allSponsors->isEmpty())
                    <div class="isolate flex flex-wrap justify-center w-full gap-3 xl:gap-8 lg:gap-8 md:gap-8 mt-16">
                        @foreach(\App\Models\SponsorTier::all() as $sponsorTier)
                            <div class="w-full">
                                <div class="hidden md:flex xl:flex lg:flex justify-center gap-3">
                                    @foreach($sponsorTier->teams->where('is_sponsor_approved', 1) as $sponsor)
                                        <div class="border shadow-lg border-2 w-full @if($allSponsors->count() > 3) px-3 md:w-1/3 lg:w-1/3 xl:w-1/4 @endif @if ($sponsor->sponsorTier->name == 'golden' && $sponsor->is_approved) border-gold block
                                        @elseif ($sponsor->sponsorTier->name == 'silver' && $sponsor->is_sponsor_approved) border-silver block
                                        @elseif ($sponsor->sponsorTier->name == 'bronze' && $sponsor->is_sponsor_approved) border-bronze block @endif rounded-lg">
                                            <a href="{{ $sponsor->website }}" target="_blank">
                                                <div class="flex flex-col justify-start items-center h-24">
                                                    @if($sponsor->logo_path)
                                                        <img alt="{{ $sponsor->name }}"
                                                             src="{{ url('storage/'. $sponsor->logo_path) }}"
                                                             class="pt-1 object-scale-down w-full h-14 rounded-lg">
                                                    @else
                                                        @php
                                                            $color = '';
                                                             if ($sponsor->sponsorTier->name === 'golden' && $sponsor->is_sponsor_approved) $color='#FFD700';
                                                             elseif ($sponsor->sponsorTier->name === 'silver' && $sponsor->is_sponsor_approved) $color='#C0C0C0';
                                                             elseif ($sponsor->sponsorTier->name === 'bronze' && $sponsor->is_sponsor_approved) $color='#CD7F32';
                                                             else $color='#60a5fa'
                                                        @endphp
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24"
                                                             stroke-width="1.5"
                                                             stroke="{{$color}}" aria-hidden="true" class="w-14 h-14">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                                                        </svg>
                                                    @endif
                                                    <p class="tracking-tight leading-7 text-base pt-2 text-center dark:text-white">
                                                        @if (Str::length($sponsor->name) >= 13)
                                                            {{ substr($sponsor->name, 0, 10) . '...' }}
                                                        @else
                                                            {{ $sponsor->name }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="xl:hidden lg:hidden md:hidden grid grid-cols-1 gap-3 content-end">
                                    @foreach($sponsorTier->teams->where('is_sponsor_approved', 1) as $sponsor)
                                        <div class="border justify-self-center shadow-lg border-2 w-2/3 px-3 @if ($sponsor->sponsorTier->name == 'golden' && $sponsor->is_approved) border-gold
                                        @elseif ($sponsor->sponsorTier->name == 'silver' && $sponsor->is_sponsor_approved) border-silver
                                        @elseif ($sponsor->sponsorTier->name == 'bronze' && $sponsor->is_sponsor_approved) border-bronze @endif rounded-lg">
                                            <a href="{{ $sponsor->website }}" target="_blank">
                                                <div class="flex flex-col justify-start items-center h-24">
                                                    @if($sponsor->logo_path)
                                                        <img alt="{{ $sponsor->name }}"
                                                             src="{{ url('storage/'. $sponsor->logo_path) }}"
                                                             class="pt-1 object-scale-down w-full h-14 rounded-lg">
                                                    @else
                                                        @php
                                                            $color = '';
                                                             if ($sponsor->sponsorTier->name === 'golden' && $sponsor->is_sponsor_approved) $color='#FFD700';
                                                             elseif ($sponsor->sponsorTier->name === 'silver' && $sponsor->is_sponsor_approved) $color='#C0C0C0';
                                                             elseif ($sponsor->sponsorTier->name === 'bronze' && $sponsor->is_sponsor_approved) $color='#CD7F32';
                                                             else $color='#60a5fa'
                                                        @endphp
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24"
                                                             stroke-width="1.5"
                                                             stroke="{{$color}}" aria-hidden="true" class="w-14 h-14">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                                                        </svg>
                                                    @endif
                                                    <p class="tracking-tight leading-7 text-base pt-2 text-center dark:text-white">
                                                        @if (Str::length($sponsor->name) >= 13)
                                                            {{ substr($sponsor->name, 0, 10) . '...' }}
                                                        @else
                                                            {{ $sponsor->name }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif--}}
            </div>
        </div>
    </div>
</x-app-layout>
