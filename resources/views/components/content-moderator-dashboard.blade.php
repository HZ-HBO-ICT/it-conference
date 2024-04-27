@php
    use App\Models\Booth;
    use App\Models\Company;
    use App\Models\User;
@endphp

<div>
    <div class="py-8 px-2 mx-auto max-w-7xl">
        <div>
            <h3 class="leading-6 font-semibold text-xl dark:text-white">Pending requests</h3>
            <div class="pt-6 px-6 pb-12 rounded-lg overflow-hidden relative">
                <dl class="gap-5 grid-cols-3 grid mt-5">
{{--                    <x-content-moderator-block--}}
{{--                        :label="'Companies'"--}}
{{--                        :count="Company::where('is_approved', 0)->count()"--}}
{{--                        :route="'moderator.companies.index'"--}}
{{--                        :icon="'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z'"--}}
{{--                        :roleColour="'crew'"/>--}}
{{--                    <x-content-moderator-block--}}
{{--                        :label="'Booths'"--}}
{{--                        :count="Booth::where('is_approved', 0)->count()"--}}
{{--                        :route="'moderator.booths.index'"--}}
{{--                        :icon="'M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z'"--}}
{{--                        :roleColour="'crew'"/>--}}
{{--                    <x-content-moderator-block--}}
{{--                        :label="'Sponsorships'"--}}
{{--                        :count="Company::where('is_sponsorship_approved', 0)->count()"--}}
{{--                        :route="'moderator.sponsors.index'"--}}
{{--                        :icon="'M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z'"--}}
{{--                        :roleColour="'crew'"/>--}}
{{--                    <x-content-moderator-block--}}
{{--                        :label="'Presentations'"--}}
{{--                        :count="$numberOfPresentationRequests"--}}
{{--                        :route="'moderator.presentations.index'"--}}
{{--                        :icon="'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6'"--}}
{{--                        :roleColour="'crew'"/>--}}
{{--                    <x-content-moderator-block--}}
{{--                        :label="'Schedule presentations'"--}}
{{--                        :count="$numberOfUnscheduledPresentations"--}}
{{--                        :route="'moderator.presentations-for-scheduling'"--}}
{{--                        :icon="'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5'"--}}
{{--                        :roleColour="'crew'"/>--}}
                </dl>
            </div>
        </div>
    </div>
    <div class="py-4 px-2 mx-auto max-w-7xl">
        <div>
            <h3 class="leading-6 font-semibold text-xl dark:text-white">Current totals</h3>
            <div class="pt-6 px-6 pb-12 rounded-lg overflow-hidden relative">
                <dl class="gap-5 grid-cols-3 grid mt-5">
{{--                    <x-content-moderator-block--}}
{{--                        :label="'Participants'"--}}
{{--                        :count="User::role('participant')->get()->count()"--}}
{{--                        :icon="'M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z'"--}}
{{--                        :route="'moderator.list'"--}}
{{--                        :param="'participant'"--}}
{{--                        :roleColour="'crew'"/>--}}
{{--                    <x-content-moderator-block--}}
{{--                        :label="'Speakers'"--}}
{{--                        :count="User::role('speaker')->get()->count()"--}}
{{--                        :icon="'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605'"--}}
{{--                        :route="'moderator.list'"--}}
{{--                        :param="'speakers'"--}}
{{--                        :roleColour="'crew'"/>--}}
{{--                    <x-content-moderator-block--}}
{{--                        :label="'All users'"--}}
{{--                        :count="User::all()->count()"--}}
{{--                        :icon="'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z'"--}}
{{--                        :route="'moderator.list'"--}}
{{--                        :param="'users'"--}}
{{--                        :roleColour="'crew'"/>--}}
{{--                    <x-content-moderator-block--}}
{{--                        :label="'Booths'"--}}
{{--                        :count="Booth::where('is_approved', 1)->count()"--}}
{{--                        :icon="'M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z'"--}}
{{--                        :route="'moderator.booths.index'"--}}
{{--                        :param="'booths'"--}}
{{--                        :roleColour="'crew'"/>--}}
{{--                    <x-content-moderator-block--}}
{{--                        :label="'Presentations'"--}}
{{--                        :count="$numberOfScheduledPresentations"--}}
{{--                        :icon="'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605'"--}}
{{--                        :route="'moderator.presentations.index'"--}}
{{--                        :roleColour="'crew'"/>--}}
{{--                    <x-content-moderator-block--}}
{{--                        :label="'Companies'"--}}
{{--                        :count="Company::where('is_approved', 1)->count()"--}}
{{--                        :icon="'M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21'"--}}
{{--                        :route="'moderator.companies.index'"--}}
{{--                        :roleColour="'crew'"/>--}}
                </dl>
            </div>
        </div>
    </div>
</div>
