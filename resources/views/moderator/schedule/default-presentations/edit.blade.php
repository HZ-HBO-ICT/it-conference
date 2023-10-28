<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit {{$event}} for the conference
        </h1>
        <div class="pt-5">
            <div
                class="mt-5 gap-6 text-gray-900 dark:text-gray-200 px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-md">
                <div class="pt-1 p-2">
                    <div class="pr-5">
                        <p class="text-md text-gray-900 dark:text-white">
                            @if($event == 'opening')
                                Create the opening presentation. You can add more details about the opening presentation.
                            @elseif($event == 'closing')
                                Create the closing presentation. You can add more details about the closing presentation.
                            @endif
                        </p>
                        @if($event == 'opening')
                            @livewire('default-presentations.edit-default-presentation-form',
                            ['presentation' => \App\Models\DefaultPresentation::opening()])
                        @elseif($event == 'closing')
                            @livewire('default-presentations.edit-default-presentation-form',
                            ['presentation' => \App\Models\DefaultPresentation::closing()])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-hub-layout>
