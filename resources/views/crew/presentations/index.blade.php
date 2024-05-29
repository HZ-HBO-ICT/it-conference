<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Presentations') }}
        </h2>
        <div class="pt-5">
            <x-list-section>
                <x-slot name="actions">
                    <x-button-link href="{{route('moderator.presentations.create')}}">
                        {{ __('Create a new presentation') }}
                    </x-button-link>
                </x-slot>
                <x-slot name="content">
                    <ul role="list">
                        @forelse($presentations as $index => $presentation)
                            <x-list-section-item class="{{ !$presentation->is_approved ? 'bg-crew-300 bg-opacity-30 dark:bg-opacity-20' : '' }} border-l-4 {{ !$presentation->is_approved ? 'border-crew-300 dark:border-crew-600' : 'border-transparent' }}">
                                <a href="{{route('moderator.presentations.show', $presentation)}}" class="block">
                                    <div class="justify-between flex mt-2">
                                        <div class="flex">
                                            <div class="text-gray-700 dark:text-white text-m items-center flex">
                                                <svg
                                                    class="shrink-0 w-6 h-6 mr-1.5 block stroke-crew-400 {{ !$presentation->is_approved ? 'stroke-gray-900 dark:stroke-white' : 'stroke-crew-300' }}"
                                                    xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none"
                                                    aria-hidden="true">
                                                    <path
                                                        d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"></path>
                                                </svg>
                                                <div class="ml-2 flex-grow">
                                                    <strong>{{$presentation->name}}</strong>
                                                    <br/>
                                                    <span
                                                        class="text-sm text-gray-500">{{ $presentation->speakernames }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-sm items-center flex ml-2 dark:text-white">
                                            <svg
                                                class="shrink-0 w-6 h-6 mr-1.5 block stroke-crew-400 {{ !$presentation->is_approved ? 'stroke-gray-900 dark:stroke-white' : '' }}"
                                                xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{$presentation->created_at->format('d/m/Y')}}
                                        </div>
                                    </div>
                                </a>
                            </x-list-section-item>
                        @empty
                            <p class="text-crew-400 text-lg justify-center flex m-12">There are currently no new
                                                                                      presentations waiting on
                                                                                      approval.</p>
                        @endforelse
                    </ul>
                    <div class="pt-2">
                        {{ $presentations->links() }}
                    </div>
                </x-slot>
            </x-list-section>
        </div>
    </div>
</x-hub-layout>
