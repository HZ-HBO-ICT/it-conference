<!-- Leave this to fool Tailwind compilation, otherwise it will delete dynamic styles. There is a better fix! -->
<!-- Potential dynamic classes: bg-partner-500 bg-partner-600 bg-partner-700 -->
<div class="grid grid-cols-1 md:grid-cols-7 w-full h-[80vh] bg-white dark:bg-gray-800 rounded-md">
    <div id="pretty-slide"
         class="h-full col-span-3 hidden md:block rounded-md">
        <div class="h-full rounded-md" style="overflow: clip">
            <div class="relative h-full">
                <img class="h-full object-cover" src="/img/market.jpg" alt="market">
                <div class="gradient absolute inset-0"
                     style="background: linear-gradient(to bottom right, rgba(54, 102, 255, 0.7), rgba(184, 98, 214, 0.7));"></div>
                <div class="absolute inset-0 flex justify-center items-center" style="z-index: 3">
                    <h2 class="text-4xl font-bold text-white drop-shadow-md text-center leading-tight">We are in IT
                                                                                                       together<br>Conference
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div id="form-slide h-full"
         class="col-span-4 w-full px-12 py-2 flex justify-center items-center">
        <div class="w-full">
            <x-validation-errors class="mb-4"/>
            <div class="{{$showCompanyRepresentativeForm ? '' : 'hidden'}} w-full">
                <livewire:registration.company-representative-form/>
            </div>
            <div class="{{$showCompanyBasicInfoForm ? '' : 'hidden'}} w-full">
                <livewire:registration.company-basic-form/>
            </div>
            <div class="{{$showCompanyLocationInfoForm ? '' : 'hidden'}} w-full">
                <livewire:registration.company-location-form/>
            </div>
        </div>
    </div>
</div>
