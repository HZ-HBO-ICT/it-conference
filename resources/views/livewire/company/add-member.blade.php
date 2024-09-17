<!-- Add Team Member -->
<div class="mt-10 sm:mt-0">
    @can('createMemberInvitation', $company)
        <x-form-section submit="invite">
            <x-slot name="title">
                Invite company member
            </x-slot>

            <x-slot name="description">
                Add a new member to your company to represent {{$company->name}} during the IT Conference.
                Please provide the email address of the person you wish to invite and choose their role
            </x-slot>

            <x-slot name="form">
                <!-- Member Email -->
                <div class="col-span-7 sm:col-span-4">
                    <x-label for="email" class="after:content-['*'] after:text-red-500" value="{{ __('Email') }}"/>
                    <x-input id="email" type="email" class="mt-1 block w-full"
                             wire:model.defer="email"/>
                    <x-input-error for="email" class="mt-2"/>
                </div>
                <div class="col-span-7 lg:col-span-4">
                    <x-label class="after:content-['*'] after:text-red-500" for="role" value="{{ __('Role') }}"/>
                    <x-input-error for="currentRole" class="mt-2"/>
                    <div class="relative z-0 mt-1 border border-gray-200 dark:border-gray-700 rounded-lg">
                        @foreach ($this->roles as $role => $description)
                            <button type="button" wire:key="$role" wire:click="selectRole('{{$role}}')"
                                    class="relative px-4 py-3 inline-flex w-full rounded-lg focus:z-10 focus:outline-none focus:border-partner-500 dark:focus:border-partner-600 focus:ring-2 focus:ring-partner-500 dark:focus:ring-partner-600 transition duration-150 ease-in-out
                       {{ $loop->first ? 'border-t rounded-t-lg' : '' }}
                       {{ ! $loop->last ? 'border-b' : 'rounded-b-lg' }}
                       {{ $currentRole == $role ? 'bg-partner-100 dark:bg-partner-800' : 'bg-white dark:bg-gray-800' }}">
                                <div class="text-left">
                                    <!-- Role Name -->
                                    <div class="flex items-center">
                                        <div
                                            class="text-sm text-gray-600 dark:text-gray-300 {{ $currentRole == $role ? 'font-semibold text-partner-700 dark:text-partner-300' : '' }}">
                                            {{ ucfirst($role) }}
                                        </div>
                                    </div>
                                    <!-- Role Description -->
                                    <div class="mt-1 text-xs text-gray-500 dark:text-gray-300">
                                        {{ $description }}
                                    </div>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>
            </x-slot>

            <x-slot name="actions">
                @if (session()->has('message'))
                    <div class="text-base text-green-900 opacity-60 pr-5 text-sm">
                        {{ __('The member was invited.') }}
                    </div>
                @endif

                <x-button type="submit">
                    {{ __('Invite member') }}
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
