<x-hub-layout>
    <!-- Rework: Every overview page per type can be made from one component -->
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Presentations') }}
        </h1>
        <div class="pt-5">
            <h2 class="text-2xl text-gray-700 dark:text-white">Overview of all the presentations awaiting approval</h2>

            <div class="px-8 py-6 max-w-7xl mx-auto">
                <div class="max-w-none mx-auto">
                    <div class="rounded-lg bg-white dark:bg-slate-700 overflow-hidden">
                        <div class="px-6 py-5 bg-white dark:bg-slate-700 border-b dark:border-gray-500">
                            <div class="flex-nowrap justify-between items-center flex -mt-2 -ml-4">
                                <div class="mt-2 ml-4">
                                    <h3 class="text-gray-900 dark:text-white leading-6 font-semibold text-base">All presentations</h3>
                                </div>
                            </div>
                        </div>
                        <ul role="list">
                            @forelse($presentations as $index => $presentation)
                                <li>
                                    <a href="{{route('moderator.presentations.show', $presentation)}}" class="block">
                                        <div
                                            class="px-6 py-6 {{ !$presentation->is_approved ? 'bg-red-300 dark:bg-red-800' : '' }} hover:bg-crew-100 dark:hover:bg-slate-600">
                                            <div class="justify-between flex mt-2">
                                                <div class="flex">
                                                    <div class="text-gray-700 dark:text-white text-m items-center flex">
                                                        <svg class="shrink-0 w-6 h-6 mr-1.5 block stroke-crew-400"
                                                             xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23"
                                                             fill="none" aria-hidden="true">
                                                            <path
                                                                d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"></path>
                                                        </svg>
                                                        <div class="ml-2 flex-grow">
                                                            <strong>{{$presentation->name}}</strong>
                                                            <br/>
                                                            <span class="text-sm text-gray-500">{{ $presentation->speakernames }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-sm items-center flex ml-2 dark:text-white">
                                                    <svg class="shrink-0 w-6 h-6 mr-1.5 block stroke-crew-400"
                                                         xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23"
                                                         fill="none"
                                                         aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{$presentation->created_at->format('d/m/Y')}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <p class="text-crew-400 text-lg justify-center flex m-12">There are currently no new
                                                                                          presentations waiting on
                                                                                          approval.</p>
                            @endforelse
                        </ul>
                        <div class="pt-2">
                            {{ $presentations->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-hub-layout>
