<div>
    <x-section-border/>
    <!-- Manage Company Members -->
    <div class="mt-10 sm:mt-0">
        <x-action-section>
            <x-slot name="title">
                {{ __('Company Members') }}
            </x-slot>

            <x-slot name="description">
                All of the people that you have invited to join your team for the IT Conference and have accepted
                the invitation
            </x-slot>

            <!-- Team Member List -->
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
                                        <img class="w-8 h-8 rounded-full object-cover" src="{{ $user->profile_photo_url }}"
                                             alt="{{ $user->name }}">
                                        <div class="ml-4 leading-tight">
                                            <div class="text-gray-900 dark:text-white">{{ $user->name }}</div>
                                        </div>
                                    </div>

                                    @php
                                        $updateMemberKey = $user->id . 'um';
                                    @endphp
                                    <livewire:company.update-member-role :user="$user" :key="$updateMemberKey"/>
                                </div>

                                <div class="flex items-center">
                                    @php
                                        $removeMemberKey = $user->id . 'rm';
                                    @endphp
                                    <livewire:company.remove-member :user="$user" :key="$removeMemberKey"/>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </x-slot>
        </x-action-section>
    </div>
    <x-section-border/>
    <livewire:company.add-member :company="$company"/>

    {{--


        @endif

        @if ($team->teamInvitations->isNotEmpty() && Gate::check('addTeamMember', $team))
            <x-section-border/>

            <!-- Team Member Invitations -->
            <div class="mt-10 sm:mt-0">
                <x-action-section>
                    <x-slot name="title">
                        Pending Invitations
                    </x-slot>

                    <x-slot name="description">
                        These people have been invited to join your team to represent {{$team->name}} during the IT
                        Conference and have been sent an
                        invitation email. They may join the team by accepting the email invitation.
                    </x-slot>

                    <x-slot name="content">
                        <div class="space-y-6">
                            @foreach ($team->teamInvitations as $invitation)
                                <div class="flex items-center justify-between">
                                    <div class="text-gray-600 dark:text-gray-400">{{ $invitation->email }}</div>

                                    <div class="flex items-center">
                                        @if (Gate::check('removeTeamMember', [$team, $invitation]))
                                            <!-- Cancel Team Invitation -->
                                            <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none"
                                                    wire:click="cancelTeamInvitation({{ $invitation->id }})">
                                                {{ __('Cancel') }}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </x-slot>
                </x-action-section>
            </div>
        @endif
    --}}
    <!-- Role Management Modal -->


    {{--
            <!-- Remove Team Member Confirmation Modal -->
        <x-confirmation-modal wire:model="confirmingTeamMemberRemoval">
            <x-slot name="title">
                {{ __('Remove Team Member') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you would like to remove this person from the team?') }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingTeamMemberRemoval')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3" wire:click="removeTeamMember" wire:loading.attr="disabled">
                    {{ __('Remove') }}
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>
    </div>
    --}}
</div>
