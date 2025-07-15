<x-waitt.modal form-action="invite">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Invite company member
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="relative md:col-span-2 border border-gray-700 rounded-lg p-6 space-y-4 w-full">
                <span
                    class="absolute -top-3 left-3 px-2 py-0.5 text-xs font-semibold uppercase tracking-wide
                           bg-gray-900 text-gray-400 rounded">
                    Details
                </span>
            <div class="col-span-7 sm:col-span-4">
                <x-waitt.label for="email" class="after:content-['*'] after:text-red-500" value="{{ __('Email') }}"/>
                <x-waitt.input id="email" type="email" class="mt-1 block w-full"
                         wire:model.defer="email"/>
                <x-input-error for="email" class="mt-2"/>
            </div>
            <div class="col-span-7 lg:col-span-4">
                <x-waitt.label class="after:content-['*'] after:text-red-500" for="role" value="{{ __('Role') }}"/>
                <x-input-error for="currentRole" class="mt-2"/>
                <div class="relative z-0 mt-1 rounded-lg">
                    @foreach ($this->roles as $role => $description)
                        <button type="button" wire:key="$role" wire:click="selectRole('{{$role}}')"
                                class="relative px-4 py-3 inline-flex w-full rounded-lg hover:cursor-pointer focus:z-10 focus:outline-hidden focus:border-teal-600 focus:ring-2 focus:ring-teal-600 transition duration-150 ease-in-out
                       {{ $loop->first ? 'border-t rounded-t-lg border-gray-700' : '' }}
                       {{ ! $loop->last ? 'border-b border-gray-700' : 'rounded-b-lg border-gray-700' }}
                       {{ $currentRole == $role ? 'bg-gray-700' : 'bg-gray-800' }}">
                            <div class="text-left">
                                <div class="flex items-center">
                                    <div
                                        class="text-sm text-gray-300 {{ $currentRole == $role ? 'font-semibold text-teal-600' : '' }}">
                                        {{ ucfirst($role) }}
                                    </div>
                                </div>
                                <div class="mt-1 text-xs text-gray-400">
                                    {{ $description }}
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="buttons">
        <div >
            @can('update', $company)
                <x-waitt.button type="button" wire:click="cancel">Cancel</x-waitt.button>
                <x-waitt.button type="submit" variant="save">Save</x-waitt.button>
            @endcan
        </div>
    </x-slot>
</x-waitt.modal>
