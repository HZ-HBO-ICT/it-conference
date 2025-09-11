@php
    use App\Models\Edition;
    use App\Enums\ApprovalStatus;
@endphp

<li>
    <div class="leading-6 font-semibold text-xs text-gray-400 hidden lg:block">Event organizer</div>
    <ul class="-mx-2" role="list">
        @if(Edition::current())
            @can('viewAny', \App\Models\Company::class)
                <x-waitt.sidebar-link-content-mod
                    :label="'Companies'"
                    :route="'moderator.companies.index'"
                    :icon="'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z'"
                    :param="''"
                    :roleColour="Auth::user()->role_colour"
                    :badgeText="\App\Models\Company::hasStatus(ApprovalStatus::AWAITING_APPROVAL)->count()"></x-waitt.sidebar-link-content-mod>
            @endcan
            @can('viewAny', \App\Models\Presentation::class)
                <x-waitt.sidebar-link-content-mod
                    :label="'Presentations'"
                    :route="'moderator.presentations.index'"
                    :icon="'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6'"
                    :param="''"
                    :roleColour="Auth::user()->role_colour"
                    :badgeText="\App\Models\Presentation::hasStatus(ApprovalStatus::AWAITING_APPROVAL)->count()"></x-waitt.sidebar-link-content-mod>

            @endcan
            @can('viewAny', \App\Models\Booth::class)
                <x-waitt.sidebar-link-content-mod
                    :label="'Booths'"
                    :route="'moderator.booths.index'"
                    :icon="'M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z'"
                    :param="''"
                    :roleColour="Auth::user()->role_colour"
                    :badgeText="\App\Models\Booth::hasStatus(ApprovalStatus::AWAITING_APPROVAL)->count()"></x-waitt.sidebar-link-content-mod>
            @endcan
            @can('viewAny', \App\Models\Sponsorship::class)
                <x-waitt.sidebar-link-content-mod
                    :label="'Sponsorships'"
                    :route="'moderator.sponsorships.index'"
                    :icon="'M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z'"
                    :param="''"
                    :roleColour="Auth::user()->role_colour"
                    :badgeText="\App\Models\Company::hasStatus(ApprovalStatus::AWAITING_APPROVAL, 'sponsorship_approval_status')->count()"></x-waitt.sidebar-link-content-mod>
            @endcan
            @can('viewAny', \App\Models\User::class)
                <x-waitt.sidebar-link-content-mod
                    :label="'Users'"
                    :route="'moderator.users.index'"
                    :icon="'M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z'"
                    :param="''"
                    :roleColour="Auth::user()->role_colour"></x-waitt.sidebar-link-content-mod>
            @endcan
            @can('viewAny', \App\Models\Room::class)
                <x-waitt.sidebar-link-content-mod
                    :label="'Rooms'"
                    :route="'moderator.rooms.index'"
                    :icon="'M15 10.5a3 3 0 11-6 0 3 3 0 016 0z'"
                    :param="''"
                    :roleColour="Auth::user()->role_colour"></x-waitt.sidebar-link-content-mod>
            @endcan
            @can('view-schedule')
                <x-waitt.sidebar-link-content-mod
                    :label="'Schedule management'"
                    :route="'moderator.schedule.index'"
                    :icon="'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5'"
                    :roleColour="Auth::user()->role_colour"></x-waitt.sidebar-link-content-mod>
            @endcan
            @can('view-crew')
                <x-waitt.sidebar-link-content-mod
                    :label="'Crew'"
                    :route="'moderator.crew.index'"
                    :icon="'M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z'"
                    :roleColour="Auth::user()->role_colour"></x-waitt.sidebar-link-content-mod>
            @endcan
            @can('viewAny', \App\Models\FrequentQuestion::class)
                <x-waitt.sidebar-link-content-mod
                    :label="'FAQs'"
                    :route="'moderator.faqs.index'"
                    :icon="'M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z'"
                    :roleColour="Auth::user()->role_colour"></x-waitt.sidebar-link-content-mod>
            @endcan
            @can('scan', \App\Models\Ticket::class)
                <x-waitt.sidebar-link-content-mod
                    :label="'Scan tickets'"
                    :route="'moderator.tickets.index'"
                    :icon="'M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z'"
                    :roleColour="Auth::user()->role_colour"></x-waitt.sidebar-link-content-mod>
            @endcan
        @endif
        @can('viewAny', Edition::class)
            <x-waitt.sidebar-link-content-mod
                :label="'Editions'"
                :route="'moderator.editions.index'"
                :icon="'M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z'"
                :roleColour="Auth::user()->role_colour"
                :badgeText="Edition::where('state', Edition::STATE_DESIGN)->count()"></x-waitt.sidebar-link-content-mod>
        @endcan
        @can('viewAny', \App\Models\Feedback::class)
            <x-waitt.sidebar-link-content-mod
                :label="'Received feedback'"
                :route="'moderator.feedback.index'"
                :icon="'m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125'"
                :roleColour="Auth::user()->role_colour"></x-waitt.sidebar-link-content-mod>
        @endcan
    </ul>
</li>
