<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Booth details') }}
        </h2>
        <div class="pt-5">
            <x-action-section>
                <x-slot name="title">
                    {{ __('Company Information') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('The company that has requested the booth') }}
                </x-slot>

                <x-slot name="content">
                    <div class="flex">
                        <div class="flex-col">
                            @if($booth->company->logo_path)
                                <img class="w-56 h-56 mx-auto my-auto max-w-full block dark:text-white"
                                     src="{{ url('storage/'. $booth->company->logo_path) }}"
                                     alt="Logo of {{$booth->company->name}}">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"
                                     stroke-width="1.5"
                                     stroke="gray" aria-hidden="true" class="w-20 h-20">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                                </svg>

                            @endif
                        </div>
                        <div class="text-gray-900 dark:text-gray-300 flex-col pt-3 grow pl-4">
                            <h3>{{ $booth->company->name }}</h3>
                            <p class="text-gray-900 dark:text-gray-300 text-sm">
                                {{ $booth->company->street }} {{ $booth->company->house_number }} <br>
                                {{ $booth->company->postcode }}  {{ $booth->company->city }}
                            </p>
                        </div>
                    </div>
                </x-slot>
            </x-action-section>

            <x-section-border/>

            <x-action-section>
                <x-slot name="title">
                    {{ __('Booth Details') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Here you can see the booth details') }}
                </x-slot>

                <x-slot name="content">
                    <div class="text-gray-900 dark:text-gray-300">
                        <p>Width: {{ $booth->width }}</p>
                        <p>Length: {{$booth->length}}</p>
                        <p>Additional information: {{ $booth->additional_information }}</p>
                    </div>
                </x-slot>


                <x-slot name="actions">
                    @can('update', $booth)
                        <x-button
                            onclick="Livewire.dispatch('openModal', { component: 'booth.edit-booth-modal', arguments: {booth: {{$booth}}} })">
                            {{ __('Edit details') }}
                        </x-button>
                    @endcan
                </x-slot>
            </x-action-section>

            <x-section-border/>

            <x-action-section>
                <x-slot name="title">
                    {{ __('Booth owners') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Here you can see the people who requested/joined the booth owners for the company') }}
                </x-slot>

                <x-slot name="content">
                    <div class="space-y-6">
                        @forelse ($booth->company->booth_owners->sortBy('name') as $user)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex items-center pr-4">
                                        <img class="w-8 h-8 rounded-full object-cover"
                                             src="{{ $user->profile_photo_url }}"
                                             alt="{{ $user->name }}">
                                        <div class="ml-4 leading-tight">
                                            <div class="text-gray-900 dark:text-white">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div>
                                        {{ $user->getRoleNames()->implode(', ') }}
                                    </div>
                                </div>
                            </div>

                        @empty
                            <span class="text-orange-600">Something had gone wrong — no booth owners were found. Contact the company or the development team.</span>
                        @endforelse
                    </div>
                </x-slot>
            </x-action-section>

            <x-section-border/>

            @can('viewRequest', $booth)
                <x-action-section>
                    <x-slot name="title">
                        {{ __('Booth Approval Status') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('When the status is approved, the booth will be secured for the company.') }}
                    </x-slot>

                    <x-slot name="content">
                        <div
                            class="mt-1 text-sm leading-6 text-{{ $booth->is_approved ? 'green-500' : 'yellow-500' }} sm:col-span-2 sm:mt-0">
                            {{ $booth->is_approved ? 'Approved' : 'Awaiting approval' }}
                        </div>
                    </x-slot>

                    @if(!$booth->is_approved)
                        @can('approveRequest', $booth)
                            <x-slot name="actions">
                                <div class="flex space-x-2">
                                    <x-button
                                        onclick="
                                    Livewire.dispatch('openModal', {
                                    component: 'confirmation-modal',
                                        arguments: {
                                            title: 'Approve booth',
                                            method: 'POST',
                                            route: '{{ route('moderator.booths.approve', ['booth' => $booth, 'isApproved' => 1]) }}',
                                            isApproved: 1,
                                        }
                                    })"
                                        class="dark:bg-green-500 bg-green-500 hover:bg-green-600 dark:hover:bg-green-600 active:bg-green-600 dark:active:bg-green-600">
                                        {{ __('Approve') }}
                                    </x-button>

                                    <x-danger-button
                                        onclick="
                                    Livewire.dispatch('openModal', {
                                        component: 'confirmation-modal',
                                        arguments: {
                                            title: 'Reject booth',
                                            method: 'POST',
                                            route: '{{ route('moderator.booths.approve', ['booth' => $booth, 'isApproved' => 0]) }}',
                                            isApproved: 0,
                                        }
                                    })">
                                        {{ __('Reject') }}
                                    </x-danger-button>
                                </div>
                            </x-slot>
                        @endcan
                    @endif
                </x-action-section>
            @endcan

            <x-section-border/>

            @can('delete', $booth)
                @if($booth->is_approved)
                    <x-action-section>
                        <x-slot name="title">
                            {{ __('Delete Booth') }}
                        </x-slot>

                        <x-slot name="description">
                            You can remove the company booth
                        </x-slot>

                        <x-slot name="actions">
                            <x-danger-button
                                onclick="Livewire.dispatch('openModal', { component: 'booth.delete-booth-modal', arguments: {booth: {{$booth}}} })">
                                {{ __('Delete Booth') }}
                            </x-danger-button>
                        </x-slot>
                    </x-action-section>
                @endif
            @endcan
        </div>
    </div>
</x-hub-layout>
