
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
              <livewire:dashboards.widgets.welcome/>
          </div>
          <div class="w-full h-20 col-span-2 border border-2 border-cyan-300"></div>
          <div class="w-full h-20 col-span-3 border border-2 border-cyan-300"></div>
      </div>
</div>
