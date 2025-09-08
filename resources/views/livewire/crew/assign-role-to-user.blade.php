<x-waitt.modal form-action="save" wire:key="{{$role->id}}">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Assign user as {{ucfirst($role->name)}}
    </x-slot>

    <x-slot name="description" class="dark:bg-gray-800">
        {{ __('Here you can edit the room details.') }}
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div>
            <x-waitt.label for="name" class="after:content-['*'] after:text-red-500"
                     value="{{ __('Choose user') }}"></x-waitt.label>
            <div>
                <input
                    class="w-full border-teal-600 bg-gray-900 text-gray-300 focus:border-teal-500 rounded-md shadow-xs mt-1 block"
                    type="text" maxlength="255" wire:focus="toggleDropdown"
                    wire:model.live="searchValue">
                <div class="{{$isDropdownVisible ? 'block' : 'hidden'}} max-h-48 overflow-auto ">
                    <ul>
                        @forelse($users as $user)
                            <li wire:click="selectUser({{$user->id}})" wire:key="{{$role->id}}-{{$user->id}}"
                                class="hover:cursor-pointer w-full" onclick="event.stopPropagation()">
                                <div
                                    class="bg-waitt-dark hover:bg-slate-800 shadow-sm rounded-md p-2 flex items-center space-x-3">
                                    <img class="h-8 w-8 rounded-full shrink-0" src="{{ $user->profile_photo_url }}"
                                         alt="{{ $user->name }}">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-100 truncate">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-400 truncate">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="py-2">
                                <p class="text-sm font-medium text-gray-100 truncate">No results
                                                                                                         found.</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
            @if($selectedUser && !$isDropdownVisible)
                <span
                    class="text-sm text-yellow-500">The user already has the following roles: {{ $selectedUser->allRoles->implode(',') }}</span>
            @endif
        </div>
    </x-slot>
    <x-slot name="buttons" class="dark:bg-gray-900">
        <x-waitt.button type="button" wire:click="$dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-waitt.button>
        <x-waitt.button type="submit" variant="save">
            Save
        </x-waitt.button>
    </x-slot>
</x-waitt.modal>
