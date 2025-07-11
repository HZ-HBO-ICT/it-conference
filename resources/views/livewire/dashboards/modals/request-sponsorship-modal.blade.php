<x-waitt.modal form-action="requestSponsorship" wire:key="sponsorship-request">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Sponsorship Request
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="grid grid-cols-1 gap-6">
            <div class="relative border border-gray-700 rounded-lg p-6 space-y-4">
                <span class="absolute -top-3 left-3 px-2 py-0.5 text-xs font-semibold uppercase tracking-wide
                             bg-gray-900 text-gray-400 rounded">
                    Sponsorship Info
                </span>

                <div class="text-sm text-gray-400">
                    If you choose to sponsor the conference, there are various tiers available,
                    each offering distinct benefits.
                    Check out
                    <a class="text-teal-500 underline" href="/files/sponsor-packages.pdf" target="_blank">
                        this link
                    </a>
                    for more detailed information.
                </div>

                <div class="text-sm text-gray-400">
                    If you're interested in sponsoring, please select a tier and we'll reach out to you for further discussions.
                </div>

                <div class="w-full">
                    @if(!$this->requestSent && !is_null($chosenTierName))
                        <div>
                            <x-waitt.label for="tier" value="Sponsor Tier" />
                            <select id="tier" wire:model="chosenTierName"
                                    class="mt-1 block w-full bg-gray-900 border border-gray-700 text-gray-200 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500">
                                @foreach ($tiers as $tier)
                                    @if($tier->areMoreSponsorsAllowed())
                                        <option wire:key="tier-{{ $tier->id }}" value="{{ $tier->name }}">
                                            {{ ucfirst($tier->name) }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    @else
                        @if($company->sponsorship_approval_status == \App\Enums\ApprovalStatus::APPROVED->value)
                            <div class="mt-4 text-green-400 text-sm">
                                You are approved and confirmed as a <strong>{{ ucfirst($company->sponsorship->name) }}</strong> sponsor!
                            </div>
                        @elseif(is_null($chosenTierName))
                            <div class="mt-4 text-red-400 text-sm">
                                There is no more space for sponsors.
                            </div>
                        @else
                            <div class="mt-4 text-amber-400 text-sm">
                                Your <strong>{{ ucfirst($company->sponsorship->name) }}</strong> sponsorship request is still in review. We'll contact you soon.
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="buttons">
        <x-waitt.button type="button" wire:click="cancel">Cancel</x-waitt.button>
        @if(!$this->requestSent && !is_null($chosenTierName))
            <x-waitt.button type="submit">
                {{ __('Send request') }}
            </x-waitt.button>
        @endif
    </x-slot>
</x-waitt.modal>

