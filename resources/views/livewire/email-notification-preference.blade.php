<x-waitt.action-section>
    <x-slot name="title">
        {{ __('Email preferences') }}
    </x-slot>

    <x-slot name="description">
        {{ __("If you would like to stop the reminders and email notifications from us you can do that in this menu") }}
    </x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="save" class="space-y-8 flex">
            <div class="space-y-8 divide-y divide-gray-200 flex-1">
                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-6 text-white">
                        <label>
                            <input {{$receiveEmails ? 'checked' : ''}} class="rounded-sm mr-2 checked:bg-waitt-pink-500"
                                   wire:model="receiveEmails" type="checkbox"> Receive notifications and reminders on email
                        </label>
                    </div>
                </div>
            </div>

            <div class="pt-4 flex justify-between items-center">
                @if (session()->has('message'))
                    <div class="text-sm text-green-600 pr-2">
                        {{ session('message') }}
                    </div>
                @endif
                <x-button>
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
    </x-slot>
</x-waitt.action-section>
