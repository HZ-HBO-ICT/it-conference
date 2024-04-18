<!-- Leave this to fool Tailwind compilation, otherwise it will delete dynamic styles. There is a better fix! -->
<!-- Potential dynamic classes: bg-partner-500 bg-partner-600 bg-partner-700 -->
@php
    $bodyOfDialog = "The difference between the roles is actually quite simple.<br>If you want to join the conference to
                        visit company booths, join presentations or maybe even become a speaker - you should enrol just
                        as a participant.<br>If you would like to join as a company - to invite more company members to
                        join you, manage the company booth and requests, then you should join as company and you'll
                        become the company representative as soon as you are approved from our team."
@endphp
<x-app-layout>
    <div class="md:py-20 h-max md:h-auto flex items-center justify-center bg-gray-100 dark:bg-gray-900 md:px-40 ">
        <div class="grid grid-cols-1 md:grid-cols-7 w-full bg-white dark:bg-gray-800 rounded-md">
            <div id="pretty-slide"
                 class="h-full {{is_null(old('company_name')) ? 'col-span-4' : 'col-span-2'}} hidden md:block rounded-md">
                <div class="h-full rounded-md">
                    <div class="relative w-full h-full">
                        <div class="gradient w-full absolute inset-0 rounded-md"
                             style="background: linear-gradient(to bottom right, rgba(54, 102, 255, 0.7), rgba(184, 98, 214, 0.7));"></div>
                        <div class="absolute inset-0 flex justify-center items-center">
                            <h2 id="title"
                                class="text-5xl font-bold text-white drop-shadow-md text-center leading-tight">We are in
                                                                                                               IT
                                                                                                               together<br>Conference
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div id="form-slide"
                 class="{{is_null(old('company_name')) ? 'md:col-span-3' : 'md:col-span-5'}} w-full col-span-6 px-12 py-28">
                <div>
                    <div class="text-center md:text-left text-black dark:text-gray-100 pb-5">
                        <h2 class="text-3xl pt-5 font-semibold">Register</h2>
                        <h3 class="text-base">Choose your role and enter the needed details to create an
                                                   account.</h3>
                        <livewire:helpers.simple-dialog :title="'Choosing a role'"
                                                        :displayText="'Confused with which role to pick? Click here!'"
                                                        :body="$bodyOfDialog"/>
                    </div>
                    <x-validation-errors class="mb-4"/>
                    <div class="w-full lg:w-80">
                        <div
                            class="bg-gray-100 dark:bg-gray-700 mt-1 p-1 grid gap-1 grid-cols-1 lg:grid-cols-2 content-center rounded">
                            <div
                                class="flow bg-partner-600 hover:bg-partner-700 text-white font-bold py-2 px-4 rounded text-center">
                                Participant
                            </div>
                            <div
                                class="flow bg-partner-500 hover:bg-partner-700 text-white font-bold py-2 px-4 rounded text-center">
                                Company
                            </div>
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
