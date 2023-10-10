<li>
    <div class="leading-6 font-semibold text-xs text-gray-400">Company</div>
    <ul class="-mx-2" role="list">
        <x-sidebar-link
            :type="'link'"
            :label="'Company details'"
            :route="'teams.show'"
            :icon="'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z'"
            :param="Auth::user()->currentTeam->id"
            :roleColour="'partner'"></x-sidebar-link>
        @if(Auth::user()->currentTeam->owner->id == Auth::user()->id)
            <x-sidebar-link
                :type="'link'"
                :label="'Requests'"
                :route="'teams.requests'"
                :icon="'M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z'"
                :param="Auth::user()->currentTeam"
                :roleColour="'partner'"></x-sidebar-link>
        @endif
        @can('request', \App\Models\Presentation::class)
            @unlessrole('content moderator')
            <x-sidebar-link
                :type="'link'"
                :label="'Request presentation'"
                :route="'speakers.request.presentation'"
                :icon="'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6'"
                :roleColour="'partner'"></x-sidebar-link>
            @endunlessrole
        @endcan
        @if(Auth::user()->speaker)
            <x-sidebar-link
                :type="'link'"
                :label="'View presentation'"
                :route="'presentations.show'"
                :param="Auth::user()->speaker->presentation"
                :icon="'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6'"
                :roleColour="'partner'"></x-sidebar-link>
        @endif
    </ul>
</li>
