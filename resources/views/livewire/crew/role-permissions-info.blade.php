<x-livewire-modal wire:key="ri-{{$role->id}}">
    <x-slot name="title">
        Permissions for the {{ $role->name }} role
    </x-slot>

    <x-slot name="content">
        @if(!empty($permissionsForRole))
            <div class="space-y-4 overflow-auto max-h-[70vh]">
                @foreach($permissionsForRole as $entity => $actions)
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                            {{ ucfirst($entity) }}
                        </h3>
                        <ul class="list-disc ml-6 mt-2 text-gray-600 dark:text-gray-400">
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
        <x-secondary-button wire:click="$dispatch('closeModal')" class="mt-4">
            {{ __('Close') }}
        </x-secondary-button>
    </x-slot>
</x-livewire-modal>
