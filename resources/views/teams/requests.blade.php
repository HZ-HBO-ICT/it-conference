<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$team->name}} requests
        </h2>
        <h2 class="text-md text-gray-800 dark:text-gray-200 leading-tight pt-3">
            Here you can request to become a sponsor or request to have a booth
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('booth-request', ['team' => $team])
        </div>
    </div>
</x-app-layout>
