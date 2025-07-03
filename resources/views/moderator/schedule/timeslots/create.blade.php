<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Generate timeslots') }}
        </h1>
        <div class="pt-5">
            <div
                class="mt-5 gap-6 text-gray-900 dark:text-gray-200 px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-md">
                <div class="pt-1 p-2">
                    <div class="pr-5">
                        <form method="POST" action="{{route('moderator.schedule.timeslots.store')}}">
                            @csrf
                            <p class="text-md text-gray-900 dark:text-white">
                                In order to start assigning presentations to rooms, you need to provide
                                information for the
                                starting and ending time of the conference.<br>Please note that by starting and
                                ending time of the
                                conference is meant the starting hour of the first presentation and the ending time
                                of the last
                                presentation - <span class="text-sm uppercase text-crew-500">not including openings/closings</span>.
                            </p>
                            <p class="text-md text-gray-900 dark:text-white underline pt-3">Note: There is going to
                                                                                            be 10 minutes
                                                                                            between the slots so
                                                                                            that the
                                                                                            participants have time
                                                                                            to switch
                                                                                            rooms</p>
                            <div class="col-span-6 sm:col-span-4 pt-5">
                                <x-label for="starting" value="Starting time"/>
                                <x-input id="starting" name="starting" type="time" value="{{old('starting')}}"
                                         class="mt-1 block w-full"/>
                                <x-input-error for="starting" class="mt-2"/>
                            </div>
                            <div class="col-span-6 sm:col-span-4 py-4">
                                <x-label for="ending" value="Ending time"/>
                                <x-input id="ending" name="ending" type="time" value="{{old('ending')}}"
                                         class="mt-1 block w-full"/>
                                <x-input-error for="ending" class="mt-2"/>
                            </div>
                            <x-button
                                class="mt-5 dark:bg-crew-500 bg-crew-500 hover:bg-crew-600 dark:hover:bg-crew-600 active:bg-green-600 dark:active:bg-green-600">
                                Generate
                            </x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-hub-layout>
