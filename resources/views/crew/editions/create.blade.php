<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a new edition') }}
        </h2>
        <div class="pt-5">
            <x-action-section>
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
                                <x-label for="name" value="Name" class="after:content-['*'] after:text-red-500"/>
                                <x-input
                                    id="name"
                                    name="name"
                                    value="We are in IT together Conference {{ date('Y') + 1 }}"
                                    type="text"
                                    class="mt-1 block w-full"
                                />
                                <x-input-error for="name" class="mt-2"/>
                            </div>
                            <div class="col-span-6 sm:col-span-4 pb-4">
                                <x-label for="start_at" value="Start Date" class="after:content-['*'] after:text-red-500"/>
                                <input
                                    type="datetime-local"
                                    id="start_at"
                                    name="start_at"
                                    max="{{ old('end_at') }}"
                                    value="{{ old('start_at') }}"
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block"
                                />
                                <x-input-error for="start_at" class="mt-2"/>
                            </div>
                            <div class="col-span-6 sm:col-span-4 pb-4">
                                <x-label for="end_at" value="End Date" class="after:content-['*'] after:text-red-500"/>
                                <input
                                    type="datetime-local"
                                    id="end_at"
                                    name="end_at"
                                    min="{{ old('start_at') }}"
                                    value="{{ old('end_at') }}"
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block"
                                />
                                <x-input-error for="end_at" class="mt-2"/>
                            </div>
                            <div class="col-span-6 sm:col-span-4 pb-4">
                                <x-label for="lecture_duration" value="Lecture Duration"/>
                                <x-input type="number"
                                         id="lecture_duration"
                                         name="lecture_duration"
                                         value="30"
                                         min="1"
                                         class="mt-1 block w-full"
                                />
                                <x-input-error for="lecture_duration" class="mt-2"/>
                            </div>
                            <div class="col-span-6 sm:col-span-4 pb-4">
                                <x-label for="workshop_duration" value="Workshop Duration"/>
                                <x-input type="number"
                                         id="workshop_duration"
                                         name="workshop_duration"
                                         value="90"
                                         min="1"
                                         class="mt-1 block w-full"
                                />
                                <x-input-error for="workshop_duration" class="mt-2"/>
                            </div>
                            <x-button
                                class="mt-5 dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-purple-600 active:dark:bg-purple-600">
                                Submit
                            </x-button>
                        </form>
                    </div>
                </x-slot>
            </x-action-section>
        </div>
    </div>
</x-hub-layout>

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
