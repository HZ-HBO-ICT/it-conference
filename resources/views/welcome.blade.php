<x-app-layout>
    <div style="overflow-x: hidden;"> {{--don't allow side scrolling--}}
        <!-- The main banner -->
        <div class="relative isolate bg-gray-900 py-72 bg-cover bg-center"
             style="background-image: url('/img/hz-building.jpg');">
            <div class="absolute inset-0">
                <!-- The gradient -->
                <div
                    class="before:absolute before:inset-0 before:bg-gradient-to-br before:from-gradient-yellow before:via-gradient-pink before:via-gradient-purple before:to-gradient-blue before:opacity-70"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 mt-16">
                    <!-- Titles -->
                    <div>
                        <h1 class="text-white text-3xl sm:text-5xl font-bold text-center whitespace-nowrap"
                            style="text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">
                            We are in IT together Conference
                        </h1>
                        <h2 class="pt-1 text-2xl sm:text-3xl text-white font-montserrat text-center italic">
                            "A buzz-worthy experience"
                        </h2>
                    </div>
                    <div class="mt-16 flex flex-col items-center">
                        <x-custom-button-link href="{{ route('register') }}">Register now</x-custom-button-link>
                        <p class="mt-4 text-white">or</p>
                        <p>
                            <a href="#" class="text-white hover:border-b-2 hover:border-yellow-500 transition-all">
                                learn more about us</a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Blob -->
            <img src="/img/rose-blob.png"
                 class="absolute -top-24 -right-48 h-[34rem] opacity-75" style="transform: rotate(110deg) scaleX(-1)">
        </div>
        <!-- Second banner -->
        <div class="relative isolate py-72 bg-cover bg-center"
             style="background-image: url('/img/auditorium.jpg')">
            <!-- Gradient -->
            <div class="absolute inset-0 bg-blue-500 opacity-90"></div>
            <!-- Blob -->
            <img src="/img/blue-blob.png"
                 class="absolute -top-96 -left-48 h-[34rem] transform translate-x-1/2 translate-y-1/2 z-10  opacity-75"
                 style="transform: rotate(61deg)">

            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div>
                    <h2 class="text-white text-3xl sm:text-4xl font-bold text-center whitespace-nowrap"
                        style="text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">
                        What is this conference?
                    </h2>
                    <p class="text-white text-center" style="text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">
                        We are so proud to present you with this inspirational and fun conference for and by you all!
                        Teachers, students and our valued company representatives have come together to create this
                        special program. Talk to companies about their projects in the presentation market. Experiment,
                        learn and play around during the workshops and get motivated by the various talks. There is
                        enough for everyone!
                    </p>
                </div>
            </div>
        </div>
        <!-- Third banner + gradient (since empty bg) -->
        <div
            class="relative isolate py-72 bg-cover bg-center before:absolute before:inset-0 before:bg-gradient-to-br before:from-gradient-purple before:via-red-500 before:to-orange-500 before:opacity-70">
            <!-- Blob -->
            <img src="/img/red-blob.png"
                 class="absolute -top-80 right-0 h-[34rem] transform translate-x-1/2 translate-y-1/2 z-10  opacity-75"
                 style="transform: rotate(61deg)">

            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div>
                    <h2 class="text-white text-4xl sm:text-5xl font-bold text-center whitespace-nowrap hover:animate-pulse"
                        style="text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">
                        Get to know more
                    </h2>
                </div>
                <div class="flex justify-center mt-4">
                    <p class="text-white text-xl mr-7 hover:underline hover:text-yellow-500 transition-all">Check out
                                                                                                            our
                                                                                                            speakers</p>
                    <p class="text-white text-xl hover:underline hover:text-yellow-500 transition-all">Check out the
                                                                                                       companies</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
