@php
    use App\Models\Edition
@endphp

<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editions') }}
        </h2>
        <div class="pt-5">
            <x-list-section>
                <x-slot name="actions">
                    <button
                        class="flex items-center justify-center p-3 text-sm font-semibold text-white bg-apricot-peach-400 rounded-md hover:bg-apricot-peach-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-apricot-peach-400"
                        id="editButton">
                        <span>{{ __('Manage Editions') }}</span>
                    </button>
                    <a
                        class="flex ml-3 items-center justify-center p-3 text-sm font-semibold text-white bg-apricot-peach-400 rounded-md hover:bg-apricot-peach-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-apricot-peach-400"
                        href="{{ route('moderator.editions.create') }}">
                        <span>{{ __('Create new edition') }}</span>
                    </a>
                    @if(Edition::current())
                        <button
                            class="flex ml-3 items-center justify-center p-3 text-sm font-semibold text-white bg-apricot-peach-400 rounded-md hover:bg-apricot-peach-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-apricot-peach-400"
                            onclick="Livewire.dispatch('openModal', { component: 'edition.add-keynote-modal', arguments: { edition: {{ Edition::current() }} } })">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <span>
                                @if(Edition::current()->keynote_name)
                                    {{ __('Edit keynote speaker') }}
                                @else
                                    {{ __('Add keynote speaker') }}
                                @endif
                            </span>
                        </button>
                    @endif
                </x-slot>
                <x-slot name="content">
                    @forelse($editions as $edition)
                        <x-list-section-item
                            class="border-transparent hover:bg-gray-100 border-l-4">
                            <a href="{{ route('moderator.events.index', $edition) }}" class="block w-full">
                                <div class="flex justify-between mt-2">
                                    <div class="flex">
                                        <div class="text-gray-700 dark:text-white text-m items-center flex">
                                            <svg
                                                class="shrink-0 w-6 h-6 mr-1.5 block stroke-apricot-peach-400"
                                                xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none"
                                                aria-hidden="true">
                                                <path
                                                    d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />                                                </svg>
                                            <div class="ml-2 flex-grow">
                                                <div class="flex gap-4 items-center">
                                                    <strong>{{ $edition->name }}</strong>
                                                    @if (Edition::current() && Edition::current()->id == $edition->id)
                                                        <div
                                                            class="px-3 py-1 border rounded-full border-emerald-400 border-dashed text-xs font-montserrat text-emerald-400 tracking-wider">
                                                            ACTIVE
                                                        </div>
                                                    @endif
                                                </div>
                                                <span
                                                    class="text-sm text-gray-500">
                                                        {{ $edition->displayed_state }}
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-sm items-center flex gap-8 ml-2 dark:text-white">
                                        <div class="flex items-center min-w-max">
                                            <svg
                                                class="shrink-0 w-6 h-6 mr-1.5 block stroke-apricot-peach-400"
                                                xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <div class="flex">
                                                @if (!$edition->start_at || !$edition->end_at)
                                                    TBD
                                                @else
                                                    {{ $edition->start_at->format('d-m-Y H:i') }}
                                                    —
                                                    {{ $edition->end_at->format('d-m-Y H:i') }}
                                                @endif
                                            </div>
                                        </div>

                                        <div class="managementButtons hidden flex gap-2">
                                            <x-button-link onclick="Livewire.dispatch('openModal', { component: 'edition.edit-edition-modal', arguments: { edition: {{ $edition }} } })">
                                                Edit
                                            </x-button-link>

                                            <x-button onclick="Livewire.dispatch('openModal', { component: 'edition.delete-edition-modal', arguments: { edition: {{ $edition }}} })">
                                                Delete
                                            </x-button>

                                            @if((!Edition::current() || Edition::current()->id != $edition->id) && $edition->configured())
                                                <x-button onclick="Livewire.dispatch('openModal', { component: 'edition.activate-edition-modal', arguments: { edition: {{ $edition }}} })">
                                                    Activate
                                                </x-button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </x-list-section-item>
                    @empty
                        <p class="text-apricot-peach-400 text-lg justify-center flex m-12">
                            There are currently no editions
                        </p>
                    @endforelse
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
