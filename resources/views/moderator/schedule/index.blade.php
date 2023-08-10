<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            Schedule management
        </h1>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            General overview
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-5 mt-12 sm:px-6 lg:px-8 dark:bg-gray-800 bg-gray-200 rounded">
            <div class="grid grid-cols-6 gap-4">
                <a href="{{route('moderator.schedule.draft')}}" style="grid-column: span 2;"
                   class="bg-red-500 text-white py-2 px-4 rounded block text-center">
                    <span class="flex items-center h-full justify-center">Current schedule</span>
                </a>
                <a href="{{route('moderator.requests', 'presentations')}}"
                   style="grid-column: span 2;"
                   class="bg-blue-500 text-white py-2 px-4 rounded block text-center">
                    {{$numberOfPresentationRequest}}<br>Presentations that are<br>waiting for approval
                </a>
                <a href=""
                   style="grid-column: span 2;"
                   class="bg-green-500 text-white py-2 px-4 rounded block text-center">
                    {{$numberOfUnscheduledPresentations}}<br>Presentations that are<br>waiting to be scheduled
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
