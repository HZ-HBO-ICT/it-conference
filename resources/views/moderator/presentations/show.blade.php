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
                <a href="{{route('presentations.edit', $presentation)}}"
                   class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Edit
                </a>
                    @endif
            </div>
        </div>
    </x-details-panel>
</x-hub-layout>
