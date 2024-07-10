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
                                class="border-transparent hover:bg-gray-100 border-l-4">
                                <div class="block">
                                    <div class="justify-between flex mt-2">
                                        <div class="flex">
                                            <div class="text-gray-700 dark:text-white text-m items-center flex">
                                                <svg
                                                    class="shrink-0 w-6 h-6 mr-1.5 block stroke-apricot-peach-400"
                                                    xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none"
                                                    aria-hidden="true">
                                                    <path
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />                                                </svg>
                                                <div class="ml-2 flex-grow">
                                                    <strong>{{ $event->event->name }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-sm items-center flex gap-8 ml-2 dark:text-white">
                                            <div class="flex items-center">
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
