@php use Illuminate\Support\Facades\Auth; @endphp
<x-action-section>
    <x-slot name="title">
        {{ __('Delete Account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete your account.') }}
    </x-slot>

    <x-slot name="content">
        @can('delete', Auth::user())
            <div class="max-w-xl text-sm text-gray-200 bg-white/5 dark:bg-white/10 backdrop-blur-md rounded-2xl p-6 mb-4">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </div>

            <div class="mt-5">
                <button wire:click="confirmUserDeletion" wire:loading.attr="disabled" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md shadow">
                    {{ __('Delete Account') }}
                </button>
            </div>
        @else
            <div class="max-w-xl text-sm text-gray-200 bg-white/5 dark:bg-white/10 backdrop-blur-md rounded-2xl p-6 mb-4">
                If you wish to not be present during the conference contact us at <a href="mailto:info@weareinittogether.nl" class="text-purple-400 underline">info@weareinittogether.nl</a>
            </div>
        @endif

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Delete Account') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}

                <div class="mt-4" x-data="{}"
                     x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4"
                             autocomplete="current-password"
                             placeholder="{{ __('Password') }}"
                             x-ref="password"
                             wire:model.defer="password"
                             wire:keydown.enter="deleteUser"/>

                    <x-input-error for="password" class="mt-2"/>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <button class="ml-3 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md shadow" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
