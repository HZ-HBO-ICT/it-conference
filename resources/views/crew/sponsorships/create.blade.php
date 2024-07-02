<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a new sponsorship') }}
        </h2>
        <div class="pt-5">
            <form action="{{route('moderator.sponsorships.store')}}" method="POST">
                @csrf
                <x-action-section>
                    <x-slot name="title">
                        Add sponsorship
                    </x-slot>

                    <x-slot name="description">
                        Select a company that is going to be a sponsor of the conference and the tier
                    </x-slot>

                    <x-slot name="content">
                        <!-- Tiers -->
                        <div class="col-span-6 sm:col-span-4">
                            <div class="col-span-6 lg:col-span-4">
                                <x-label for="company" value="{{ __('Companies') }}"/>
                                <div
                                    class="relative z-0 mt-1 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer">
                                    <select id="company" name="company_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                        @foreach ($companies as $index => $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-6 lg:col-span-4 py-2">
                                <x-label for="sponsorship" value="{{ __('Sponsor tier') }}"/>
                                <div
                                    class="relative z-0 mt-1 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer">
                                    <select id="sponsorship" name="sponsorship_id"
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
                            class="mt-5 dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                            Save
                        </x-button>
                    </x-slot>
                </x-action-section>
            </form>
        </div>
    </div>
</x-hub-layout>
