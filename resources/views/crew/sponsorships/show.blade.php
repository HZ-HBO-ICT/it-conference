@php use App\Models\Sponsorship; @endphp
<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Sponsorship details') }}
        </h2>
    </div>
    <div class="py-5">
        <x-waitt.action-section>
            <x-slot name="title">
                {{ __('Company Information') }}
            </x-slot>

            <x-slot name="description">
                {{ __('The company\'s name, address and other information that is visible for all users.') }}
            </x-slot>

            <x-slot name="content">
                <div class="flex">
                    <div class="flex-col">
                        @if($company->logo_path)
                            <img class="w-56 h-56 mx-auto my-auto max-w-full block text-white"
                                 src="{{ url('storage/'. $company->logo_path) }}" alt="Logo of {{$company->name}}">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="gray" aria-hidden="true" class="w-24 h-24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                            </svg>

                        @endif
                    </div>
                    <div class="flex-col grow pl-2 text-gray-200">
                        <h3>{{ $company->name }}</h3>
                        <p class="text-sm">
                            {{ $company->street }} {{ $company->house_number }} <br>
                            {{ $company->postcode }}  {{ $company->city }}
                        </p>
                    </div>
                </div>
                <div class="text-gray-200">
                    {{ $company->description }}
                </div>
            </x-slot>
        </x-waitt.action-section>

        <x-waitt.section-border/>

        <x-waitt.action-section>
            <x-slot name="title">
                {{ __('Sponsorship Tier') }}
            </x-slot>

            <x-slot name="description">
                {{ __('The tier of sponsorship the company applied for.') }}
            </x-slot>

            <x-slot name="content">
                <div class="text-gray-200">
                    {{ucfirst($company->sponsorship->name)}}
                </div>
            </x-slot>
        </x-waitt.action-section>

        @can('viewRequest', Sponsorship::class)
            <x-waitt.section-border/>

            <x-waitt.action-section>
                <x-slot name="title">
                    {{ __('Sponsorship Approval Status') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('When the status is Approved, the company will show up at the lineup. The company is also able to request for presentations, sponsorships and booths.') }}
                </x-slot>

                <x-slot name="content">
                    <div
                        class="mt-1 text-sm leading-6 text-{{ $company->is_sponsorship_approved ? 'green-500' : 'yellow-500' }} sm:col-span-2 sm:mt-0">
                        {{ $company->is_sponsorship_approved ? 'Approved' : 'Awaiting approval' }}
                    </div>
                </x-slot>

                @if(!$company->is_sponsorship_approved)
                    <x-slot name="actions">
                        <div class="flex space-x-2">
                            <x-waitt.button
                                onclick="
                                    Livewire.dispatch('openModal', {
                                    component: 'confirmation-modal',
                                        arguments: {
                                            title: 'Approve sponsorship',
                                            method: 'POST',
                                            route: '{{ route('moderator.sponsorships.approve', ['company' => $company, 'isApproved' => 1]) }}',
                                            isApproved: 1,
                                        }
                                    })"
                                variant="save"
                                >
                                {{ __('Approve') }}
                            </x-waitt.button>

                            <x-waitt.button
                                onclick="
                                    Livewire.dispatch('openModal', {
                                    component: 'confirmation-modal',
                                        arguments: {
                                            title: 'Reject sponsorship',
                                            method: 'POST',
                                            route: '{{ route('moderator.sponsorships.approve', ['company' => $company, 'isApproved' => 0]) }}',
                                            isApproved: 0,
                                        }
                                    })"
                                variant="delete"
                            >
                                {{ __('Reject') }}
                            </x-waitt.button>
                        </div>
                    </x-slot>
                @endif
            </x-waitt.action-section>
        @endcan

        @can('delete', Sponsorship::class)
            <x-waitt.section-border/>
            <x-waitt.action-section>
                <x-slot name="title">
                    {{ __('Delete This Sponsorship') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Permanently remove the sponsorship status from this company') }}
                </x-slot>

                <x-slot name="content">
                    <div class="text-white">
                        {{ __('When deleted the company will no longer appear as a sponsor. However, the company representative is allowed to apply for another sponsorship') }}
                    </div>
                </x-slot>

                <x-slot name="actions">
                    <x-danger-button
                        onclick="Livewire.dispatch('openModal', { component: 'sponsorship.delete-sponsorship-modal', arguments: {company: {{$company}}} })">
                        {{ __('Delete Sponsorship') }}
                    </x-danger-button>
                </x-slot>

            </x-waitt.action-section>
        @endcan
    </div>
</x-crew-colorful-layout>
