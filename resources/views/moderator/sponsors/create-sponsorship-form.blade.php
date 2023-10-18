<div class="py-8 px-8 mx-auto max-w-7xl">
    <x-form-section submit="addSponsorship">
        <x-slot name="title">
            Add sponsorship
        </x-slot>

        <x-slot name="description">
            Select a company that is going to be a sponsor of the conference
        </x-slot>

        <x-slot name="form">
            <!-- Tiers -->
            <div class="col-span-6 sm:col-span-4">
                <div class="col-span-6 lg:col-span-4">
                    <x-label for="tier" value="{{ __('Companies') }}"/>
                    <div
                        class="relative z-0 mt-1 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer">
                        <select id="teams" wire:model="teamId"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                            @foreach ($teams as $index => $team)
                                <option value="{{$team->id}}">{{$team->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-span-6 lg:col-span-4 py-2">
                    <x-label for="tier" value="{{ __('Sponsor tier') }}"/>
                    <div
                        class="relative z-0 mt-1 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer">
                        <select id="tiers" wire:model="tierId"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                            @foreach ($tiers as $tier)
                                <option value="{{$tier->id}}">{{ucfirst($tier->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-button
                class="bg-purple-600 dark:bg-purple-500 hover:bg-purple-500 dark:hover:bg-purple-600 text-gray-200 dark:text-gray-200">
                {{ __('Add') }}
            </x-button>
        </x-slot>
    </x-form-section>
</div>
