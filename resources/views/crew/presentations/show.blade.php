<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Presentation details') }}
        </h2>
        <div class="pt-5">
            <x-action-section>
                <x-slot name="title">
                    {{ __('Presentation Information') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('All characteristics of the presentation and its details') }}
                </x-slot>

                <x-slot name="content">
                    <x-details-list-item label="Presentation title">
                        {{ $presentation->name }}
                    </x-details-list-item>
                    <x-details-list-item label="Presentation description">
                        {{ $presentation->description }}
                    </x-details-list-item>
                    <x-details-list-item label="Presentation type">
                        {{ $presentation->type }}
                    </x-details-list-item>
                    <x-details-list-item label="Difficulty">
                        <div
                            class="text-yellow-500 flex transititext-primary text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
                            data-te-toggle="tooltip"
                            title="{{ $presentation->difficulty->level }}"
                        >
                            @for($i = 0; $i < $presentation->difficulty->id; $i++)
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                                </svg>
                            @endfor
                        </div>
                    </x-details-list-item>
                    <x-details-list-item label="Presentation max participants">
                        {{ $presentation->max_participants }}
                    </x-details-list-item>
                </x-slot>

                @can('update', $presentation)
                    <x-slot name="actions">
                        <x-button
                            onclick="Livewire.dispatch('openModal', { component: 'presentation.edit-presentation-modal', arguments: {presentation: {{$presentation}}} })">
                            {{ __('Edit') }}
                        </x-button>
                    </x-slot>
                @endcan
            </x-action-section>

            @can('viewRequest', $presentation)
                <x-section-border/>

                <x-action-section>
                    <x-slot name="title">
                        {{ __('Approval Status') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('When the status is Approved, the presentation and speaker will show up at the lineup.') }}
                    </x-slot>

                    <x-slot name="content">
                        <div
                            class="mt-1 text-sm leading-6 text-{{ $presentation->is_approved ? 'green-500' : 'yellow-500' }} sm:col-span-2 sm:mt-0">
                            {{ $presentation->is_approved ? 'Approved' : 'Awaiting approval' }}
                        </div>
                    </x-slot>

                    @can('approve', $presentation)
                        @if(!$presentation->is_approved)
                            <x-slot name="actions">
                                <form method="POST"
                                      action="{{ route('moderator.presentations.approve', $presentation) }}"
                                      class="mr-2">
                                    @csrf
                                    <input type="hidden" name="approved" value="1"/>
                                    <x-button
                                        class="dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                                        {{ __('Approve') }}
                                    </x-button>
                                </form>
                                <form method="POST"
                                      action="{{ route('moderator.presentations.approve', $presentation) }}"
                                      class="mr-2">
                                    @csrf
                                    <input type="hidden" name="approved" value="0"/>
                                    <x-button
                                        class="dark:bg-red-500 bg-red-500 hover:bg-red-600 hover:dark:bg-red-600 active:bg-red-600 active:dark:bg-red-600">
                                        {{ __('Reject') }}
                                    </x-button>
                                </form>
                            </x-slot>
                        @endif
                    @endcan
                </x-action-section>
            @endcan

            <x-section-border/>

            <x-action-section>
                <x-slot name="title">
                    {{ __('Participants') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('List of people who signed up for the presentation.') }}
                </x-slot>

                <x-slot name="content">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <ul>
                            @forelse($presentation->participants as $participant)
                                <li class="py-2">{{$participant->name}} ({{$participant->email}})</li>
                            @empty
                                <li>There are no participants that have registered just yet.</li>
                            @endforelse
                        </ul>
                    </div>
                </x-slot>

            </x-action-section>

            @can('delete', $presentation)
                <x-section-border/>
                <x-danger-button
                    onclick="Livewire.dispatch('openModal', { component: 'presentation.delete-presentation-modal', arguments: {presentation: {{$presentation}}} })">
                    {{ __('Delete Presentation') }}
                </x-danger-button>
            @endcan
        </div>
    </div>
</x-hub-layout>
