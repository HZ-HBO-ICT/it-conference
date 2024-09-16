<div>
    <x-section-border/>
    <div class="mt-10 sm:mt-0">
        <x-action-section>
            <x-slot name="title">
                {{ __('Company Members') }}
            </x-slot>

            <x-slot name="description">
                All of the people that you have invited to join your team for the IT Conference and have accepted
                the invitation
            </x-slot>

            <x-slot name="content">
                <div class="space-y-6">
                    @if($company->users->isEmpty())
                        <div class="flex items-center">
                            <div class="ml-4 text-sm dark:text-gray-400">Currently there are no members of your
                                                                         company
                            </div>
                        </div>
                    @else
                        <hr>
                        @foreach ($company->users->sortBy('name') as $user)
                            <div wire:key="{{ $user->id }}" class="flex items-center justify-between px-4 bg-white dark:bg-gray-800 rounded-lg">
                                <div class="flex items-center">
                                    <div class="flex items-center mt-2 pr-4">
                                        <img class="w-10 h-10 rounded-full object-cover"
                                             src="{{ $user->profile_photo_url }}"
                                             alt="{{ $user->name }}">
                                        <div class="ml-4 leading-tight">
                                            <div class="text-gray-900 dark:text-white font-semibold">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-600 dark:text-gray-400">{{ $user->mainRoles()->implode(', ') }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    @can('deleteMember', $company)
                                        @php
                                            $removeMemberKey = $user->id . 'rm';
                                        @endphp
                                        @if(!$user->hasRole('company representative'))
                                            <livewire:company.remove-member :user="$user" :key="$removeMemberKey"/>
                                        @endif
                                    @endcan
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @endif
                </div>
            </x-slot>
        </x-action-section>
    </div>
    @can('viewAnyMemberInvitation', $company)
        <x-section-border/>
        <livewire:company.add-member :company="$company"/>
    @endcan
</div>
