<!-- Leave this to fool Tailwind compilation, otherwise it will delete dynamic styles. There is a better fix! -->
<!-- Potential dynamic classes: bg-partner-500 bg-partner-600 bg-partner-700 -->
<div class="grid grid-cols-1 md:grid-cols-7 w-full h-[80vh] bg-white dark:bg-gray-800 rounded-md">
    <div id="pretty-slide"
         class="h-full col-span-3 hidden md:block rounded-md">
        <div class="h-full rounded-md" style="overflow: clip">
            <div class="relative h-full">
                <img class="h-full object-cover" src="/img/slideshows/market.jpg" alt="market">
                <div class="gradient absolute inset-0"
                     style="background: linear-gradient(to bottom right, rgba(54, 102, 255, 0.7), rgba(184, 98, 214, 0.7));"></div>
                <div class="absolute inset-0 flex justify-center items-center" style="z-index: 3">
                    <h2 class="text-4xl font-bold text-white drop-shadow-md text-center leading-tight">We are in IT together<br>Conference</h2>
                </div>
            </div>
        </div>
    </div>
    <div id="form-slide h-full"
         class="col-span-4 w-full px-12 py-2 flex justify-center items-center">
        <div class="{{$showChooseRole ? '' : 'hidden'}} w-full">
            <div class="text-center md:text-left text-black dark:text-gray-100 w-full pb-5">
                <h2 class="text-3xl pt-5 font-semibold">Register</h2>
                <div class="flex w-full">
                    <h3 class="text-2xl">Choose your role</h3>
                    <!-- TODO: Add dialog modal from the next PR with info -->
                    <div class="ml-1 mt-0.5 flex-shrink-0 hidden w-7 h-7 overflow-hidden rounded-full sm:block">
                        <button
                            class="w-full h-full flex items-center justify-center hover:bg-gray-100 text-gray-500 hover:text-gray-600 dark:hover:bg-gray-800 dark:text-gray-300 dark:hover:text-gray-100">
                            <svg class="w-5 h-5 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <x-validation-errors class="mb-4"/>
            <div class="w-full">
                <div
                    class="mt-1 pl-0 p-1 grid gap-1 grid-cols-1 lg:grid-cols-2 content-center rounded">
                    <div wire:click="showParticipant"
                        class="flow bg-indigo-400 hover:bg-indigo-600 text-white font-bold py-3 px-4 rounded text-center">
                        Participant
                    </div>
                    <div wire:click="showCompanyRepresentative"
                        class="flow bg-indigo-400 hover:bg-indigo-600 text-white font-bold py-3 px-4 rounded text-center">
                        Company representative
                    </div>
                </div>
            </div>
        </div>
        <div class="{{$showParticipantForm ? '' : 'hidden'}} w-full">
            <livewire:registration.participant-form/>
        </div>
        <div class="{{$showCompanyRepresentativeForm ? '' : 'hidden'}} w-full">
            <livewire:registration.company-representative-form/>
        </div>
    </div>
</div>
