<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Company details') }}
        </h2>
    </div>
    <div class="py-5">
        <div>
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
                                     aria-hidden="true" class="w-24 h-24 stroke-waitt-pink">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                                </svg>

                            @endif
                        </div>
                        <div class="flex-col grow pl-2 pt-3 text-gray-200">
                            <h3>{{ $company->name }}</h3>
                            <p class="text-sm">
                                {{ $company->street }} {{ $company->house_number }} <br>
                                {{ $company->postcode }}  {{ $company->city }}
                            </p>
                        </div>
                    </div>
                    <div class="text-gray-200 pt-3">
                        <span class="font-semibold">Website:</span> <a
                            class="underline text-waitt-pink-400"
                            href="{{$company->website}}">{{ $company->website }}</a>
                    </div>
                    <div class="pt-3 text-gray-200">
                        <span class="font-semibold">Description:</span> {{ $company->description }}
                    </div>
                    <div class="pt-3 text-gray-200">
                        <span class="font-semibold">Motivation:</span> {{ $company->motivation }}
                    </div>
                </x-slot>

                @can('update', $company)
                    <x-slot name="actions">
                        <x-waitt.button variant="edit"
                                        onclick="Livewire.dispatch('openModal', { component: 'company.edit-company-modal', arguments: {company: {{$company}}} })">
                            {{ __('Edit details') }}
                        </x-waitt.button>
                    </x-slot>
                @endcan
            </x-waitt.action-section>

            <x-waitt.section-border/>

            <x-waitt.action-section>
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
                                <div class="bg-waitt-dark p-3 text-gray-100 rounded-lg">
                                    <h3 class="font-semibold">Internship for years:</h3>
                                    <p class="text-sm text-gray-200">{{ implode(', ', $company->internshipAttributes()->years()->pluck('value')->toArray()) }}</p>
                                </div>
                            @endif
                            @if($company->internshipAttributes()->tracks()->exists())
                                <div class="bg-waitt-dark p-3 text-gray-100 rounded-lg">
                                    <h3 class="font-semibold">Internship for tracks:</h3>
                                    <p class="text-sm text-gray-200">{{ implode(', ', $company->internshipAttributes()->tracks()->pluck('value')->toArray()) }}</p>
                                </div>
                            @endif
                            @if($company->internshipAttributes()->languages()->exists())
                                <div class="bg-waitt-dark p-3 text-gray-100 rounded-lg">
                                    <h3 class="font-semibold">Internship in the following languages:</h3>
                                    <p class="text-sm text-gray-200">{{ implode(', ', $company->internshipAttributes()->languages()->pluck('value')->toArray()) }}</p>
                                </div>
                            @endif
                        </div>
                    @else
                        <div>
                            <p class="text-gray-200">No internship details were specified.</p>
                        </div>
                    @endif
                </x-slot>

            </x-waitt.action-section>


            <x-waitt.section-border/>

            <x-waitt.action-section>
                <x-slot name="title">
                    {{ __('Company Members') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('The participants who are related to this company.') }}
                </x-slot>

                <x-slot name="content">
                    <div class="text-gray-200">
                        <ul class="space-y-3">
                            @forelse($company->users as $user)
                                <li class="flex items-center p-3 bg-waitt-dark/90 rounded-md shadow-xs">
                                    <!-- Profile Image -->
                                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                                         class="w-10 h-10 rounded-full object-cover mr-3">

                                    <!-- User Information -->
                                    <div class="flex-1">
                                        <div class="font-semibold text-base">
                                            {{ $user->name }}
                                        </div>
                                        <div class="text-xs text-gray-300">
                                            {{ $user->email }}
                                        </div>
                                        <!-- User Roles -->
                                        @if($user->roles->isNotEmpty())
                                            <div class="text-xs text-gray-400 mt-1">
                                                {{ __('Roles: ') }}{{ optional($user->mainRoles())->join(', ') }}
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Company Representative Badge -->
                                    @if($company->representative->id == $user->id)
                                        <span
                                            class="ml-3 px-2 py-0.5 border-emerald-500 border text-emerald-500 text-xs font-semibold rounded-full">
                                {{ __('Company Representative') }}
                            </span>
                                    @endif
                                </li>
                            @empty
                                <li class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('There are currently no users in this company.') }}
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </x-slot>
                @can('addMember', $company)
                    <x-slot name="actions">
                        @if ($company->is_approved)
                            <x-waitt.button variant="edit"
                                            onclick="Livewire.dispatch('openModal', { component: 'company.add-participant', arguments: {companyId: {{$company->id}}} })">
                                {{ __('Add Participant') }}
                            </x-waitt.button>
                        @else
                            <div>
                                <p class="text-sm text-gray-700 dark:text-gray-100">The company must be approved before
                                    adding participants.</p>
                            </div>
                        @endif
                    </x-slot>
                @endcan
            </x-waitt.action-section>

            <x-waitt.section-border/>

            @can('viewRequest', $company)
                <x-waitt.action-section>
                    <x-slot name="title">
                        {{ __('Company Approval Status') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('When the status is approved, the company will show up at the lineup. The company is also able to request for presentations, sponsorships and booths.') }}
                    </x-slot>

                    <x-slot name="content">
                        <div
                            class="mt-1 leading-6 text-{{ $company->is_approved ? 'green-500' : 'yellow-500' }} sm:col-span-2 sm:mt-0">
                            {{ $company->is_approved ? 'Approved' : 'Awaiting approval' }}
                        </div>
                    </x-slot>

                    @can('approveRequest', $company)
                        @if(!$company->is_approved)
                            <x-slot name="actions">
                                <div class="flex space-x-2">
                                    <x-waitt.button
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
                                        variant="save"
                                    >
                                        {{ __('Approve') }}
                                    </x-waitt.button>

                                    <x-waitt.button
                                        onclick="
                                    Livewire.dispatch('openModal', {
                                        component: 'confirmation-modal',
                                        arguments: {
                                            title: 'Reject company',
                                            method: 'POST',
                                            route: '{{ route('moderator.companies.approve', ['company' => $company, 'isApproved' => 0]) }}',
                                            isApproved: 0,
                                        }
                                    })" variant="delete">
                                        {{ __('Reject') }}
                                    </x-waitt.button>
                                </div>
                            </x-slot>
                        @endif
                    @endcan
                </x-waitt.action-section>

                <x-waitt.section-border/>
            @endcan
            @can('view', $company->booth)
                <x-waitt.action-section>
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
                                        class="underline"
                                        href="{{route('moderator.booths.show', $company->booth)}}">See
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
                </x-waitt.action-section>

                <x-waitt.section-border/>
            @endcan

            <x-waitt.action-section>
                <x-slot name="title">
                    Company Presentations
                </x-slot>

                <x-slot name="description">
                    View all presentations related to the company
                </x-slot>

                <x-slot name="content">
                    @if($company->presentations->count() > 0)
                        <div class="space-y-2">
                            <div class="hidden sm:block">
                                <div class="py-4">
                                    <div class="border-t border-gray-400"></div>
                                </div>
                            </div>
                            @endif
                            @forelse($company->presentations as $presentation)
                                <a href="{{route('moderator.presentations.show', $presentation)}}"
                                   class="block hover:bg-waitt-dark transition duration-300">
                                    <div class="flex items-center">
                                        <div class="shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5"
                                                 aria-hidden="true" class="w-6 h-6 stroke-waitt-pink">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"/>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-sm text-gray-100 font-semibold">{{ $presentation->name }}</h4>
                                            <p class="text-xs text-gray-400">Hosted
                                                by: {{ $presentation->speakers_name }}</p>
                                        </div>
                                    </div>
                                </a>
                                @if($company->presentations->count() > 1)
                                    <div class="hidden sm:block">
                                        <div class="py-4">
                                            <div class="border-t border-gray-400"></div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <p class="text-gray-200">The company has no presentations currently.</p>
                            @endforelse
                        </div>
                </x-slot>
            </x-waitt.action-section>

            <x-waitt.section-border/>

            <x-waitt.action-section>
                <x-slot name="title">
                    {{ __('Company Sponsorship Status') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('When the status is approved, the company will sponsor the conference.') }}
                </x-slot>

                <x-slot name="content">
                    @if(!$company->sponsorship)
                        <p class="text-gray-200">Not requested</p>
                    @elseif(!$company->is_sponsorship_approved)
                        <p class="text-yellow-400">Not approved/Waiting approval. <a
                                class="underline" href="{{route('moderator.sponsorships.show', $company)}}">See more
                                here</a></p>
                    @else
                        <p class="text-green-400">Approved. <a class="underline"
                                                               href="{{route('moderator.sponsorships.show', $company)}}">See
                                more
                                here</a>
                        </p>
                    @endif
                </x-slot>
            </x-waitt.action-section>

            <x-waitt.section-border/>

            <x-waitt.action-section>
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
            </x-waitt.action-section>
        </div>
    </div>
</x-crew-colorful-layout>
