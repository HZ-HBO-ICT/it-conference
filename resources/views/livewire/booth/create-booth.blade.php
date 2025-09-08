@php
    use App\Models\Company;
    use App\Enums\ApprovalStatus;
@endphp

<form wire:submit="save">
    @csrf
    <x-waitt.action-section>
        <x-slot name="title">
            {{ __('Booth details') }}
        </x-slot>
        <x-slot name="description">
            <div class="space-y-4 text-gray-200 text-sm">
                <p>Add manually the booth for an already registered company.</p>
                <p class="mt-4">Total area sized mentioned in the sponsor packages:</p>
                <ul class="list-disc ml-6">
                    <li>Bronze & Silver - 8 m<sup>2</sup></li>
                    <li>Golden - 12 m<sup>2</sup></li>
                </ul>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="pr-5">
                <div class="col-span-6 sm:col-span-4 ">
                    <x-waitt.label for="company_id" class="after:content-['*'] after:text-red-500"
                                   value="{{ __('Company name') }}"></x-waitt.label>
                    <select wire:model="companyId" name="company_id"
                            class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block">
                        @foreach(Company::whereDoesntHave('booth')
                                    ->hasStatus(ApprovalStatus::APPROVED)->get() as $company)
                            <option value="{{ $company->id }}">
                                {{$company->name}}
                                @if($company->sponsorship)
                                    ({{ucfirst($company->sponsorship->name)}} sponsor)
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('company') <p class="mt-2 text-red-500"> {{$message}} </p> @enderror
                </div>
                <div class="col-span-6 sm:col-span-4 pt-3">
                    <x-waitt.label for="width" class="after:content-['*'] after:text-red-500"
                             value="{{ __('Width') }}"></x-waitt.label>
                    <x-waitt.input wire:model="width" name="width" type="number" step="0.1" min="1"
                             class="mt-1 block w-full"></x-waitt.input>
                    @error('width') <p class="mt-2 text-red-500"> {{$message}} </p> @enderror
                </div>
                <div class="col-span-6 sm:col-span-4 pt-3">
                    <x-waitt.label for="length" class="after:content-['*'] after:text-red-500"
                             value="{{ __('Length') }}"></x-waitt.label>
                    <x-waitt.input wire:model="length" name="length" step="0.1" min="1" type="number"
                             class="mt-1 block w-full"></x-waitt.input>
                    @error('length') <p class="mt-2 text-red-500"> {{$message}} </p> @enderror
                </div>
                <div class="col-span-6 sm:col-span-4 pt-3">
                    <x-waitt.label for="additionalInformation" value="{{ __('Additional information') }}"></x-waitt.label>
                    <x-waitt.input-textarea wire:model="additionalInformation" maxlength="255"
                              class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xs block mt-1 w-full"
                              name="description"
                    ></x-waitt.input-textarea>
                    @error('additionalInformation') <p class="mt-2 text-red-500"> {{$message}} </p> @enderror
                </div>
                <div class="mt-4">
                    <div>
                        <x-waitt.label for="booth_owner" class="after:content-['*'] after:text-red-500"
                                 value="{{ __('Choose company member to become the booth owner') }}"></x-waitt.label>
                        <div>
                            <input
                                class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                                type="text" maxlength="255" wire:focus="toggleDropdown"
                                wire:model.live="searchValue">
                            <div
                                class="{{$isDropdownVisible ? 'block' : 'hidden'}} max-h-48 rounded-sm overflow-auto bg-gray-900">
                                <ul>
                                    @if($users)
                                        @forelse($users as $user)
                                            <li wire:click="selectUser({{$user->id}})" wire:key="{{$user->id}}"
                                                class="hover:cursor-pointer w-full" onclick="event.stopPropagation()">
                                                <div
                                                    class="bg-waitt-dark hover:bg-slate-800 transition-all shadow-sm rounded-md p-2 flex items-center space-x-3">
                                                    <img class="h-8 w-8 rounded-full shrink-0"
                                                         src="{{ $user->profile_photo_url }}"
                                                         alt="{{ $user->name }}">
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-gray-100 truncate">{{ $user->name }}</p>
                                                        <p class="text-xs text-gray-400 truncate">{{ $user->email }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="py-2">
                                                <p class="text-sm font-medium text-gray-700 dark:text-gray-100 truncate">
                                                    No results
                                                    found.</p>
                                            </li>
                                        @endforelse
                                    @endif
                                </ul>
                            </div>
                        </div>
                        @if($selectedUser && !$isDropdownVisible)
                            <span
                                class="text-xs text-crew-400 dark:text-crew-200">The user already has the following roles: {{ $selectedUser->allRoles->implode(',') }}</span>
                        @endif
                        @error('selectedUser') <p class="mt-2 text-red-500"> {{$message}} </p> @enderror
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-button
                type="submit"
                class="dark:bg-green-500 bg-green-500 hover:bg-green-600 dark:hover:bg-green-600 active:bg-green-600 dark:active:bg-green-600">
                Save
            </x-button>
        </x-slot>
    </x-waitt.action-section>
</form>
