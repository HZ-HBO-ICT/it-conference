<x-app-layout>
    <div style="overflow-x: hidden;"> {{--don't allow side scrolling--}}
        <!-- The main banner -->
        <div class="relative isolate bg-gray-900 py-80 sm:py-72 bg-cover bg-center"
             style="background-image: url('/img/auditorium.jpg');">
            <div class="absolute inset-0">
                <!-- The gradient -->
                <div
                    class="before:absolute before:inset-0 before:bg-gradient-to-br before:from-gradient-yellow before:via-gradient-pink before:via-gradient-purple before:to-gradient-blue before:opacity-70"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 mt-16">
                    <!-- Titles -->
                    <div>
                        <h1 class="text-white text-5xl leading-snug font-bold text-center md:whitespace-nowrap"
                            style="text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">
                            We are in IT together Conference
                        </h1>
                        <h2 class="pt-1 text-xl text-white font-montserrat text-center italic uppercase">
                            "it does not only build a bridge, it involves us all"
                        </h2>
                    </div>
                    <div class="flex flex-row">
                        <div class="md:basis-1/2 basis-full md:pr-6 hidden md:flex lg:flex">
                            <div class="flex flex-col items-start pt-10">
                                <p class="text-gray-200 uppercase pb-2">17 November 2023</p>
                                <x-countdown/>
                            </div>
                        </div>
                        <!-- The div for the logo of the sponsor -->
                        @if($goldSponsor && $goldSponsor->is_sponsor_approved)
                            <div class="basis-1/3 pt-16">
                                <p class="uppercase pt-2 pl-24 text-gray-200">sponsored by</p>
                            </div>
                            <div class="basis-1/3 pt-16">
                                <p class="uppercase text-xl pt-1 pl-4 text-gold">{{ $goldSponsor->name }}</p>
                            </div>
                        @endif
                    </div>
                    @guest()
                        <div class="my-4 md:mt-16 lg:mt-16 xl:mt-16 flex flex-col items-center md:pb-12 lg:pb-0">
                            <x-custom-button-link href="{{ route('register') }}">Register now</x-custom-button-link>
                        </div>
                    @endguest
                </div>
            </div>
            <!-- Blob -->
            <!-- the auth/guest is necessary because the register now button changes the layout -->
            @auth()
                <img src="/img/rose-blob.png"
                     class="absolute -top-52 -right-64 sm:-top-24 sm:-right-72 md:-top-64 md:-right-80 lg:-top-40 lg:-right-80 xl:-top-24 xl:-right-48 h-[34rem] opacity-75"
                     style="transform: rotate(110deg) scaleX(-1);">
            @endauth
            @guest()
                <img src="/img/rose-blob.png"
                     class="absolute -top-64 -right-64 sm:-top-24 sm:-right-80 md:-top-80 md:-right-80 lg:-top-24 lg:-right-80 xl:-top-24 xl:-right-48 h-[34rem] opacity-75"
                     style="transform: rotate(110deg) scaleX(-1);">
            @endguest
        </div>
        <!-- Second banner -->
        <div class="relative isolate h-[29rem] border-red-700">
            <!-- Blob -->
            <!-- the auth/guest is necessary because the register now button changes the layout -->
            @auth()
                <img src="/img/blue-blob.png"
                     class="absolute -top-80 -left-96 md:-top-52 md:-left-80 lg:-top-80 lg:-left-72 xl:-top-96 xl:-left-48 h-[34rem] transform translate-x-1/2 translate-y-1/2 z-10  opacity-75"
                     style="transform: rotate(61deg)">
            @endauth
            @guest()
                <img src="/img/blue-blob.png"
                     class="absolute -top-96 -left-96 md:-top-64 md:-left-80 lg:-top-96 lg:-left-72 xl:-top-96 xl:-left-48 h-[34rem] transform translate-x-1/2 translate-y-1/2 z-10  opacity-75"
                     style="transform: rotate(61deg)">
            @endguest
            <x-slideshow/>
        </div>
        <!-- Third banner + gradient (since empty bg) -->
        <div
            class="relative isolate py-72 bg-cover bg-center before:absolute before:inset-0 before:bg-gradient-to-br before:from-gradient-purple before:via-red-500 before:to-orange-500 before:opacity-70">
            <!-- Blob -->
            <img src="/img/red-blob.png"
                 class="absolute -top-48 right-0 h-[25rem] transform translate-x-1/2 translate-y-1/2 z-10  opacity-75"
                 style="transform: rotate(61deg)">

            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div>
                    <h2 class="text-white text-4xl sm:text-5xl font-bold text-center whitespace-nowrap hover:animate-pulse"
                        style="text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">
                        Sponsors
                    </h2>
                </div>

                @if(!$allSponsors->isEmpty())
                    <div class="flex flex-wrap justify-center w-full gap-8 mt-16">
                        @foreach($allSponsors as $sponsor)
                            <div class="border shadow-lg border-2 w-full md:w-1/3 lg:w-1/3 xl:w-1/5 @if ($sponsor->sponsorTier->name == 'golden' && $sponsor->is_approved) border-gold block
                            @elseif ($sponsor->sponsorTier->name == 'silver' && $sponsor->is_sponsor_approved) border-silver block
                            @elseif ($sponsor->sponsorTier->name == 'bronze' && $sponsor->is_sponsor_approved) border-bronze hidden xl:block @endif rounded-lg">
                                <a href="{{ $sponsor->website }}">
                                    <div class="flex flex-col justify-start items-center h-24">
                                        @if($sponsor->logo_path)
                                            <img alt="{{ $sponsor->name }}"
                                                 src="{{ url('storage/'. $sponsor->logo_path) }}"
                                                 class="w-full h-14 rounded-lg">
                                        @else
                                            @php
                                                $color = '';
                                                 if ($sponsor->sponsorTier->name === 'golden' && $sponsor->is_sponsor_approved) $color='#FFD700';
                                                 elseif ($sponsor->sponsorTier->name === 'silver' && $sponsor->is_sponsor_approved) $color='#C0C0C0';
                                                 elseif ($sponsor->sponsorTier->name === 'bronze' && $sponsor->is_sponsor_approved) $color='#CD7F32';
                                                 else $color='#60a5fa'
                                            @endphp
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5"
                                                 stroke="{{$color}}" aria-hidden="true" class="w-14 h-14">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                                            </svg>
                                        @endif
                                        <p class="tracking-tight leading-7 text-base pt-2 text-center dark:text-white">
                                            @if (Str::length($sponsor->name) > 14)
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
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
