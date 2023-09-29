<x-hub-layout>
    <x-details-panel>
        <x-slot:title>
            Presentation details
        </x-slot:title>

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
        <x-details-list-item label="Presentation status"
                             :color="$presentation->is_approved ? 'green-500' : 'yellow-500'">
            {{ $presentation->is_approved ? 'Approved' : 'Awaiting approval' }}
        </x-details-list-item>
        <div class="pt-5">
            <div class="flex justify-end">
                @if(!$presentation->is_approved)
                <form method="POST" action="{{ route('moderator.presentations.approve', $presentation) }}" class="mr-2">
                    @csrf
                    <input type="hidden" name="approved" value="1"/>
                    <x-button
                        class="dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                        Approve
                    </x-button>
                </form>
                <form method="POST" action="{{ route('moderator.presentations.approve', $presentation) }}" class="mr-2">
                    @csrf
                    <input type="hidden" name="approved" value="0"/>
                    <x-button
                        class="dark:bg-red-500 bg-red-500 hover:bg-red-600 hover:dark:bg-red-600 active:bg-red-600 active:dark:bg-red-600">
                        Reject
                    </x-button>
                </form>
                @else
                <a href="{{route('moderator.presentations.edit', $presentation)}}"
                   class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Edit
                </a>
                    @endif
            </div>
        </div>
    </x-details-panel>
</x-hub-layout>
