@php use Illuminate\Support\Facades\Auth; @endphp
<x-hub-layout>
    <div class="py-8 px-2 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl px-6 text-gray-800 dark:text-gray-200 leading-tight">
            {{$company->name}} details
        </h2>
        <div class="pt-6 px-6 pb-12 rounded-lg overflow-hidden relative">
            <div>
                <h2 class="text-md text-gray-800 dark:text-gray-200 leading-tight pt-3">
                            Here you can manage the company details and the employees that will be present
                            during
                            the
                            conference
                </h2>
            </div>

            <div>
                <div class="py-10">
                    @livewire('company.manage-logo', ['company' => $company])
                    <x-section-border/>
                    @livewire('company.details-form', ['company' => $company ])

{{--
                    @if($team->is_approved)
--}}
                    @livewire('company.member-manager', ['company' => $company])
{{--
                    @endif
--}}
{{--
                    @if (Gate::check('delete', $team) && ! $team->personal_team)
                        <x-section-border/>

                        <div class="mt-10 sm:mt-0">
                            @livewire('teams.delete-team-form', ['team' => $team])
                        </div>
                    @endif--}}
                </div>
            </div>

        </div>
    </div>
</x-hub-layout>
