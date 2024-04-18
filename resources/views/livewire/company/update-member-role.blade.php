<div x-data="{ open: @entangle('isOpen') }" class="w-full h-full">
    <button class="ml-2 text-sm text-gray-400 underline"
            @click="open = true">
        {{ $managingRoleFor->getRoleNames()->implode(', ') }}
    </button>

    <div
        x-cloak
        x-show="open"
        x-transition:enter="transition-opacity ease-out duration-400"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 flex items-center justify-center z-50 bg-opacity-75 bg-gray-900 dark:bg-opacity-75 dark:bg-gray-800 dark:text-gray-200"
    >
        <div class="bg-white p-4 rounded shadow-lg dark:bg-gray-900 text-left">
            <div class="p-5">
                    <x-action-section>
                        <x-slot name="title">
                            {{ __('Company details') }}
                        </x-slot>

                        <x-slot name="description">
                            {{ __('Here you can edit the company details you provided.') }}
                        </x-slot>

                        <x-slot name="content">
                            <div class="col-span-6 sm:col-span-4">
                                @foreach ($this->roles as $index => $role)
                                    <button type="button"
                                            {{is_null($managingRoleFor->company->booth) && $role['name'] == "booth owner" ? 'disabled' : ''}}
                                            class="border border-gray-300 relative px-4 py-3 inline-flex w-full rounded-lg focus:z-10 focus:outline-none focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 {{ $index > 0 ? 'border-t border-gray-200 dark:border-gray-700 focus:border-none rounded-t-none' : '' }} {{ ! $loop->last ? 'rounded-b-none' : '' }}"
                                            wire:click="$set('currentRole', '{{ $role['name'] }}')">
                                        <div
                                            class="{{is_null($managingRoleFor->company->booth) && $role['name'] == "booth owner" ? 'opacity-50' : ''}} {{ $currentRole !== $role['name'] ? 'opacity-50' : '' }}">
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
                                                @if(is_null($managingRoleFor->company->booth) && $role['name'] == "booth owner")
                                                    <br><br>
                                                    * Enabled only if the company gets a booth
                                                @endif
                                            </div>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </x-slot>

                        <x-slot name="actions">
                            @if (session()->has('message'))
                                <div class="text-sm text-green-600 pr-5">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <button type="submit" wire:click="save"
                                    class="inline-flex items-center px-4 mr-2 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Save
                            </button>
                            <button wire:click="close"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Cancel
                            </button>
                        </x-slot>
                    </x-action-section>
            </div>
        </div>
    </div>
</div>
