<div>
    <div class="text-center md:text-left text-gray-100 w-full pb-5">
        <h2 class="text-3xl pt-5 font-semibold">Register</h2>
        <h3 class="text-2xl">Company Internship Opportunities</h3>
        <h5 class="text-gray-300 text-sm">Although providing these details is not mandatory, it is highly recommended as it will make it easier for students to engage with you.</h5>
    </div>
    <div>
        <form wire:submit="goNext" @submit.prevent>
            @csrf
            @if ($errors->any())
                <div class="text-red-500">
                    Oops! There are some issues with the details.
                </div>
            @endif
            <div>
                <div class="my-2">
                    <x-waitt.label for="internshipYear" value="{{ __('Internship Year') }}"
                    />
                    <div class="block mt-1">
                        <label class="pr-3 text-gray-200">
                            <x-waitt.input class="mb-1" type="checkbox" name="internshipYear" value="Third year"
                                     wire:model="internshipYear"/>
                            Third year
                        </label>
                        <label class="text-gray-200">
                            <x-waitt.input class="mb-1" type="checkbox" name="internshipYear" value="Fourth year"
                                     wire:model="internshipYear"/>
                            Fourth year
                        </label>
                    </div>
                    <div class="text-red-500 mt-1">@error('internshipYear') {{ $message }} @enderror</div>
                </div>

                <div class="mt-4">
                    <x-waitt.label for="languages" value="{{ __('Language') }}"
                    />
                    <div class="block mt-1">
                        <label class="pr-3 text-gray-200">
                            <x-waitt.input class="mb-1" type="checkbox" name="languages" value="English" wire:model="languages"/>
                            English
                        </label>
                        <label class="text-gray-200">
                            <x-waitt.input class="mb-1" type="checkbox" name="languages" value="Dutch" wire:model="languages"/>
                            Dutch
                        </label>
                    </div>
                    <div class="text-red-500 mt-1">@error('language') {{ $message }} @enderror</div>
                </div>

                <div class="mt-4">
                    <x-waitt.label for="tracks" value="{{ __('Tracks') }}"
                    />
                    <div class="block mt-1">
                        <label class="block mb-2 text-gray-200">
                            <x-waitt.input type="checkbox" name="tracks" value="Software Engineering" wire:model="tracks"/>
                            Software Engineer
                        </label>
                        <label class="block mb-2 text-gray-200">
                            <x-waitt.input type="checkbox" name="tracks" value="Data Scientist" wire:model="tracks"/>
                            Data Scientist
                        </label>
                        <label class="block mb-2 text-gray-200">
                            <x-waitt.input type="checkbox" name="tracks" value="Business IT Consultant" wire:model="tracks"/>
                            Business IT Consultant
                        </label>
                    </div>
                    <div class="text-red-500 mt-1">@error('tracks') {{ $message }} @enderror</div>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <x-waitt.button type="button" wire:click="goBack" class="mb-0.5 mr-4">
                        {{ __('Go back') }}
                    </x-waitt.button>

                    <div class="flex items-center justify-end">
                        <x-waitt.button type="submit"
                                  class="ml-4">
                            {{ __('Next') }}
                        </x-waitt.button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
