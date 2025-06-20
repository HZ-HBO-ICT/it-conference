<div class="bg-black/[var(--bg-opacity)] [--bg-opacity:70%] w-full h-full rounded rounded-lg text-white">
    <div class="font-semibold text-sm p-5 flex justify-between items-center">
        <div>
            <p class="text-lg">Company members</p>
            <p>
                {{ $this->totalMembers() }} Members in total –
                <span class="text-green-300">{{ $this->company->users->count() }} confirmed</span>,
                <span class="text-yellow-300">{{ $this->company->invitations->count() }} awaiting</span>
            </p>
        </div>
        <div>
            <button class="text-sm text-white opacity-80 hover:opacity-100 hover:cursor-pointer py-2 px-4 bg-black rounded rounded-lg">Invite a member</button>
        </div>
    </div>

    <div class="w-full px-5 text-sm font-light">
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
                    $isInvitation = filter_var($member->name, FILTER_VALIDATE_EMAIL);
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
                    <td class="py-4"><a class="text-red-500 underline">Remove</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $members->links('components.pagination.waitt') }}
    </div>
</div>
