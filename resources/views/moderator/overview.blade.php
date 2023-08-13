@php
    use App\Models\Team;
    use App\Models\Booth;
    use App\Models\Speaker;
    use App\Models\User;
@endphp

<x-content-moderator-layout>
    <h2 class="text-4xl font-extrabold text-white ml-4">Requests</h2>
    <div class="grid grid-cols-3 pr-10 pt-5">
        <x-content-moderator-block :label="'Company requests'" :count="Team::where('is_approved', 0)->count()"
                                   :routeName="route('moderator.requests', 'booths')"/>
        <x-content-moderator-block :label="'Booth requests'" :count="Booth::where('is_approved', 0)->count()"
                                   :routeName="route('moderator.requests', 'booths')"/>
        <x-content-moderator-block :label="'Sponsorship requests'"
                                   :count="Team::where('is_sponsor_approved', 0)->count()"
                                   :routeName="route('moderator.requests', 'sponsorships')"/>
    </div>
    <div class="grid grid-cols-2 pt-5">
        <x-content-moderator-block :label="'Presentation requests'" :count="$numberOfPresentationRequests"
                                   :routeName="route('moderator.requests', 'presentations')"/>
        <div class="pr-10">
            <x-content-moderator-block :label="'Presentations to be scheduled'"
                                       :count="$numberOfUnscheduledPresentations"
                                       :routeName="route('moderator.requests', 'presentations')"/>
        </div>
    </div>
    <div class="flex items-center justify-center pr-10">
        <div class="border-t border-gray-200 dark:border-gray-600 mt-5 w-4/5"></div>
    </div>
    <h2 class="text-4xl font-extrabold text-white mt-6 ml-4">Stats</h2>
    <div class="grid grid-cols-4 pr-10 pt-5">
        <x-content-moderator-overview-block :label="'Companies'" :count="Team::all()->count()"/>
        <x-content-moderator-overview-block :label="'Participants'" :count="User::all()->count()"/>
        <x-content-moderator-overview-block :label="'Speakers'" :count="Speaker::where('is_approved', 1)->count()"/>
        <x-content-moderator-overview-block :label="'Booths'" :count="Booth::where('is_approved', 1)->count()"/>
        <div style="grid-column: span 4;" class="pt-5">
            <x-content-moderator-overview-block :label="'Presentation - lectures & workshops'"
                                                :count="$numberOfScheduledPresentations"/>
        </div>
    </div>
</x-content-moderator-layout>
