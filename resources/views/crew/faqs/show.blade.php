<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Company details') }}
        </h2>
    </div>
    <div class="py-5">
        <x-waitt.action-section>
            <x-slot name="title">
                {{ __('FAQ Information') }}
            </x-slot>

            <x-slot name="description">
                {{ __('The details regarding the FAQ. Note: the viewer allows you to see how the FAQ will be rendered to the public. It may be a bit different than the one in the initial preview.') }}
            </x-slot>


            <x-slot name="content">
                <x-waitt.details-list-item label="Question">
                    {{ $faq->question }}
                </x-waitt.details-list-item>
                <x-waitt.details-list-item label="Answer">
                    <x-markdown-viewer :content="$faq->answer"/>
                </x-waitt.details-list-item>
            </x-slot>

            @can('update', \App\Models\Room::class)
                <x-slot name="actions">
                    <x-waitt.button
                        variant="edit"
                        onclick="Livewire.dispatch('openModal', { component: 'frequent-questions.edit-frequent-question-modal', arguments: {faq: {{$faq}}} })">
                        {{ __('Edit details') }}
                    </x-waitt.button>
                </x-slot>
            @endcan
        </x-waitt.action-section>
    </div>

    <x-section-border/>

    @can('delete', $faq)
        <x-waitt.action-section>
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
        </x-waitt.action-section>
    @endcan
</x-crew-colorful-layout>
