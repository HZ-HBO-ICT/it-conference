@php
    use App\Models\Edition;
    use App\Models\PresentationType;
@endphp

<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edition details') }}
        </h2>
        <p class="pt-5">
            <x-action-section>
                <x-slot name="title">
                    {{ __('Edition Information') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('All characteristics of the edition and its dates') }}
                </x-slot>

                <x-slot name="content">
                    <x-details-list-item label="Edition title">
                        {{ $edition->name }}
                    </x-details-list-item>
                    <x-details-list-item label="Edition Date">
                        @if (!$edition->start_at || !$edition->end_at)
                            TBD
                        @else
                            {{ $edition->start_at->format('d-m-Y H:i') }}
                            —
                            {{ $edition->end_at->format('d-m-Y H:i') }}
                        @endif
                    </x-details-list-item>
                    <x-details-list-item label="Edition Lecture Duration">
                        {{ $edition->lecture_duration }}
                    </x-details-list-item>
                    <x-details-list-item label="Edition Workshop Duration">
                        {{ $edition->workshop_duration }}
                    </x-details-list-item>
                </x-slot>

                @can('update', $edition)
                    <x-slot name="actions">
                        <x-button
                            onclick="Livewire.dispatch('openModal', { component: 'edition.edit-edition-modal', arguments: { edition: {{ $edition }} } })">
                            {{ __('Edit') }}
                        </x-button>
                    </x-slot>
                @endcan
            </x-action-section>

            <x-section-border/>
            @can('viewAny', PresentationType::class)
                <x-action-section>
                    <x-slot name="title">
                        {{ __('Presentation Types') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('All possible presentation types for this edition can be modified here.') }}
                    </x-slot>

                    <x-slot name="content">
                        @foreach($edition->presentationTypes as $presentationType)
                            <div
                                class="border-transparent rounded-lg hover:cursor-pointer hover:bg-gray-100 shadow-sm rounded-lg my-4"
                                @can('update', $presentationType)
                                    onclick="Livewire.dispatch('openModal', { component: 'presentation-type.create-edit-modal', arguments: { editionId: {{ $edition->id }}, presentationTypeId: {{ $presentationType->id }} } })"
                                @endcan>
                                <div class="px-4 py-6 flex justify-between">
                                    <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">{{ $presentationType->name }}</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                        <div class="flex">
                                            <svg
                                                class="shrink-0 w-6 h-6 mr-1.5 block stroke-apricot-peach-400"
                                                xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{$presentationType->duration}} minutes
                                        </div>
                                    </dd>
                                </div>
                            </div>
                        @endforeach
                    </x-slot>
                    <x-slot name="actions">
                        <x-button class="hover:cursor-pointer"
                                  onclick="Livewire.dispatch('openModal', { component: 'presentation-type.create-edit-modal', arguments: { editionId: {{ $edition->id }} }})"
                        >
                            {{ __('Add') }}
                        </x-button>
                    </x-slot>
                </x-action-section>

                <x-section-border/>
            @endcan

            @can('update', $edition)
                <x-action-section>
                    <x-slot name="title">
                        {{ __('Edition Events Information') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('All events that are happening during the edition and their dates. Click on the event to edit it. You can find the explanation of each event below:') }}

                        <br><br>

                        @foreach($events as $event)
                            {{ $event->event->name }} — {{ $event->event->description }}
                            <br><br>
                        @endforeach
                    </x-slot>

                    <x-slot name="content">
                        @foreach($events as $event)
                            <div
                                class="border-transparent rounded-lg hover:cursor-pointer hover:bg-gray-100 shadow-sm rounded-lg my-4"
                                onclick="Livewire.dispatch('openModal', { component: 'edition-event.edit-edition-event-modal', arguments: { edition: {{ $edition }}, editionEvent: {{ $event }} } })">
                                <div class="px-4 py-6 flex justify-between">
                                    <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">{{ $event->event->name }}</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                        <div class="flex">
                                            <svg
                                                class="shrink-0 w-6 h-6 mr-1.5 block stroke-apricot-peach-400"
                                                xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            @if (!$event->start_at || !$event->end_at)
                                                TBD
                                            @else
                                                {{ $event->start_at->format('d-m-Y') }}
                                                —
                                                {{ $event->end_at->format('d-m-Y') }}
                                            @endif
                                        </div>
                                    </dd>
                                </div>
                            </div>
                        @endforeach
                    </x-slot>
                </x-action-section>

                @if($edition->id == optional(Edition::current())->id)
                    <x-section-border/>

                    <x-action-section>
                        <x-slot name="title">
                            {{ __('Edition Keynote Speaker') }}
                        </x-slot>

                        <x-slot name="description">
                            {{ __('Details about the keynote speaker of the edition.') }}
                        </x-slot>

                        @if($edition->keynote_configured)
                            <x-slot name="content">
                                <x-details-list-item label="Keynote Speaker Name">
                                    {{ $edition->keynote_name }}
                                </x-details-list-item>
                                <x-details-list-item label="Keynote Speaker Description">
                                    {{ $edition->keynote_description }}
                                </x-details-list-item>
                                <x-details-list-item label="Keynote Speaker Photo">
                                    <img src="{{ url('storage/' . $edition->keynote_photo_path) }}"
                                         alt="{{ $edition->keynote_name }}"
                                         class="rounded-full h-20 w-20 object-cover">
                                </x-details-list-item>
                            </x-slot>

                            <x-slot name="actions">
                                <x-button
                                    onclick="Livewire.dispatch('openModal', { component: 'edition.add-keynote-modal', arguments: { edition: {{ $edition }} } })">
                                    Edit
                                </x-button>
                            </x-slot>
                        @else
                            <x-slot name="actions">
                                <x-button
                                    onclick="Livewire.dispatch('openModal', { component: 'edition.add-keynote-modal', arguments: { edition: {{ $edition }} } })">
                                    Add keynote speaker
                                </x-button>
                            </x-slot>
                        @endif
                    </x-action-section>
                @endif
            @endcan

            <x-section-border/>

            <x-action-section>
                <x-slot name="title">
                    {{ __('Activation') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('When the edition is activated, you will be able to add a keynote speaker here, access companies, presentations, sponsorships etc.
                            In order to activate the edition, you should set all dates for all events that are happening during the edition.') }}
                </x-slot>

                <x-slot name="content">
                    <div
                        class="mt-1 text-sm leading-6 text-{{ $edition->id == optional(Edition::current())->id ? 'green-500' : 'yellow-500' }} sm:col-span-2 sm:mt-0">
                        @if($edition->id == optional(Edition::current())->id)
                            Activated
                        @elseif($edition->configured)
                            Awaiting activation
                        @else
                            Edition is not configured yet
                        @endif
                    </div>
                </x-slot>

                @can('activate', $edition)
                    @if((!Edition::current() || Edition::current()->id != $edition->id) && $edition->configured)
                        <x-slot name="actions">
                            <x-button
                                onclick="Livewire.dispatch('openModal', { component: 'edition.activate-edition-modal', arguments: { edition: {{ $edition }}} })"
                                class="dark:bg-green-500 bg-green-500 hover:bg-green-600 dark:hover:bg-green-600 active:bg-green-600 dark:active:bg-green-600">
                                {{ __('Activate') }}
                            </x-button>
                        </x-slot>
                    @endif
                @endcan
            </x-action-section>

            <x-section-border/>

            @can('delete', $edition)
                <x-action-section>
                    <x-slot name="title">
                        {{ __('Delete Edition') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Delete the edition if it is not needed anymore.') }}
                    </x-slot>
                    <x-slot name="actions">
                        <x-danger-button
                            onclick="Livewire.dispatch('openModal', { component: 'edition.delete-edition-modal', arguments: { edition: {{ $edition }}} })">
                            {{ __('Delete Edition') }}
                        </x-danger-button>
                    </x-slot>
                </x-action-section>
        @endcan
    </div>
    </div>
</x-hub-layout>
