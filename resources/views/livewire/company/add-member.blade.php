<!-- Add Team Member -->
<div class="mt-10 sm:mt-0">
    @can('createMemberInvitation', $company)
        <x-form-section submit="invite">
            <x-slot name="title">
                Invite company member
            </x-slot>

            <x-slot name="description">
                Add a new member to your company to represent {{$company->name}} during the IT Conference. Their role
                will be determined by the actions they select.
            </x-slot>

            <x-slot name="form">
                <div class="col-span-6">
                    <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
                        Please provide the email address and name of the person you would like to add to this team.
                    </div>
                </div>

                <!-- Member Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="email" value="{{ __('Email') }}"/>
                    <x-input id="email" type="email" class="mt-1 block w-full"
                             wire:model.defer="email"/>
                    <x-input-error for="email" class="mt-2"/>
                </div>
            </x-slot>

            <x-slot name="actions">
                <x-action-message class="mr-3" on="invite">
                    {{ __('Added.') }}
                </x-action-message>

                <x-button type="submit">
                    {{ __('Add') }}
                </x-button>
            </x-slot>
        </x-form-section>
        <x-section-border/>
    @endcan

    @can('viewAnyMemberInvitation', $company)
        <!-- Team Member Invitations -->
        <div class="mt-10 sm:mt-0">
            <x-action-section>
                <x-slot name="title">
                    Pending Invitations
                </x-slot>

                <x-slot name="description">
                    These people have been invited to join your team to represent {{$company->name}} during the IT
                    Conference and have been sent an
                    invitation email. They may join the team by accepting the email invitation.
                </x-slot>

                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($company->invitations as $invitation)
                            <div class="flex items-center justify-between">
                                <div class="text-gray-600 dark:text-gray-400">{{ $invitation->email }}</div>

                                @can('deleteMemberInvitation', $company)
                                    <div class="flex items-center">
                                        <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none"
                                                wire:click="cancelInvitation({{ $invitation->id }})"
                                                wire:key="$invitation->id">
                                            {{ __('Cancel') }}
                                        </button>
                                    </div>
                                @endcan
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-action-section>
        </div>
    @endcan
</div>
