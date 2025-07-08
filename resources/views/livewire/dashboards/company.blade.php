@php use Illuminate\Support\Facades\Auth; @endphp
<div>
    @if(Auth::user()->isDefaultCompanyMember)
        <x-dashboards.blocks.company-role-decider/>
    @elseif(Auth::user()->hasRole('pending speaker'))
        <x-dashboards.blocks.speaker-info/>
    @elseif(Auth::user()->hasRole('pending booth owner'))
        <x-dashboards.blocks.booth-owner-info/>
    @endif
    <div class="grid grid-cols-1 lg:grid-cols-8 gap-3">
        <div class="w-full h-52 col-span-3">
            <livewire:dashboards.widgets.welcome :user="$user"/>
        </div>
        <div class="w-full h-52 col-span-2 grid grid-cols-1 gap-3">
            <livewire:dashboards.widgets.status
                :label="'Company'"
                :type="'company'"
                :company="$user->company"
                :icon="'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z'" />
            <livewire:dashboards.widgets.status
                :label="'Booth'"
                :type="'booth'"
                :company="$user->company"
                :icon="'M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z'"/>
            <livewire:dashboards.widgets.status
                :label="'Sponsorship'"
                :type="'sponsorship'"
                :company="$user->company"
                :icon="'M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z'"/>
        </div>
        <div class="w-full h-fit col-span-3 row-span-3">
            <livewire:dashboards.widgets.schedule :user="Auth::user()" :startHour="8" :endHour="17"/>
        </div>
        <div class="w-full col-span-5">
            <livewire:dashboards.widgets.company-members :company="$user->company"/>
        </div>
        <div class="w-full min-h-20 h-fit col-span-3">
            <livewire:dashboards.widgets.presentations :company="$user->company"/>
        </div>
        <div class="w-full h-full col-span-2 grid grid-cols-1 gap-3">
            <livewire:dashboards.widgets.request
                class="bg-sponsor-gradient"
                :type="'Sponsorship'"
                :company="Auth::user()->company"
                :description="'Gain visibility and connect with attendees by becoming a sponsor. Submit your sponsorship request to get started.'"/>
            <livewire:dashboards.widgets.request
                class="bg-booth-gradient"
                :type="'Booth'"
                :company="Auth::user()->company"
                :description="'Want a presence at the event? Request a booth to showcase your company.'"
            />
        </div>
    </div>
</div>
