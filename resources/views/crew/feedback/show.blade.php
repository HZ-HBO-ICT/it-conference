<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Feedback Details') }}
        </h2>
        <div class="pt-5">
            <x-action-section>
                <x-slot name="title">
                    {{ __('Feedback Information') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('The details regarding the feedback received.') }}
                </x-slot>

                <x-slot name="content">
                    <x-details-list-item label="Title">
                        {{ $feedback->title }}
                    </x-details-list-item>
                    <x-details-list-item label="Title">
                        {{ optional($feedback->reportedBy)->name }}
                    </x-details-list-item>
                    <x-details-list-item label="Content">
                        <x-markdown-viewer :content="$feedback->content"/>
                    </x-details-list-item>
                </x-slot>

            </x-action-section>
        </div>

    </div>
</x-hub-layout>
