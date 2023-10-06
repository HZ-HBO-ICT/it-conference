<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Presentation details') }}
        </h2>
        <div class="pt-5">
            <x-action-section>
                <x-slot name="title">
                    {{ __('Company Information') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('The company\'s name, address and other information that is visible for all users.') }}
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
                        <div class="text-yellow-500 flex transititext-primary text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
                             data-te-toggle="tooltip"
                             title="{{ $presentation->difficulty->level }}"
                        >
                            @for($i = 0; $i < $presentation->difficulty->id; $i++)
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M9.153 5.408C10.42 3.136 11.053 2 12 2c.947 0 1.58 1.136 2.847 3.408l.328.588c.36.646.54.969.82 1.182c.28.213.63.292 1.33.45l.636.144c2.46.557 3.689.835 3.982 1.776c.292.94-.546 1.921-2.223 3.882l-.434.507c-.476.557-.715.836-.822 1.18c-.107.345-.071.717.001 1.46l.066.677c.253 2.617.38 3.925-.386 4.506c-.766.582-1.918.051-4.22-1.009l-.597-.274c-.654-.302-.981-.452-1.328-.452c-.347 0-.674.15-1.329.452l-.595.274c-2.303 1.06-3.455 1.59-4.22 1.01c-.767-.582-.64-1.89-.387-4.507l.066-.676c.072-.744.108-1.116 0-1.46c-.106-.345-.345-.624-.821-1.18l-.434-.508c-1.677-1.96-2.515-2.941-2.223-3.882c.293-.941 1.523-1.22 3.983-1.776l.636-.144c.699-.158 1.048-.237 1.329-.45c.28-.213.46-.536.82-1.182l.328-.588Z"/>
                                </svg>
                            @endfor
                        </div>
                    </x-details-list-item>
                    <x-details-list-item label="Presentation max participants">
                        {{ $presentation->max_participants }}
                    </x-details-list-item>
                </x-slot>

                <x-slot name="actions">
                    {{-- TODO create Edit page or, even better, a LiveWire component --}}
                    <x-button-link href="#">Edit</x-button-link>
                </x-slot>
            </x-action-section>

            <x-section-border/>

            <x-action-section>
                <x-slot name="title">
                    {{ __('Approval Status') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('When the status is Approved, the presentation and speaker will show up at the lineup.') }}
                </x-slot>

                <x-slot name="content">
                    <div class="mt-1 text-sm leading-6 text-{{ $presentation->is_approved ? 'green-500' : 'yellow-500' }} sm:col-span-2 sm:mt-0">
                        {{ $presentation->is_approved ? 'Approved' : 'Awaiting approval' }}
                    </div>
                </x-slot>

                @if(!$presentation->is_approved)
                    <x-slot name="actions">
                        <form method="POST" action="{{ route('moderator.presentations.approve', $presentation) }}" class="mr-2">
                            @csrf
                            <input type="hidden" name="approved" value="1"/>
                            <x-button
                                class="dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                                {{ __('Approve') }}
                            </x-button>
                        </form>
                        <form method="POST" action="{{ route('moderator.presentations.approve', $presentation) }}" class="mr-2">
                            @csrf
                            <input type="hidden" name="approved" value="0"/>
                            <x-button
                                class="dark:bg-red-500 bg-red-500 hover:bg-red-600 hover:dark:bg-red-600 active:bg-red-600 active:dark:bg-red-600">
                                {{ __('Reject') }}
                            </x-button>
                        </form>
                    </x-slot>
                @endif
            </x-action-section>


            <x-section-border/>

            <x-action-section>
                <x-slot name="title">
                    {{ __('Delete This Presentation') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Permanently delete this presentation and related data') }}
                </x-slot>

                <x-slot name="content">
                </x-slot>

                <x-slot name="actions">
                    <x-danger-button>Remove this presentation</x-danger-button>
                </x-slot>
            </x-action-section>
        </div>
    </div>
</x-hub-layout>
