@php
    use App\Models\Edition
@endphp

<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Editions') }}
        </h2>

        @can('create', \App\Models\Room::class)
            <x-waitt.button-link href="{{ route('moderator.editions.create') }}">
                {{ __('Create a new edition') }}
            </x-waitt.button-link>
        @endcan
    </div>

    <div class="pt-5">
        <x-waitt.list-section>
            <x-slot name="content">
                <table class="w-full divide-gray-200 dark:divide-gray-700 text-left">
                    <thead class="bg-white/5 rounded">
                    <tr>
                        <th class="rounded-tl-md px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-300">
                            Edition
                        </th>
                        <th class="rounded-tl-md px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-300">
                            Date
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-700/10">
                    @forelse($editions as $edition)
                        <tr class="hover:cursor-pointer hover:bg-white/5 transition-all"
                            onclick="window.location='{{ route('moderator.editions.show', $edition) }}'">
                            <td class="px-4 py-4 whitespace-nowrap text-gray-700 dark:text-white">
                                <div class="text-gray-100 text-m items-center flex">
                                    <svg
                                        class="shrink-0 w-6 h-6 mr-1.5 block stroke-waitt-pink"
                                        xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none"
                                        aria-hidden="true">
                                        <path
                                            d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776"/>
                                    </svg>
                                    <div class="ml-2 grow">
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
                                            class="text-sm text-gray-200">
                                                {{ $edition->displayed_state }}
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-200">
                                <div class="flex items-center min-w-max">
                                    <svg
                                        class="shrink-0 w-6 h-6 mr-1.5 block stroke-waitt-pink"
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
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center text-gray-500 dark:text-gray-300">
                                There are currently no editions.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </x-slot>
        </x-waitt.list-section>
    </div>
</x-crew-colorful-layout>
