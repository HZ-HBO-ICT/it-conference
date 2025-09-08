<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Create a new sponsorship') }}
        </h2>
    </div>
    <div class="py-5">
        <form action="{{route('moderator.sponsorships.store')}}" method="POST">
            @csrf
            <x-waitt.action-section>
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
                            <x-waitt.label for="company" value="{{ __('Company') }}"/>
                            <div
                                class="relative z-0 mt-1">
                                <select id="company" name="company_id"
                                        class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block">
                                    @foreach ($companies as $index => $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-span-6 lg:col-span-4 py-2">
                            <x-waitt.label for="sponsorship" value="{{ __('Sponsor tier') }}"/>
                            <div
                                class="relative z-0 mt-1">
                                <select id="sponsorship" name="sponsorship_id"
                                        class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block">
                                    @foreach ($tiers as $tier)
                                        <option value="{{$tier->id}}">{{ucfirst($tier->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </x-slot>

                <x-slot name="actions">
                    <x-waitt.button variant="save">
                        Save
                    </x-waitt.button>
                </x-slot>
            </x-waitt.action-section>
        </form>
    </div>
</x-crew-colorful-layout>
