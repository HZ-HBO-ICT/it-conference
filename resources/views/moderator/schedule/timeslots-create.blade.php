<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
                Create timeslots
            </h2>
        </x-slot>

        <div>
            <form method="POST" action="{{route('moderator.schedule.timeslots.store')}}">
                @csrf
                <div class="max-w-7xl mx-auto py-5 mt-12 sm:px-6 lg:px-8 dark:bg-gray-800 bg-gray-200 rounded">
                    <p class="text-md text-gray-900 dark:text-white">
                        In order to use the autofill option for the schedule, you need to provide information for the
                        starting and ending time of the conference.<br>Please note that by starting and ending time of the
                        conference is meant the starting hour of the first presentation and the ending time of the last
                        presentation - not including openings/closings.
                    </p>
                    <p class="text-md text-gray-900 dark:text-white underline pt-3">Note: There is going to be 10 minutes between the slots so that the
                                                  participants have time to switch rooms</p>
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
                    <hr>
                    <h3 class="text-lg text-gray-900 dark:text-white pt-5">Lunch break</h3>
                    <div class="col-span-6 sm:col-span-4 pt-5">
                        <x-label for="breakStart" value="Starting time of lunch break (default is 12:30)"/>
                        <x-input id="breakStart" name="breakStart" type="time" value="{{old('breakStart')}}"
                                 class="mt-1 block w-full"/>
                        <x-input-error for="breakStart" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 py-4">
                        <x-label for="breakEnd" value="Ending time of lunch break (default is 13:00)"/>
                        <x-input id="breakEnd" name="breakEnd" type="time" value="{{old('breakEnd')}}"
                                 class="mt-1 block w-full"/>
                        <x-input-error for="breakEnd" class="mt-2"/>
                    </div>
                    <x-button
                        class="mt-5 dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                        Save
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
