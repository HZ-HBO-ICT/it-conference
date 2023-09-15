@php use Illuminate\Support\Facades\Auth; @endphp
<x-hub-layout>
    <div class="py-8 px-2 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl px-6 text-gray-800 dark:text-gray-200 leading-tight">
            {{$team->name}} details
        </h2>
        <div class="pt-6 px-6 pb-12 rounded-lg overflow-hidden relative">
            <div>
                <h2 class="text-md text-gray-800 dark:text-gray-200 leading-tight pt-3">
                    @if(Auth::user()->ownsTeam($team))
                        @if($team->is_approved)
                            Here you can manage the company details and the employees that will be present
                            during
                            the
                            conference
                        @else
                            Here you can manage the company details.<br><span class="text-purple-400">Managing the employees that will be joining you during the conference is only avaiable after
                        your company is approved.</span>
                        @endif
                    @endif
                </h2>
            </div>

            <div>
                <div class="py-10">
                    @livewire('manage-company-logo', ['team' => $team])

                    <x-section-border/>

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
        </div>
    </div>
</x-hub-layout>
