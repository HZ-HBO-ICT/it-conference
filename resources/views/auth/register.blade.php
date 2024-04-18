<!-- Leave this to fool Tailwind compilation, otherwise it will delete dynamic styles. There is a better fix! -->
<!-- Potential dynamic classes: bg-partner-500 bg-partner-600 bg-partner-700 -->

<x-app-layout>
    <div class="md:py-20 h-screen md:h-auto flex items-center justify-center bg-gray-100 dark:bg-gray-900 md:px-40">
        <div class="grid grid-cols-7 w-full bg-white dark:bg-gray-800 rounded-md">
            <div id="pretty-slide" class="h-full col-span-4 hidden md:block rounded-md">
                <div class="h-full rounded-md">
                    <div class="relative w-full h-full">
                        <div class="gradient w-full absolute inset-0 rounded-md"
                             style="background: linear-gradient(to bottom right, rgba(54, 102, 255, 0.7), rgba(184, 98, 214, 0.7));"></div>
                        <div class="absolute inset-0 flex justify-center items-center">
                            <h2 id="title" class="text-5xl font-bold text-white drop-shadow-md text-center leading-tight">We are in
                                                                                                               IT
                                                                                                               together<br>Conference
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div id="form-slide" class="col-span-6 w-full md:col-span-3 px-12 py-28">
                <div>
                    <div class="text-center md:text-left text-black dark:text-gray-100">
                        <h2 class="text-3xl pt-5 font-semibold">Register</h2>
                        <h3 class="text-base pb-5">Choose your role and enter the needed details to create an
                                                   account.</h3>
                    </div>
                    <x-validation-errors class="mb-4"/>
                        <div
                            class="bg-gray-100 dark:bg-gray-700 mt-1 p-1 w-80 grid gap-1 grid-cols-2 content-center rounded">
                            <div
                                class="flow bg-partner-600 hover:bg-partner-700 text-white font-bold py-2 px-4 rounded text-center">
                                Participant
                            </div>
                            <div
                                class="flow bg-partner-500 hover:bg-partner-700 text-white font-bold py-2 px-4 rounded text-center">
                                Company
                            </div>
                        </div>

                        <div class="registration-card">
                            <x-registration.participant></x-registration.participant>
                            <x-registration.company></x-registration.company>
                        </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="/js/registration-toggle.js"></script>

<style>
    .scale-transition {
        transition: transform 0.3s ease-in-out;
    }

    .scaled-down {
        transform: scaleX(0.5); /* Adjust the scale factor based on actual layout */
        transform-origin: left; /* Keeps the element anchored to the left */
    }
</style>
