<x-waitt.livewire-modal form-action="save">
    <x-slot name="title">
        Add already registered participant to {{$company->name}}
    </x-slot>

    <x-slot name="description">
        {{ __('Here you can add the participant to the company.') }}
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div>
            <x-waitt.label for="name" class="after:content-['*'] after:text-red-500"
                     value="{{ __('Choose user') }}"></x-waitt.label>
            <div>
                <input
                    class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                    type="text" maxlength="255" wire:focus="toggleDropdown"
                    wire:model.live="searchValue">
                <div class="{{$isDropdownVisible ? 'block' : 'hidden'}} max-h-48 overflow-auto bg-gray-900">
                    <ul>
                        @forelse($users as $user)
                            <li wire:click="selectUser({{$user->id}})" wire:key="{{$user->id}}"
                                class="hover:cursor-pointer w-full" onclick="event.stopPropagation()">
                                <div
                                    class="bg-gray-800 shadow-sm rounded-md p-2 flex items-center space-x-3">
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
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-100 truncate">No results
                                                                                                         found.</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div>
            @if($canAssignRole)
                <x-waitt.label for="company_role" class="after:content-['*'] after:text-red-500"
                         value="{{ __('Select company role') }}"></x-waitt.label>
                <x-select wire:model="assignedRole" name="company_role" class="mt-1 block w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs">
                    <option selected value="company member">Company member</option>
                    <option value="pending speaker">Speaker</option>
                    <option value="pending booth owner">Booth owner</option>
                </x-select>
            @elseif($selectedUser)
                <p class="text-sm font-medium text-apricot-peach-500 dark:text-apricot-peach-200 text-wrap truncate">The user already has presentation associated with them, therefore their role is automatically determined as <b>speaker</b></p>
            @endif
        </div>
    </x-slot>
    <x-slot name="buttons" class="dark:bg-gray-900">
        <x-waitt.button type="button" wire:click="$dispatch('closeModal')" class="mr-3">
            {{ __('Cancel') }}
        </x-waitt.button>
        <button type="submit" {{$selectedUser ?? 'disabled'}}
                class="border-teal-600 text-teal-600 inline-flex items-center px-5 py-2 border 0 rounded-md font-medium text-xs hover:bg-gray-700 uppercase tracking-widest hover:cursor-pointer active:bg-gray-900 transition ease-in-out duration-150">
            Save
        </button>
    </x-slot>
</x-waitt.livewire-modal>
