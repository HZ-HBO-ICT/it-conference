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
                        @if($goldSponsorCompany)
                            <h2 class="mt-3 pl-1 uppercase font-bold text-lg">
                                Powered by {{ $goldSponsorCompany->name }}
                            </h2>
                        @endif
                    </div>
                    <div class="w-full md:w-1/2 pt-1 text-xl font-montserrat">
                        <h2 class="uppercase font-bold">
                            Annual IT Conference
                        </h2>
                        <h2 class="uppercase font-medium mb-8">
                            @if($edition)
                                {{ $edition->start_at->format('F j, Y') }}
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
                        <h2 class="flex flex-wrap mt-8 uppercase font-bold text-sm gap-12">
                            <a href="{{ route('companies.index') }}">
                                View companies
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-1" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                            <a href="{{ route('speakers.index') }}">
                                View speakers
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-1" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        </h2>
                        <br>
                        @guest()
                            @if($edition && $edition->isParticipantRegistrationOpened)
                                <x-button class="mt-4 mr-5">
                                    <a href="{{route('register.participant')}}">Register as a participant</a>
                                </x-button>
                            @endif
                            @if($edition && $edition->isCompanyRegistrationOpened)
                                <x-button class="mt-4">
                                    <a href="{{route('register.company')}}">Register my company</a>
                                </x-button>
                            @endif
                        @endguest
                    </div>
                </div>
                <!-- Countdown Timer -->
                <div class="w-full flex justify-center mt-24">
                    @if ($edition)
                        @if (\Carbon\Carbon::now() >= $edition->start_at)
                            <x-button-link href="{{route('programme')}}">Visit the programme</x-button-link>
                        @else
                            <x-countdown :time="$edition->start_at"/>
                        @endif
                    @endif
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
                 class="absolute -top-48 -right-36 md:-top-32 md:-right-20 lg:-top-32 lg:-right-32 xl:-top-48 xl:-right-40 h-80 transform translate-x-1/2 translate-y-1/2 z-10 opacity-100"
                 style="transform: rotate(61deg)">

            <!-- Gradient background -->
            <div
                class="absolute inset-0 bg-gradient-to-br from-gradient-light-blue via-gradient-light-pink to-gradient-light-pink dark:from-gradient-dark-blue dark:via-gradient-dark-pink dark:to-gradient-dark-pink opacity-80"></div>

            <h2 class="flex justify-center mt-8 mb-5 uppercase text-xl font-montserrat font-bold relative z-10">
                What to expect during the conference
            </h2>

            {{-- Cards for speakers, presentations, companies --}}
            <div class="flex flex-wrap justify-between mb-16 lg:px-44 md:px-32 sm:px-24">
                <!-- Card 1 -->
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 p-4">
                    <a href="{{ route('speakers.index') }}">
                        <div
                            class="h-[32rem] rounded-lg shadow-md overflow-hidden relative transform transition-transform duration-300 hover:scale-105">
                            <!-- Top dark gradient -->
                            <div
                                class="absolute top-0 left-0 right-0 h-3/4 bg-gradient-to-b from-black to-transparent opacity-60"></div>
                            <!-- Bottom dark gradient -->
                            <div
                                class="absolute bottom-0 left-0 right-0 h-3/4 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                            <!-- Color gradient -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-crew-500 to-crew-800 mix-blend-soft-light opacity-60"></div>
                            <div class="bg-cover bg-center h-full"
                                 style="background-image: url({{asset('/img/card-speaker.jpg')}});"></div>
                            <div class="text-white text-center absolute bottom-0 left-0 right-0 p-6">
                                <div class="relative">
                                    <h2 class="text-2xl font-bold">SPEAKERS</h2>
                                    <p class="mt-4">During the conference you will have the chance to meet and speak to
                                                    our
                                                    speakers.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Card 2 -->
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 p-4">
                    <a href="#">
                        <div
                            class="h-[32rem] rounded-lg shadow-md overflow-hidden relative transform transition-transform duration-300 hover:scale-105">
                            <!-- Top dark gradient -->
                            <div
                                class="absolute top-0 left-0 right-0 h-3/4 bg-gradient-to-b from-black to-transparent opacity-60"></div>
                            <!-- Bottom dark gradient -->
                            <div
                                class="absolute bottom-0 left-0 right-0 h-3/4 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                            <!-- Color gradient -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-gradient-blue to-participant-500 mix-blend-soft-light opacity-50"></div>
                            <div class="bg-cover bg-center h-full"
                                 style="background-image: url({{asset('/img/card-presentations.jpg')}});"></div>
                            <div class="text-white text-center absolute bottom-0 left-0 right-0 p-6">
                                <div class="relative">
                                    <h2 class="text-2xl font-bold">PRESENTATIONS & WORKSHOPS</h2>
                                    <p class="mt-4">During the conference you can visit a lot of different workshops and
                                                    lectures.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Card 3 -->
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 p-4">
                    <a href="{{ route('companies.index') }}">
                        <div
                            class="h-[32rem] rounded-lg shadow-md overflow-hidden relative transform transition-transform duration-300 hover:scale-105">
                            <!-- Top dark gradient -->
                            <div
                                class="absolute top-0 left-0 right-0 h-3/4 bg-gradient-to-b from-black to-transparent opacity-60"></div>
                            <!-- Bottom dark gradient -->
                            <div
                                class="absolute bottom-0 left-0 right-0 h-3/4 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                            <!-- Color gradient -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-gradient-purple to-gradient-pink mix-blend-hard-light opacity-60"></div>
                            <div class="bg-cover bg-center h-full"
                                 style="background-image: url({{asset('/img/card-companies.png')}});"></div>
                            <div class="text-white text-center absolute bottom-0 left-0 right-0 p-6">
                                <div class="relative">
                                    <h2 class="text-2xl font-bold">COMPANIES</h2>
                                    <p class="mt-4">During the conference you will have the chance to meet different
                                                    companies.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="relative bg-white dark:bg-gray-900 w-full min-h-32 px-4 py-4">

                <!-- Third banner-->
                <div>
                    <h2 class="flex justify-center mt-8 mb-5 uppercase text-3xl font-montserrat font-bold pl-4">A big
                                                                                                                thank
                                                                                                                you to
                                                                                                                our
                                                                                                                sponsors</h2>
                    <div class="flex flex-col mb-4 text-left pl-4">
                        <div class="text-xl font-montserrat">
                            <div class="py-10">
                                <h2 class="text-3xl mb-5 font-semibold">Gold sponsor</h2>
                                <div class="flex flex-wrap">
                                    @if(\App\Models\Sponsorship::find(1))
                                        @foreach(\App\Models\Sponsorship::find(1)->companies as $company)
                                            <div class="flex items-center justify-start mr-4 mb-4 w-1/2">
                                                <a href="{{'https://' . $company->website}}"
                                                   class="bg-gray-50 border h-56 p-5 w-full rounded">
                                                    @if($company->logo_path)
                                                        <img
                                                            class="object-contain h-full w-full block dark:text-white transition ease-in-out hover:saturate-[1.25]"
                                                            src="{{ url('storage/'. $company->logo_path) }}"
                                                            alt="Logo of {{$company->name}}">
                                                    @else
                                                        <h2 class="text-4xl">{{$company->name}}</h2>
                                                    @endif
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="pb-10">
                                <h2 class="text-2xl font-semibold mb-5">Silver sponsor</h2>
                                <div class="flex flex-wrap">
                                    @if(\App\Models\Sponsorship::find(2))
                                        @foreach(\App\Models\Sponsorship::find(2)->companies as $company)
                                            <div class="flex items-center justify-start mr-4 mb-4 w-1/3">
                                                <a href="{{'https://' . $company->website}}"
                                                   class="bg-gray-50 border h-44 p-5 w-full rounded">
                                                    @if($company->logo_path)
                                                        <img
                                                            class="object-contain h-full w-full block dark:text-white transition ease-in-out hover:saturate-[1.25]"
                                                            src="{{ url('storage/'. $company->logo_path) }}"
                                                            alt="Logo of {{$company->name}}">
                                                    @else
                                                        <h2 class="text-4xl">{{$company->name}}</h2>
                                                    @endif
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="pb-10">
                                <h2 class="text-xl mb-5 font-semibold">Bronze sponsor</h2>
                                <div class="flex flex-wrap">
                                    @if(\App\Models\Sponsorship::find(3))
                                        @foreach(\App\Models\Sponsorship::find(3)->companies as $company)
                                            <div class="flex items-center justify-start mr-4 mb-4 w-1/4">
                                                <a href="{{'https://' . $company->website}}"
                                                   class="bg-gray-50 border h-36 px-5 py-3 w-full rounded">
                                                    @if($company->logo_path)
                                                        <img
                                                            class="object-contain h-full w-full block dark:text-white transition ease-in-out hover:saturate-[1.25]"
                                                            src="{{ url('storage/'. $company->logo_path) }}"
                                                            alt="Logo of {{$company->name}}">
                                                    @else
                                                        <h2 class="text-4xl">{{$company->name}}</h2>
                                                    @endif
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
</x-app-layout>
