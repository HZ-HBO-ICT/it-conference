<x-content-moderator-layout>
    <!-- TODO: Refactor into component for reusability -->
    <nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-800 border-b flex" aria-label="Breadcrumb">
        <ol class="px-8 max-w-7xl w-full flex mx-1" role="list">
            <li class="flex">
                <div class="items-center flex">
                    <a href="{{route('moderator.overview')}}">
                        <svg class="w-5 h-5 block stroke-crew-400 fill-crew-400" xlmns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" aria-hidden="true">
                            <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                            <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                        </svg>
                    </a>
                </div>
            </li>
            <li class="flex">
                <div class="items-center flex">
                    <svg class="shrink-0 w-6 h-full fill-gray-300 dark:fill-gray-600" viewbox="0 0 24 44" preserveAspectRatio="none" aria-hidden="true">
                        <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z"></path>
                    </svg>
                    <a class="text-gray-500 dark:text-white font-medium text-sm ml-4" href="{{route('moderator.requests', 'teams')}}">Company requests</a>
                </div>
            </li>
            <li class="flex">
                <div class="items-center flex">
                    <svg class="shrink-0 w-6 h-full fill-gray-300 dark:fill-gray-600" viewbox="0 0 24 44" preserveAspectRatio="none" aria-hidden="true">
                        <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z"></path>
                    </svg>
                    <a class="text-gray-500 dark:text-white font-medium text-sm ml-4" href="{{route('moderator.requests', 'teams')}}">{{$team->name}}</a>
                </div>
            </li>
        </ol>
    </nav>
    <x-content-mod-company-request-details
        :companyName="$team->name"
        :createdAt="\Carbon\Carbon::parse($team->created_at)->format('d/m/y H:i')"
        :description="$team->description"
        :address="$team->address"
        :website="$team->website"
        :teamOwnerName="$team->owner->name"
        :teamOwnerEmail="$team->owner->email"
        :formActionApprove="route('moderator.request.teams.approve', [$team, 1])"
        :formActionReject="route('moderator.request.teams.approve', [$team, 0])"/>
</x-content-moderator-layout>
