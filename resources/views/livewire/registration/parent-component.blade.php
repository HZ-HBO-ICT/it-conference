<!-- Leave this to fool Tailwind compilation, otherwise it will delete dynamic styles. There is a better fix! -->
<!-- Potential dynamic classes: bg-partner-500 bg-partner-600 bg-partner-700 -->
<div
    class="grid grid-cols-1 md:grid-cols-7 w-full max-w-6xl rounded-xl border border-slate-900 overflow-hidden shadow-lg min-h-[600px]">
    <div class="hidden md:block md:col-span-3">
        <div class="relative h-full">
            <img class="w-full h-full object-cover" src="/img/market-scaled.webp" alt="market"/>
            <div class="absolute inset-0 bg-gradient-to-br from-waitt-yellow/70 via-waitt-cyan/50 to-waitt-pink/30"></div>
            <div class="absolute inset-0 bg-black/60"></div>
            <div class="absolute inset-0 flex items-center justify-center px-6">
                <img src="{{asset('/img/waitt25/light-full-logo.png')}}">
            </div>
        </div>
    </div>

    <div id="form-slide h-full"
         class="col-span-4 w-full px-12 py-2 flex  bg-waitt-dark/70 backdrop-blur-sm justify-center items-center">
        <div class="w-full">
            <x-validation-errors class="mb-4"/>
            <div class="{{$showCompanyRepresentativeForm ? '' : 'hidden'}} w-full">
                <livewire:registration.company-representative-form/>
            </div>
            <div class="{{$showCompanyBasicInfoForm ? '' : 'hidden'}} w-full">
                <livewire:registration.company-basic-form/>
            </div>
            <div class="{{$showCompanyMotivationInfoForm ? '' : 'hidden'}} w-full">
                <livewire:registration.company-motivation-form/>
            </div>
            <div class="{{$showCompanyInternshipsInfoForm ? '' : 'hidden'}} w-full">
                <livewire:registration.company-internships-form/>
            </div>
            <div class="{{$showCompanyLocationInfoForm ? '' : 'hidden'}} w-full">
                <livewire:registration.company-location-form/>
            </div>
        </div>
    </div>
</div>
