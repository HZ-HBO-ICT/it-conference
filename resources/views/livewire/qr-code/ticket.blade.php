<x-action-section>
    <x-slot name="title">
        {{ __('Ticket') }}
    </x-slot>

    <x-slot name="description">
        {{ __("Your personal ticket for the conference.") }}
    </x-slot>

    <x-slot name="content">
        <img src="data:image/png;base64,{{ base64_encode($ticket) }}" alt="QR Code">
    </x-slot>
</x-action-section>
