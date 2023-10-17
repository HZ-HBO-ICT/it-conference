@php use Illuminate\Support\Facades\Auth; @endphp

<x-action-section>
    <x-slot name="title">
        {{ __('Delete This Presentation') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently remove the presentation from the system') }}
    </x-slot>

    <x-slot name="content">
        <div class="dark:text-gray-200">
            @if(Auth::user()->hasRole('content moderator'))
                {{ __('If you delete this presentation, the speaker/s will no longer have this presentation, it will be gone
                from the schedule and all participants that have registered for it will be dis-enrolled from it') }}
            @else
                {{ __('Your presentation is still not approved and you can still remove your presentation') }}
            @endif
        </div>
        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingDeletion">
            <x-slot name="title">
                {{ __('Delete Presentation') }}
            </x-slot>

            <x-slot name="content">
                <h3 class="font-bold text-red-600">{{ __('WARNING: this action cannot be undone') }}</h3>
                {{ __('Are you sure you want to delete this presentation?') }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <form method="POST"
                      action="{{ Auth::user()->hasRole('content moderator')
                                ? route('moderator.presentations.destroy', $presentation)
                                : route('presentations.destroy', $presentation)}}"
                      class="pl-2">
                    @csrf
                    @method('DELETE')
                    <x-danger-button class="ml-3" type="submit">
                        {{ __('Delete Presentation') }}
                    </x-danger-button>
                </form>
            </x-slot>
        </x-dialog-modal>
    </x-slot>

    <x-slot name="actions">
        <x-danger-button wire:click="confirmDeletion" wire:loading.attr="disabled">
            {{ __('Delete PresentationS') }}
        </x-danger-button>
    </x-slot>

</x-action-section>
