@php
    use App\Models\Team;
    use App\Models\Booth;
    use App\Models\Speaker;
    use App\Models\User;
@endphp

<x-content-moderator-layout>
    <div>
        <h2 class="text-4xl font-extrabold text-gray-700 dark:text-white ml-4 py-5">Overview</h2>
        <h2 class="text-3xl font-extrabold text-gray-700 dark:text-white ml-4">Requests</h2>
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
                                           :routeName="route('moderator.presentations-for-scheduling')"/>
            </div>
        </div>
        <div class="flex items-center justify-center pr-10">
            <div class="border-t border-gray-200 dark:border-gray-600 mt-5 w-4/5"></div>
        </div>
        <h2 class="text-3xl font-extrabold text-gray-700 dark:text-white mt-6 ml-4">Stats</h2>
        <div class="grid grid-cols-3 pr-10 pt-5 gap-y-4">
            <x-content-moderator-overview-block :label="'Participants'" :count="User::role('participant')->get()->count()"
                                                :route="route('moderator.list', 'participants')"/>
            <x-content-moderator-overview-block :label="'Speakers'" :count="User::role('speaker')->get()->count()"
                                                :route="route('moderator.list', 'speakers')"/>
            <x-content-moderator-overview-block :label="'All users'" :count="User::all()->count()"
                                                :route="route('moderator.list', 'users')"/>
            <x-content-moderator-overview-block :label="'Booths'" :count="Booth::where('is_approved', 1)->count()"
                                                :route="route('moderator.list', 'booths')"/>
            <x-content-moderator-overview-block :label="'Presentations'"
                                                :count="$numberOfScheduledPresentations"
                                                :route="route('moderator.list', 'presentations')"/>
            <x-content-moderator-overview-block :label="'Companies'" :count="Team::where('is_approved', 1)->count()"
                                                :route="route('moderator.list', 'teams')"/>
        </div>
    </div>
</x-content-moderator-layout>
