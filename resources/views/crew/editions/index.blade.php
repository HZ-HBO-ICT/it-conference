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
                    <x-button-link href="{{ route('moderator.editions.create') }}">
                        {{ __('Create new edition') }}
                    </x-button-link>
                </x-slot>
                <x-slot name="content">
                    @forelse($editions as $edition)
                        <x-list-section-item
                            class="border-transparent hover:bg-gray-100 border-l-4">
                            <a href="{{ route('moderator.editions.show', $edition) }}" class="block w-full">
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