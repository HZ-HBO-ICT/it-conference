<div class="mt-10 sm:mt-0">
    <x-form-section submit="requestSponsorship">
        <x-slot name="title">
            Sponsorship request
        </x-slot>

        <x-slot name="description">
            If you decide to become a sponsor of the conference, there are different tiers that you can choose of with
            different privileges. Check out <a class="dark:text-gray-400 underline" href="/files/sponsor-packages.pdf">this
                                                                                                                       link</a>
            for more detailed information.
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6">
                <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    If you want to be a sponsor, choose a tier and we will be soon in touch with you to discuss further.
                </div>
            </div>

            <!-- Tiers -->
            <div class="col-span-6 sm:col-span-4">
                @if(!$this->requestSent && !is_null($chosenTierName))
                    <div class="col-span-6 lg:col-span-4">
                        <x-label for="tier" value="{{ __('Sponsor tier') }}"/>
                        <div
                            class="relative z-0 mt-1 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer">
                            <select id="cars" wire:model="chosenTierName"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                @foreach ($tiers as $tier)
                                    @if($tier->areMoreSponsorsAllowed())
                                        <option value="{{$tier->name}}">{{ucfirst($tier->name)}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if($chosenTierName)
                        <div class="pt-2 text-gray-900 dark:text-gray-400 text-sm">
                            Available spots: {{$tiers->firstWhere('name', $chosenTierName)->leftSpots()}}
                        </div>
                    @endif
                @else
                    @if($this->team->is_sponsor_approved)
                        <div class="row">
                            <div class="mt-4 text-green-600 dark:text-green-400 py-2 text-left rounded">
                                You are approved and confirmed as a {{ucfirst($this->team->sponsorTier->name)}} sponsor!
                            </div>
                        </div>
                    @elseif(is_null($chosenTierName))
                        There is no more space for sponsors
                    @else
                        <div class="row">
                            <div class="mt-4 text-amber-500 dark:text-amber-400 py-2 text-left rounded">
                                The request for your {{ucfirst($this->team->sponsorTier->name)}} sponsorship is still in review and not yet approved. We will be in contact with you soon.
                            </div>
                        </div>
                    @endif
                @endif
                @if (session()->has('success'))
                    <div class="row">
                        <div class="mt-4 text-green-600 dark:text-green-400 py-2 text-left rounded">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
            </div>
        </x-slot>

        <x-slot name="actions">
            @if(!$this->requestSent && !is_null($chosenTierName))
                <x-button>
                    {{ __('Send request') }}
                </x-button>
            @endif
        </x-slot>
    </x-form-section>
</div>
