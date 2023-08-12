<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$team->name}} Team details
        </h2>
        <h2 class="text-md text-gray-800 dark:text-gray-200 leading-tight pt-3">
            @if($team->is_approved)
                Here you can manage the company details and the employees that will be present during the conference
            @else
                Here you can manage the company details.<br><span class="underline">Managing the employees that will be joining you during the conference is only avaiable after
                your company is approved.</span>
            @endif
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('teams.update-team-name-form', ['team' => $team])

            @if($team->is_approved)
            @livewire('teams.team-member-manager', ['team' => $team])
            @endif

            @if (Gate::check('delete', $team) && ! $team->personal_team)
                <x-section-border/>

                <div class="mt-10 sm:mt-0">
                    @livewire('teams.delete-team-form', ['team' => $team])
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
