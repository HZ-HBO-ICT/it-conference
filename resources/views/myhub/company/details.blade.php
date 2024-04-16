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
                    @livewire('company.member-manager', ['company' => $company])
                    <x-section-border/>
                    @livewire('company.delete-company', ['company' => $company])
                </div>
            </div>

        </div>
    </div>
</x-hub-layout>
