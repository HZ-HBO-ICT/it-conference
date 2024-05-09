<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $edition->name }}
        </h2>
        <div class="pt-5">
            <x-list-section>
                <x-slot name="actions">
                    <x-button id="editButton">
                        {{ __('Manage events') }}
                    </x-button>
                </x-slot>
                <x-slot name="content">
                    <ul role="list">
                        @forelse($events as $event)
                            <x-list-section-item
                                class="">
                                <div class="block">
                                    <div class="justify-between flex mt-2">
                                        <div class="flex">
                                            <div class="text-gray-700 dark:text-white text-m items-center flex">
                                                <svg
                                                    class="shrink-0 w-6 h-6 mr-1.5 block stroke-crew-400"
                                                    xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none"
                                                    aria-hidden="true">
                                                    <path
                                                        d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"></path>
                                                </svg>
                                                <div class="ml-2 flex-grow">
                                                    <strong>{{ $event->event->name }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-sm items-center flex gap-8 ml-2 dark:text-white">
                                            <div class="flex items-center">
                                                <svg
                                                    class="shrink-0 w-6 h-6 mr-1.5 block stroke-crew-400"
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

                                            <div class="managementButtons hidden flex gap-2">
                                                <x-button-link onclick="Livewire.dispatch('openModal', { component: 'edition-event.edit-edition-event-modal', arguments: { edition: {{ $edition }}, editionEvent: {{ $event }} } })">
                                                    Edit
                                                </x-button-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </x-list-section-item>
                        @empty
                            <p class="text-crew-400 text-lg justify-center flex m-12">
                                There are currently no events for {{ $edition->name }}
                            </p>
                        @endforelse
                    </ul>
                </x-slot>
            </x-list-section>
        </div>
    </div>
</x-hub-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const editButton = document.getElementById('editButton');
        const managementButtons = document.getElementsByClassName('managementButtons');

        editButton.addEventListener('click', function () {
            for (const button of managementButtons) {
                if (button.classList.contains('hidden')) {
                    button.classList.remove('hidden');
                } else {
                    button.classList.add('hidden');
                }
            }
        });
    });
</script>
