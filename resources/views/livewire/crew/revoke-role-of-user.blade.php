<x-livewire-modal form-action="confirm" wire:key="rr-{{$role->id}}-{{$user->name}}">
    <x-slot name="title">
        Revoke the {{$role->name}} role from {{$user->name}}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to remove the role from this user?') }}
    </x-slot>

    <x-slot name="buttons">
        <x-secondary-button wire:click="$dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-danger-button class="ml-3" type="submit">
            {{ __('Remove role') }}
        </x-danger-button>
    </x-slot>
</x-livewire-modal>
