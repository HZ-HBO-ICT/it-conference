<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Company details') }}
        </h2>
        <div class="pt-5">
            <x-action-section>
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
                                <img class="w-56 h-56 mx-auto my-auto max-w-full block dark:text-white"
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
                        <div class="flex-col flex-grow pl-2 pt-3 text-gray-800 dark:text-gray-200">
                            <h3>{{ $company->name }}</h3>
                            <p class="text-sm">
                                {{ $company->street }} {{ $company->house_number }} <br>
                                {{ $company->postcode }}  {{ $company->city }}
                            </p>
                        </div>
                    </div>
                    <div class="text-gray-800 pt-3 dark:text-gray-200">
                        <span class="font-semibold">Website:</span> <a
                            class="underline text-apricot-peach-400 hover:text-apricot-peach-500"
                            href="{{$company->website}}">{{ $company->website }}</a>
                    </div>
                    <div class="text-gray-800 pt-3 dark:text-gray-200">
                        <span class="font-semibold">Description:</span> {{ $company->description }}
                    </div>
                    <div class="text-gray-800 pt-3 dark:text-gray-200">
                        <span class="font-semibold">Motivation:</span> {{ $company->motivation }}
                    </div>
                </x-slot>

                @can('update', $company)
                    <x-slot name="actions">
                        <x-button
                            onclick="Livewire.dispatch('openModal', { component: 'company.edit-company-modal', arguments: {company: {{$company}}} })">
                            {{ __('Edit details') }}
                        </x-button>
                    </x-slot>
                @endcan
            </x-action-section>

            <x-section-border/>

            <x-action-section>
                <x-slot name="title">
                    {{ __('Internship Opportunities') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Here you can see the internship opportunities the company has specified') }}
                </x-slot>

                <x-slot name="content">
                    @if(!$company->internshipAttributes->isEmpty())
                        <div class="space-y-4">
                            @if($company->internshipAttributes()->years()->exists())
                                <div class="bg-gray-50 dark:bg-gray-900 p-3 rounded-lg">
                                    <h3 class="font-semibold">Internship for years:</h3>
                                    <p class="text-sm text-gray-700 dark:text-gray-200">{{ implode(', ', $company->internshipAttributes()->years()->pluck('value')->toArray()) }}</p>
                                </div>
                            @endif
                            @if($company->internshipAttributes()->tracks()->exists())
                                <div class="bg-gray-50 dark:bg-gray-900 p-3 rounded-lg">
                                    <h3 class="font-semibold">Internship for tracks:</h3>
                                    <p class="text-sm text-gray-700 dark:text-gray-200">{{ implode(', ', $company->internshipAttributes()->tracks()->pluck('value')->toArray()) }}</p>
                                </div>
                            @endif
                            @if($company->internshipAttributes()->languages()->exists())
                                <div class="bg-gray-50 dark:bg-gray-900 p-3 rounded-lg">
                                    <h3 class="font-semibold">Internship in the following languages:</h3>
                                    <p class="text-sm text-gray-700 dark:text-gray-200">{{ implode(', ', $company->internshipAttributes()->languages()->pluck('value')->toArray()) }}</p>
                                </div>
                            @endif
                        </div>
                    @else
                        <div>
                            <p class="text-gray-700 dark:text-gray-100">No internship details were specified.</p>
                        </div>
                    @endif
                </x-slot>

            </x-action-section>


            <x-section-border/>

            <x-action-section>
                <x-slot name="title">
                    {{ __('Company Members') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('The participants who are related to this company.') }}
                </x-slot>

                <x-slot name="content">
                    <div class="text-gray-800 dark:text-gray-200">
                        @forelse($company->users as $user)
                            {{ $user->name }} | {{ $user->email }}
                            @if($company->representative->id == $user->id)
                                              (Company representative)
                            @endif
                            <br>
                        @empty
                            {{ __('There are currently no users in this company') }}
                        @endforelse
                    </div>
                </x-slot>
            </x-action-section>

            <x-section-border/>

            @can('viewRequest', $company)
                <x-action-section>
                    <x-slot name="title">
                        {{ __('Company Approval Status') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('When the status is approved, the company will show up at the lineup. The company is also able to request for presentations, sponsorships and booths.') }}
                    </x-slot>

                    <x-slot name="content">
                        <div
                            class="mt-1 text-sm leading-6 text-{{ $company->is_approved ? 'green-500' : 'yellow-500' }} sm:col-span-2 sm:mt-0">
                            {{ $company->is_approved ? 'Approved' : 'Awaiting approval' }}
                        </div>
                    </x-slot>

                    @can('approveRequest', $company)
                        @if(!$company->is_approved)
                            <x-slot name="actions">
                                <div class="flex space-x-2">
                                    <x-button
                                        onclick="
                                    Livewire.dispatch('openModal', {
                                    component: 'confirmation-modal',
                                        arguments: {
                                            title: 'Approve company',
                                            method: 'POST',
                                            route: '{{ route('moderator.companies.approve', ['company' => $company, 'isApproved' => 1]) }}',
                                            isApproved: 1,
                                        }
                                    })"
                                        class="dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                                        {{ __('Approve') }}
                                    </x-button>

                                    <x-danger-button
                                        onclick="
                                    Livewire.dispatch('openModal', {
                                        component: 'confirmation-modal',
                                        arguments: {
                                            title: 'Reject company',
                                            method: 'POST',
                                            route: '{{ route('moderator.companies.approve', ['company' => $company, 'isApproved' => 0]) }}',
                                            isApproved: 0,
                                        }
                                    })">
                                        {{ __('Reject') }}
                                    </x-danger-button>
                                </div>
                            </x-slot>
                        @endif
                    @endcan
                </x-action-section>

                <x-section-border/>
            @endcan
            @can('view', $company->booth)
                <x-action-section>
                    <x-slot name="title">
                        {{ __('Company Booth') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Determines the stand for the company') }}
                    </x-slot>

                    <x-slot name="content">
                        <div>
                            @if(!$company->booth)
                                <p class="text-gray-500 dark:text-yellow-300">Not requested</p>
                            @elseif(!$company->booth->is_approved)
                                <p class="text-yellow-500 dark:text-yellow-400">Not approved/Waiting approval. <a
                                        class="underline" href="{{route('moderator.booths.show', $company->booth)}}">See
                                                                                                                     more
                                                                                                                     here</a>
                                </p>
                            @else
                                <p class="text-green-500 dark:text-green-400">Approved. <a class="underline"
                                                                                           href="{{route('moderator.booths.show', $company->booth)}}">See
                                                                                                                                                      more
                                                                                                                                                      here</a>
                                </p>
                            @endif
                        </div>
                    </x-slot>
                </x-action-section>

                <x-section-border/>
            @endcan

            <x-action-section>
                <x-slot name="title">
                    Company Presentations
                </x-slot>

                <x-slot name="description">
                    View all presentations related to the company
                </x-slot>

                <x-slot name="content">
                        <div class="space-y-2">
                            @forelse($company->presentations as $presentation)
                                <a href="{{route('moderator.presentations.show', $presentation)}}"
                                   class="block bg-white dark:bg-gray-700 p-4 borde rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 transition duration-300">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="#E77A50"
                                                 aria-hidden="true" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"/>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-sm font-semibold">{{ $presentation->name }}</h4>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">Hosted
                                                                                                by: {{ $presentation->speakers_name }}</p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <p>The company has no presentations currently.</p>
                            @endforelse
                        </div>
                </x-slot>
            </x-action-section>

            <x-section-border/>

            <x-action-section>
                <x-slot name="title">
                    {{ __('Company Sponsorship Status') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('When the status is approved, the company will sponsor the conference.') }}
                </x-slot>

                <x-slot name="content">
                    @if(!$company->sponsorship)
                        <p class="text-gray-500 dark:text-yellow-300">Not requested</p>
                    @elseif(!$company->is_sponsorship_approved)
                        <p class="text-yellow-500 dark:text-yellow-400">Not approved/Waiting approval. <a
                                class="underline" href="{{route('moderator.sponsorships.show', $company)}}">See more
                                                                                                            here</a></p>
                    @else
                        <p class="text-green-500 dark:text-green-400">Approved. <a class="underline"
                                                                                   href="{{route('moderator.sponsorships.show', $company)}}">See
                                                                                                                                             more
                                                                                                                                             here</a>
                        </p>
                    @endif
                </x-slot>
            </x-action-section>

            <x-section-border/>

            <x-action-section>
                <x-slot name="title">
                    {{ __('Delete company') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Delete your company if you wish to no longer be participating in the IT Conference.') }}
                </x-slot>

                <x-slot name="actions">
                    <x-danger-button
                        onclick="Livewire.dispatch('openModal', { component: 'company.delete-company-modal', arguments: {company: {{$company}}} })">
                        {{ __('Delete Company') }}
                    </x-danger-button>
                </x-slot>
            </x-action-section>
        </div>
    </div>
</x-hub-layout>
