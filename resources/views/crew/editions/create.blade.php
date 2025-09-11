<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Create an edition') }}
        </h2>
    </div>
    <div class="py-5">
        <x-waitt.action-section>
            <x-slot name="title">
                {{ __('Edition details') }}
            </x-slot>

            <x-slot name="description">
                <div class="text-sm text-gray-600 dark:text-gray-200">
                    <p>{{ __('Manually add a new edition.') }}</p>
                </div>
            </x-slot>

            <x-slot name="content">
                <div class="pr-5">
                    <form method="POST" action="{{ route('moderator.editions.store') }}">
                        @csrf
                        <div class="col-span-6 sm:col-span-4 pb-4">
                            <x-waitt.label for="name" value="Name" class="after:content-['*'] after:text-red-500"/>
                            <x-waitt.input
                                id="name"
                                name="name"
                                value="We are in IT together Conference {{ date('Y') }}"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <x-input-error for="name" class="mt-2"/>
                        </div>
                        <div class="col-span-6 sm:col-span-4 pb-4">
                            <x-waitt.label for="start_at" value="Starting time of the event"
                                     class="after:content-['*'] after:text-red-500"/>
                            <x-waitt.input
                                type="datetime-local"
                                id="start_at"
                                name="start_at"
                                max="{{ old('end_at') }}"
                                value="{{ old('start_at') }}"
                                class="w-full rounded-md shadow-xs mt-1 block"
                            />
                            <x-input-error for="start_at" class="mt-2"/>
                        </div>
                        <div class="col-span-6 sm:col-span-4 pb-4">
                            <x-waitt.label for="end_at" value="End time of the event"
                                     class="after:content-['*'] after:text-red-500"/>
                            <x-waitt.input
                                type="datetime-local"
                                id="end_at"
                                name="end_at"
                                min="{{ old('start_at') }}"
                                value="{{ old('end_at') }}"
                                class="w-full rounded-md shadow-xs mt-1 block"
                            />
                            <x-input-error for="end_at" class="mt-2"/>
                        </div>
                        <x-waitt.button
                            variant="save"
                        >
                            Submit
                        </x-waitt.button>
                    </form>
                </div>
            </x-slot>
        </x-waitt.action-section>
    </div>
</x-crew-colorful-layout>

<script>
    const startAt = document.getElementById('start_at');
    const endAt = document.getElementById('end_at');

    startAt.addEventListener('change', (event) => {
        endAt.min = event.target.value;
    });

    endAt.addEventListener('change', (event) => {
        startAt.max = event.target.value;
    });
</script>
