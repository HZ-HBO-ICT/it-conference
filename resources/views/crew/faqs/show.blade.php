<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('FAQ Details') }}
        </h2>
        <div class="pt-5">
            <x-action-section>
                <x-slot name="title">
                    {{ __('FAQ Information') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('The details regarding the FAQ. Note: the viewer allows you to see how the FAQ will be rendered to the public. It may be a bit different than the one in the initial preview.') }}
                </x-slot>


                <x-slot name="content">
                    <x-details-list-item label="Question">
                        {{ $faq->question }}
                    </x-details-list-item>
                    <x-details-list-item label="Answer">
                        <x-markdown-viewer :content="$faq->answer"/>
                    </x-details-list-item>
                </x-slot>

                @can('update', \App\Models\Room::class)
                    <x-slot name="actions">
                        <x-button
                            onclick="Livewire.dispatch('openModal', { component: 'frequent-questions.edit-frequent-question-modal', arguments: {faq: {{$faq}}} })">
                            {{ __('Edit details') }}
                        </x-button>
                    </x-slot>
                @endcan
            </x-action-section>
        </div>

        <x-section-border/>

        @can('delete', $faq)
            <x-action-section>
                <x-slot name="title">
                    {{ __('Delete FAQ') }}
                </x-slot>

                <x-slot name="description">
                    You can remove the FAQ
                </x-slot>

                <x-slot name="actions">
                    <x-danger-button
                        onclick="Livewire.dispatch('openModal', { component: 'frequent-questions.delete-frequent-question-modal', arguments: {faq: {{$faq}}} })">
                        {{ __('Delete FAQ') }}
                    </x-danger-button>
                </x-slot>
            </x-action-section>
        @endcan
    </div>
</x-hub-layout>
