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
                        @foreach ($company->users->sortBy('name') as $user)
                            <div wire:key="{{ $user->id }}" class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex items-center mt-2 pr-4">
                                        <img class="w-8 h-8 rounded-full object-cover"
                                             src="{{ $user->profile_photo_url }}"
                                             alt="{{ $user->name }}">
                                        <div class="ml-4 leading-tight">
                                            <div class="text-gray-900 dark:text-white">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                    @can('editMember', [$company, $user])
                                        @php
                                            $updateMemberKey = $user->id . 'um';
                                        @endphp
                                        <livewire:company.update-member-role :user="$user" :key="$updateMemberKey"/>
                                    @elsecan('viewMembers', $company)
                                        {{ $user->getRoleNames()->implode(', ') }}
                                    @endcan
                                </div>

                                <div class="flex items-center">
                                    @can('deleteMember', [$company, $user])
                                        @php
                                            $removeMemberKey = $user->id . 'rm';
                                        @endphp
                                        <livewire:company.remove-member :user="$user" :key="$removeMemberKey"/>
                                    @endcan
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </x-slot>
        </x-action-section>
    </div>
    @can('viewMemberInvitations', $company)
        <x-section-border/>
        <livewire:company.add-member :company="$company"/>
    @endcan
</div>