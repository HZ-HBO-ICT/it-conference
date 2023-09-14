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
                            <x-countdown/>
                        </div>
                        <!-- The div for the logo of the sponsor -->
                        @if($goldSponsor)
                            <div class="basis-1/3 pt-16">
                                <p class="uppercase pt-2 pl-24 text-gray-200">sponsored by</p>
                            </div>
                            <div class="basis-1/3 pt-16">
                                <p class="uppercase text-xl pt-1 pl-4 text-gold">{{ $goldSponsor->name }}</p>
                            </div>
                        @endif
                    </div>
                    @guest()
                        <div class="mt-16 flex flex-col items-center md:pb-12 lg:pb-0">
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
                    <div class="flex flex-wrap justify-center gap-12 mt-16">
                        @foreach($allSponsors as $sponsor)
                            <div class="border border-2 @if ($sponsor->sponsorTier->name == 'golden' && $sponsor->is_approved) border-gold block
                            @elseif ($sponsor->sponsorTier->name == 'silver' && $sponsor->is_approved) border-silver block
                            @elseif ($sponsor->sponsorTier->name == 'bronze' && $sponsor->is_approved) border-bronze hidden xl:block @endif rounded-lg">
                                <a href="{{ $sponsor->website }}">
                                    @if($sponsor->logo_path)
                                        <img alt="{{ $sponsor->name }}" src="{{ url('storage/'. $sponsor->logo_path) }}"
                                             class="w-6">
                                    @else
                                        <p>{{ $sponsor->name }}</p>
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
