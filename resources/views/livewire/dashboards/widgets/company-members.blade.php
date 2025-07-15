<div class="bg-black/[var(--bg-opacity)] [--bg-opacity:70%] w-full h-full rounded rounded-lg text-white">
    <div class="font-semibold text-xs md:text-sm p-5 flex justify-between items-center">
        <div>
            <p class="text-sm md:text-lg">Company members</p>
            <p>
                {{ $this->totalMembers() }} Members in total –
                <span class="text-green-300">{{ $this->company->users->count() }} confirmed</span>,
                <span class="text-yellow-300">{{ $this->company->invitations->count() }} awaiting</span>
            </p>
        </div>
        @can('createMemberInvitation', $company)
            <div>
                <button class="text-xs md:text-sm text-white opacity-80 hover:opacity-100 hover:cursor-pointer py-2 px-4 bg-black rounded rounded-lg "
                        onclick="Livewire.dispatch('openModal', { component: 'dashboards.modals.invite-company-member-modal', arguments: {company: {{$company}}} })"
                >Invite a member</button>
            </div>
        @endcan
    </div>

    <div class="w-full px-5 pb-5 text-sm font-light">
        <div class="hidden md:block">
            <table class="table-fixed w-full">
                <thead class="text-left uppercase text-xs opacity-70">
                <tr>
                    <th class="font-light pb-2">Member</th>
                    <th class="font-light pb-2">Roles</th>
                    <th class="font-light pb-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($members as $member)
                    @php
                        $isInvitation = filter_var($member->name, FILTER_VALIDATE_EMAIL) !== false;
                        $record = $isInvitation ? $this->getInvitation($member->id) : $this->getUser($member->id);
                    @endphp
                    <tr class="border-y">
                        <td class="py-4">
                            @if($isInvitation)
                                {{ $record->email }}
                            @else
                                <div class="flex items-center">
                                    <img class="h-6 w-6 rounded-lg object-cover mr-3"
                                         src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                                    {{ $record->name }}
                                </div>
                            @endif
                        </td>
                        <td class="py-4">
                            @if($isInvitation)
                                {{ ucfirst($record->role) }}
                            @else
                                {{ $record->mainRoles()->implode(', ') }}
                            @endif
                        </td>
                        <td class="py-4">
                            @can('deleteMember', $company)
                                @if($isInvitation || (!$isInvitation && !$record->hasRole('company representative')))
                                    <p class="text-red-500 underline hover:cursor-pointer" onclick="Livewire.dispatch('openModal', { component: 'dashboards.modals.delete-company-member-modal', arguments: { id: {{ $record->id }}, isInvitation: {{ json_encode($isInvitation) }} }})">
                                        Remove
                                    </p>
                                @endif
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $members->links(data: ['scrollTo' => false] ) }}
        </div>
        <div class="sm:hidden space-y-3">
            @foreach($members as $member)
                @php
                    $isInvitation = filter_var($member->name, FILTER_VALIDATE_EMAIL) !== false;
                    $record = $isInvitation ? $this->getInvitation($member->id) : $this->getUser($member->id);
                @endphp
                <div class="border border-slate-950/60 rounded-lg p-3 bg-waitt-dark text-sm">
                    <div class="mb-2 font-medium text-gray-300">
                        @if($isInvitation)
                            {{ $record->email }}
                        @else
                            <div class="flex items-center">
                                <img class="h-6 w-6 rounded-lg object-cover mr-2"
                                     src="{{ Auth::user()->profile_photo_url }}"
                                     alt="{{ Auth::user()->name }}"/>
                                {{ $record->name }}
                            </div>
                        @endif
                    </div>
                    <div class="text-xs text-gray-300 mb-1">
                        <span class="font-semibold">Roles:</span>
                        @if($isInvitation)
                            {{ ucfirst($record->role) }}
                        @else
                            {{ $record->mainRoles()->implode(', ') }}
                        @endif
                    </div>
                    @if($isInvitation || (!$isInvitation && !$record->hasRole('company representative')))
                        <p class="text-red-500 underline hover:cursor-pointer text-xs mt-1"
                           onclick="Livewire.dispatch('openModal', {
                               component: 'dashboards.modals.delete-company-member-modal',
                               arguments: { id: {{ $record->id }}, isInvitation: {{ json_encode($isInvitation) }} }
                           })">
                            Remove
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
