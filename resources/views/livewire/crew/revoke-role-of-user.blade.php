<x-waitt.livewire-modal form-action="confirm" wire:key="rr-{{$role->id}}-{{$user->name}}">
    <x-slot name="title">
        Revoke the {{$role->name}} role from {{$user->name}}
    </x-slot>

    <x-slot name="content">
        <div class="text-white">
            {{ __('Are you sure you want to remove the role from this user?') }}
        </div>
    </x-slot>

    <x-slot name="buttons">
        <x-waitt.button wire:click="$dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-waitt.button>
        <x-waitt.button variant="delete" class="ml-3" type="submit">
            {{ __('Remove role') }}
        </x-waitt.button>
    </x-slot>
</x-waitt.livewire-modal>
