<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Companies') }}
        </h2>
        <div class="pt-5">
            <x-list-section>

                <x-slot name="actions">
                    <x-button-link href="{{route('moderator.companies.create')}}">
                        {{ __('Invite a company') }}
                    </x-button-link>

                    {{--<x-button-link href="{{route('teams.create')}}" class="ml-2">
                        {{__('Create a company')}}
                    </x-button-link>--}}
                </x-slot>

                <x-slot name="content">
                        @forelse($companies as $index => $company)
                            <x-list-section-item class="{{ !$company->is_approved ? 'bg-red-300 dark:bg-red-800' : '' }}"
                                :url="route('moderator.companies.show', $company)">
                                <div class="justify-between flex my-0.5">
                                    <div class="flex">
                                        <div class="text-gray-700 dark:text-white text-m items-center flex">
                                            @if($company->logo_path)
                                                <img class="w-6 h-6 mx-auto my-auto max-w-full block dark:text-white"
                                                     src="{{ url('storage/'. $company->logo_path) }}" alt="Logo of {{$company->name}}">
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5"
                                                     stroke="gray" aria-hidden="true" class="w-6 h-6 stroke-crew-400 {{ !$company->is_approved ? 'stroke-crew-900 dark:stroke-crew-900 hover:stroke-crew-500' : '' }}">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                                                </svg>
                                            @endif
                                            <div class="ml-2 flex-grow">
                                                <strong>{{$company->name}}</strong>
                                                <br/>
                                                <span class="text-sm text-gray-500">{{ $company->speakernames }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-sm items-center flex ml-2 dark:text-white">
                                        <svg class="shrink-0 w-6 h-6 mr-1.5 block stroke-crew-400 {{ !$company->is_approved ? 'stroke-crew-900 dark:stroke-crew-900 hover:stroke-crew-500' : '' }}" xlmns="http://www.w3.org/2000/svg" viewbox="0 0 23 23" fill="none" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{$company->created_at->format('d/m/Y')}}
                                    </div>
                                </div>
                            </x-list-section-item>
                        @empty
                            <p class="text-crew-400 text-lg justify-center flex m-12">There are currently no new presentations waiting on approval.</p>
                        @endforelse

                    <div class="pt-2">
                        {{ $companies->links() }}
                    </div>

                </x-slot>

            </x-list-section>
        </div>
    </div>
</x-hub-layout>