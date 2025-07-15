<x-waitt.modal form-action="requestBooth" wire:key="booth-request">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Booth Request
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="grid grid-cols-1 gap-6">
            <div class="relative border border-gray-700 rounded-lg p-6 space-y-4">
                <span class="absolute -top-3 left-3 px-2 py-0.5 text-xs font-semibold uppercase tracking-wide
                             bg-gray-900 text-gray-400 rounded">
                    Booth Details
                </span>

                <div class="text-sm text-gray-300 dark:text-gray-400">
                    Signing up for our company market will, after confirmation, grant a standard 8m<sup>2</sup> booth.
                    Choosing the gold sponsor package gives you a 12m<sup>2</sup> booth.
                    Both booth types include a standing table and electricity. You may also bring your own banner.
                    Floorplans will be provided no later than two weeks before the conference.
                </div>

                <div class="text-sm text-gray-300 dark:text-gray-400">
                    If you require any additional materials or have specific preferences, please let us know.
                    We'll do our best to accommodate them.
                </div>

                <div class="w-full">
                    @if(!$this->requestSent)
                        <x-waitt.label for="additionalInformation" value="Additional Information"/>
                        <textarea id="additionalInformation"
                                  wire:model="additionalInformation"
                                  maxlength="255"
                                  class="mt-1 block w-full bg-gray-900 border border-gray-700 text-gray-200 text-sm rounded-lg shadow-xs focus:ring-teal-500 focus:border-teal-500">
                        </textarea>
                        <x-input-error for="additionalInformation" class="mt-2"/>
                    @else
                        @if($company->booth->is_approved)
                            <div class="mt-4 text-green-600 dark:text-green-400 text-sm">
                                The booth for your company is approved! If you have any questions or concerns, do not
                                hesitate to contact us!
                            </div>
                        @else
                            <div class="mt-4 text-amber-500 dark:text-amber-400 text-sm">
                                Your booth request is still under review. We’ll contact you once it is approved.
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="buttons">
        <x-waitt.button type="button" wire:click="cancel">Cancel</x-waitt.button>
        @if(!$this->requestSent)
            <x-waitt.button type="submit" variant="save">
                {{ __('Send request') }}
            </x-waitt.button>
        @endif
        @if($joinBoothOwners)
            <x-waitt.button type="button" class="border-waitt-yellow text-waitt-yellow-500" wire:click="joinBooth">
                Join the other booth owners
            </x-waitt.button>
        @endif
    </x-slot>
</x-waitt.modal>
