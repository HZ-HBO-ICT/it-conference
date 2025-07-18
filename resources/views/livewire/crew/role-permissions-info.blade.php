<x-waitt.modal wire:key="ri-{{$role->id}}">
    <x-slot name="title">
        Permissions for the {{ $role->name }} role
    </x-slot>

    <x-slot name="content">
        @if(!empty($permissionsForRole))
            <div class="space-y-4 overflow-auto max-h-[65vh]">
                @foreach($permissionsForRole as $entity => $actions)
                    <div class="bg-gray-900 border border-teal-600 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-300">
                            {{ ucfirst($entity) }}
                        </h3>
                        <ul class="list-disc ml-6 mt-2 text-gray-400">
                            @foreach($actions as $action)
                                <li>{{ ucfirst($action) }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No permissions assigned.</p>
        @endif
    </x-slot>

    <x-slot name="buttons">
        <x-waitt.button wire:click="$dispatch('closeModal')" class="mt-4">
            {{ __('Close') }}
        </x-waitt.button>
    </x-slot>
</x-waitt.modal>
