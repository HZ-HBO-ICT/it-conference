<!-- Add Team Member -->
<div class="mt-10 sm:mt-0">
    <x-form-section submit="invite">
        <x-slot name="title">
            Invite company member
        </x-slot>

        <x-slot name="description">
            Add a new member to your company to represent {{$company->name}} during the IT Conference and choose
            their role
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

            <!-- Role -->
            @if (count($this->roles) > 0)
                <div class="col-span-6 lg:col-span-4">
                    <x-label for="role" value="{{ __('Role') }}"/>
                    <x-input-error for="role" class="mt-2"/>

                    <div
                        class="relative z-0 mt-1 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer">
                        @foreach ($this->roles as $index => $role)
                            <button type="button"
                                    {{is_null($company->booth) && $role['name'] == "booth owner" ? 'disabled' : ''}}
                                    class="border border-gray-300 relative px-4 py-3 inline-flex w-full rounded-lg focus:z-10 focus:outline-none focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 {{ $index > 0 ? 'border-t border-gray-200 dark:border-gray-700 focus:border-none rounded-t-none' : '' }} {{ ! $loop->last ? 'rounded-b-none' : '' }}"
                                    wire:click="$set('currentRole', '{{ $role['name'] }}')">
                                <div
                                    class="{{is_null($company->booth) && $role['name'] == "booth owner" ? 'opacity-50' : ''}} {{ $currentRole !== $role['name'] ? 'opacity-50' : '' }}">
                                    <!-- Role Name -->
                                    <div class="flex items-center">
                                        <div
                                            class="text-sm text-gray-600 dark:text-gray-400 {{ $currentRole == $role['name'] ? 'font-semibold' : '' }}">
                                            {{ ucfirst($role['name']) }}
                                        </div>

                                        @if ($currentRole == $role['name'])
                                            <svg class="ml-2 h-5 w-5 text-green-400"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        @endif
                                    </div>

                                    <!-- Role Description -->
                                    <div class="mt-2 text-xs text-gray-600 dark:text-gray-400 text-left">
                                        {{ $role['description'] }}
                                        @if(is_null($company->booth) && $role['name'] == "booth owner")
                                            <br><br>
                                            * Enabled only if the company gets a booth
                                        @endif
                                    </div>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif
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

                            <div class="flex items-center">
                                <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none"
                                        wire:click="cancelInvitation({{ $invitation->id }})" wire:key="$invitation->id">
                                    {{ __('Cancel') }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-slot>
        </x-action-section>
    </div>
</div>
