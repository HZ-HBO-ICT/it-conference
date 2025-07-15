<x-waitt.modal form-action="delete" wire:key="dm-{{$member->id}}">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Delete {{$isInvitation ? 'invitation' : 'company member'}}?
    </x-slot>

    <x-slot name="content" class="w-full text-gray-200">
        <div class="flex items-start gap-3 rounded-xl bg-red-50 p-4 border border-red-200 text-red-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="h-6 w-6 flex-shrink-0 text-red-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
            </svg>

            <div class="text-sm leading-relaxed">
                @if ($isInvitation)
                   You are about to delete the invitation to <span class="font-medium">{{ $member->email }}</span>.
                @else
                    You are about to remove <span class="font-medium">{{ $member->name }}</span> from the company. This means that all items related to them will be removed as well.
                @endif
            </div>
        </div>

    </x-slot>
    <x-slot name="buttons">
        <div>
            @can('update', $member->company)
                <x-waitt.button type="button" wire:click="cancel">Cancel</x-waitt.button>
                <x-waitt.button type="submit" variant="delete">Delete</x-waitt.button>
            @endcan
        </div>
    </x-slot>
</x-waitt.modal>
