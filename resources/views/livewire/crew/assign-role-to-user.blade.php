<x-livewire-modal form-action="save" wire:key="{{$role->id}}">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Assign user as {{ucfirst($role->name)}}
    </x-slot>

    <x-slot name="description" class="dark:bg-gray-800">
        {{ __('Here you can edit the room details.') }}
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div>
            <x-label for="name" class="after:content-['*'] after:text-red-500"
                     value="{{ __('Choose user') }}"></x-label>
            <div>
                <input
                    class="w-full border-apricot-peach-300 dark:border-apricot-peach-700 dark:bg-gray-900 dark:text-gray-300 focus:border-apricot-peach-500 dark:focus:border-apricot-peach-600 focus:ring-apricot-peach-500 dark:focus:ring-apricot-peach-600 rounded-md shadow-sm mt-1 block"
                    type="text" maxlength="255" wire:focus="toggleDropdown"
                    wire:model.live="searchValue">
                <div class="{{$isDropdownVisible ? 'block' : 'hidden'}} max-h-48 overflow-auto bg-white">
                    <ul>
                        @forelse($users as $user)
                            <li wire:click="selectUser({{$user->id}})" wire:key="{{$role->id}}-{{$user->id}}"
                                class="hover:cursor-pointer w-full" onclick="event.stopPropagation()">
                                <div
                                    class="bg-white hover:bg-gray-100 dark:bg-gray-800 shadow rounded-md p-2 flex items-center space-x-3">
                                    <img class="h-8 w-8 rounded-full flex-shrink-0" src="{{ $user->profile_photo_url }}"
                                         alt="{{ $user->name }}">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="py-2">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-100 truncate">No results
                                                                                                         found.</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
            @if($selectedUser && !$isDropdownVisible)
                <span
                    class="text-sm">The user already has the following roles: {{ $selectedUser->allRoles->implode(',') }}</span>
            @endif
        </div>
    </x-slot>
    <x-slot name="buttons" class="dark:bg-gray-900">
        <x-secondary-button type="button" wire:click="$dispatch('closeModal')" class="mr-3">
            {{ __('Cancel') }}
        </x-secondary-button>
        <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            Save
        </button>
    </x-slot>
</x-livewire-modal>
